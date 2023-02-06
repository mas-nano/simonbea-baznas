<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePencairanRequest;
use App\Http\Requests\UpdatePencairanRequest;
use App\Models\Document;
use App\Models\Fund;
use App\Notifications\AwardeeInvoice;
use App\Traits\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PencairanController extends Controller
{
    use UploadFile;
    public function index()
    {
        $user = Fund::with(['user.awardee'])->get();

        return view('pages.dashboard.pencairan.index', compact('user'));
    }

    public function show(Fund $fund)
    {
        $transfer = $fund->load('user.awardee');

        return view('pages.dashboard.pencairan.show', compact('transfer'));
    }

    public function edit(Fund $fund)
    {
        $transfer = $fund->load('user.awardee');

        return view('pages.dashboard.pencairan.edit', compact('transfer'));
    }

    public function create(Fund $fund, CreatePencairanRequest $request)
    {
        $validated = $request->validated();

        if ($fund->invoice == null && !isset($validated['invoice'])) {
            $validated['status'] = 'belum transfer';
        }

        if (isset($validated['invoice'])) {
            if ($fund->invoice != null) {
                Storage::delete($fund->invoice);
            }
            $path = $this->upload('images', $validated['invoice']);
            $validated['invoice'] = $path;
            $fund->user->notify(new AwardeeInvoice($fund->user, $validated['received_funds'], asset('storage/' . $path)));
        } else {
            unset($validated['invoice']);
        }

        $validated['operator_id'] = auth()->user()->id;
        $fund->update($validated);

        return redirect()->route('pencairan.index');
    }
}
