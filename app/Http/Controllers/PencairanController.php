<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePencairanRequest;
use App\Http\Requests\UpdatePencairanRequest;
use App\Models\Document;
use App\Models\Fund;
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
        } else {
            unset($validated['invoice']);
        }

        $validated['operator_id'] = auth()->user()->id;
        $fund->update($validated);

        return redirect()->route('pencairan.index');
    }

    public function update(Fund $fund, UpdatePencairanRequest $request)
    {
        $validated = $request->validated();

        $fund->update($validated);

        return redirect()->route('pencairan.index');
    }
}
