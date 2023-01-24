<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Jobs\SendWhatsappJob;
use App\Models\Document;
use App\Models\Fund;
use App\Models\Mutation;
use App\Models\Period;
use App\Models\User;
use App\Notifications\AwardeeActivated;
use App\Notifications\AwardeeNonActive;
use App\Notifications\ParentActivated;
use App\Notifications\ParentNonActive;
use App\Traits\UploadFile;
use DateTime;
use Illuminate\Database\Eloquent\Builder as Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    use UploadFile;
    public function index()
    {
        if (auth()->user()->role == 'awardee') {
            $user = auth()->user();
            $file = $user->load('document');
            return view('pages.dashboard.berkas.index', compact('file'));
        } else {
            $document = Document::with('user')->get();
            $period = Period::find(1);
            return view('pages.dashboard.berkas.operator-index', compact('document', 'period'));
        }
    }

    public function create()
    {
        return view('pages.dashboard.berkas.create');
    }

    public function store(CreateDocumentRequest $request)
    {
        $validated = $request->validated();

        if (Document::where('user_id', auth()->user()->id)->where('status', 'pending')->count() > 0) {
            return redirect()->route('document.index')->with('pending', 'Tidak bisa upload berkas karena ada berkas yang pending');
        }

        if (Document::where('user_id', auth()->user()->id)->where('status', 'tolak')->count() > 0 || auth()->user()->awardee->status == 'nonaktif') {
            return redirect()->route('document.index')->with('pending', 'Tidak bisa upload berkas karena beasiswa telah ditolak');
        }

        $period = Period::find(1);

        if (new DateTime() > new DateTime($period->last_registration)) {
            return redirect()->route('document.index')->with('pending', 'Tidak bisa upload berkas karena telah melebihi batas waktu pendaftaran');
        }

        $ipk = $this->upload('pdf', $validated['ipk']);
        $validated['ipk'] = $ipk;

        if (isset($validated['organization'])) {
            $org = $this->upload('pdf', $validated['organization']);
            $validated['organization'] = $org;
        }
        if (isset($validated['achievement'])) {
            $ach = $this->upload('pdf', $validated['achievement']);
            $validated['achievement'] = $ach;
        }
        $validated['user_id'] = auth()->user()->id;
        Document::create($validated);

        return redirect()->route('document.index');
    }

    public function edit(Document $document)
    {
        return view('pages.dashboard.berkas.edit', compact('document'));
    }

    public function update(Document $document, UpdateDocumentRequest $request)
    {
        $validated = $request->validated();
        if (Document::where('user_id', auth()->user()->id)->where('status', 'pending')->count() > 0) {
            return redirect()->route('document.index')->with('pending', 'Tidak bisa upload berkas karena ada berkas yang pending');
        }

        if (Document::where('user_id', auth()->user()->id)->where('status', 'tolak')->count() > 0 || auth()->user()->awardee->status == 'nonaktif') {
            return redirect()->route('document.index')->with('pending', 'Tidak bisa upload berkas karena beasiswa telah ditolak');
        }

        $period = Period::find(1);

        if (new DateTime() > new DateTime($period->last_registration)) {
            return redirect()->route('document.index')->with('pending', 'Tidak bisa upload berkas karena telah melebihi batas waktu pendaftaran');
        }
        if (isset($validated['ipk'])) {
            $org = $this->upload('pdf', $validated['ipk']);
            $validated['ipk'] = $org;
        } else {
            unset($validated['ipk']);
        }
        if (isset($validated['organization'])) {
            $org = $this->upload('pdf', $validated['organization']);
            $validated['organization'] = $org;
        } else {
            unset($validated['organization']);
        }
        if (isset($validated['achievement'])) {
            $ach = $this->upload('pdf', $validated['achievement']);
            $validated['achievement'] = $ach;
        } else {
            unset($validated['achievement']);
        }

        $document->update($validated);
        return redirect()->route('document.index');
    }

    public function delete(Document $document)
    {
        Storage::delete($document->ipk);
        if ($document->organization != null) {
            Storage::delete($document->organization);
        }
        if ($document->achievement != null) {
            Storage::delete($document->achievement);
        }

        $document->delete();

        return redirect()->route('document.index');
    }

    public function validation(Document $document, Request $request)
    {
        $req = $request->all();
        if (isset($req['valid'])) {
            $document->user->awardee->update([
                'status' => 'aktif'
            ]);
            $document->update([
                'status' => 'validasi'
            ]);
            Fund::create([
                'user_id' => $document->user->id,
                'operator_id' => auth()->user()->id
            ]);
            $document->user->notify(new AwardeeActivated($document->user));
            $document->user->notify(new ParentActivated($document->user));
        } elseif (isset($req['decline'])) {
            $document->user->awardee->update([
                'status' => 'nonaktif'
            ]);
            $document->update([
                'status' => 'tolak'
            ]);
            if (Document::where('user_id', $document->user->id)->count() > 1) {
                Mutation::create([
                    'fromName' => $document->user->id,
                    'operator_id' => auth()->user()->id
                ]);
            }
            $document->user->notify(new AwardeeNonActive($document->user));
            $document->user->notify(new ParentNonActive($document->user));
        }

        return redirect()->route('document.index');
    }

    public function broadcastWhtasapp()
    {
        $user = User::whereHas('awardee', function (Builder $query) {
            $query->where('status', 'aktif');
        })->get();

        dispatch(new SendWhatsappJob($user));

        return redirect()->route('document.index');
    }
}
