<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePencairanRequest;
use App\Models\Document;
use App\Traits\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PencairanController extends Controller
{
    use UploadFile;
    public function index()
    {
        $user = Document::with('user.awardee')->where('status', 'validasi')->orWhere('status', 'transfer')->get();

        return view('pages.dashboard.pencairan.index', compact('user'));
    }

    public function create(Document $document, CreatePencairanRequest $request)
    {
        $validated = $request->validated();

        $path = $this->upload('images', $validated['invoice']);
        $validated['invoice'] = $path;
        $validated['status'] = 'transfer';
        if ($document->invoice != null) {
            Storage::delete($document->invoice);
        }
        $document->update($validated);

        return redirect()->route('pencairan.index');
    }
}
