<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileAwardeeUpdateRequest;
use App\Http\Requests\ProfileOperatorUpdateRequest;
use App\Models\Awardee;
use App\Models\Operator;
use App\Models\OrangTua;
use App\Models\User;
use App\Traits\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    use UploadFile;
    public function index()
    {
        if (auth()->user()->role == 'awardee') {
            $awardee = User::find(auth()->user()->id)->load(['awardee' => ['operator', 'parent']]);
            return view('pages.dashboard.profile.awardee.index', compact('awardee'));
        } else {
            $operator = User::find(auth()->user()->id)->load(['operator']);
            return view('pages.dashboard.profile.operator.index', compact('operator'));
        }
    }

    public function edit()
    {
        if (auth()->user()->role == 'awardee') {
            $awardee = User::find(auth()->user()->id)->load(['awardee' => ['operator', 'parent']]);
            return view('pages.dashboard.profile.awardee.edit', compact('awardee'));
        } else {
            $operator = User::find(auth()->user()->id)->load(['operator']);
            return view('pages.dashboard.profile.operator.edit', compact('operator'));
        }
    }

    public function awardeeUpdate(ProfileAwardeeUpdateRequest $request)
    {
        $validated = $request->validated();

        if (isset($validated['front_home'])) {
            if (auth()->user()->awardee != null) {
                if (auth()->user()->awardee->front_home != null) {
                    Storage::delete(auth()->user()->awardee->front_home);
                }
            }
            $path = $this->upload('images', $validated['front_home']);
            $validated['front_home'] = $path;
        } else {
            unset($validated['front_home']);
        }
        if (isset($validated['side_home'])) {
            if (auth()->user()->awardee != null) {
                if (auth()->user()->awardee->side_home != null) {
                    Storage::delete(auth()->user()->awardee->side_home);
                }
            }
            $path = $this->upload('images', $validated['side_home']);
            $validated['side_home'] = $path;
        } else {
            unset($validated['side_home']);
        }
        if (isset($validated['back_home'])) {
            if (auth()->user()->awardee != null) {
                if (auth()->user()->awardee->back_home != null) {
                    Storage::delete(auth()->user()->awardee->back_home);
                }
            }
            $path = $this->upload('images', $validated['back_home']);
            $validated['back_home'] = $path;
        } else {
            unset($validated['back_home']);
        }
        if (isset($validated['register_proof'])) {
            if (auth()->user()->awardee != null) {
                if (auth()->user()->awardee->register_proof != null) {
                    Storage::delete(auth()->user()->awardee->register_proof);
                }
            }
            $path = $this->upload('images', $validated['register_proof']);
            $validated['register_proof'] = $path;
        } else {
            unset($validated['register_proof']);
        }
        if (isset($validated['picture'])) {
            if (auth()->user()->awardee != null) {
                if (auth()->user()->awardee->picture != null) {
                    Storage::delete(auth()->user()->awardee->picture);
                }
            }
            $path = $this->upload('images', $validated['picture']);
            $validated['picture'] = $path;
        } else {
            unset($validated['picture']);
        }
        if (isset($validated['surat_ket_tidak_mampu'])) {
            if (auth()->user()->awardee != null) {
                if (auth()->user()->awardee->surat_ket_tidak_mampu != null) {
                    Storage::delete(auth()->user()->awardee->surat_ket_tidak_mampu);
                }
            }
            $path = $this->upload('pdf', $validated['surat_ket_tidak_mampu']);
            $validated['surat_ket_tidak_mampu'] = $path;
        } else {
            unset($validated['surat_ket_tidak_mampu']);
        }
        if (isset($validated['certificates'])) {
            if (auth()->user()->awardee != null) {
                if (auth()->user()->awardee->certificates != null) {
                    Storage::delete(auth()->user()->awardee->certificates);
                }
            }
            $path = $this->upload('pdf', $validated['certificates']);
            $validated['certificates'] = $path;
        } else {
            unset($validated['certificates']);
        }
        if (isset($validated['cv'])) {
            if (auth()->user()->awardee != null) {
                if (auth()->user()->awardee->cv != null) {
                    Storage::delete(auth()->user()->awardee->cv);
                }
            }
            $path = $this->upload('pdf', $validated['cv']);
            $validated['cv'] = $path;
        } else {
            unset($validated['cv']);
        }
        if (isset($validated['identity'])) {
            if (auth()->user()->awardee != null) {
                if (auth()->user()->awardee->identity != null) {
                    Storage::delete(auth()->user()->awardee->identity);
                }
            }
            $path = $this->upload('pdf', $validated['identity']);
            $validated['identity'] = $path;
        } else {
            unset($validated['identity']);
        }

        if (auth()->user()->awardee == null) {
            $ortu = OrangTua::create([
                'name' => $validated['parent_name'],
                'salary' => $validated['parent_salary'],
                'phone' => $validated['parent_phone']
            ]);
            $validated['user_id'] = auth()->user()->id;
            $validated['parent_id'] = $ortu->id;
            Awardee::create($validated);
        } else {
            auth()->user()->awardee->update($validated);
            auth()->user()->operator->parent->update([
                'name' => $validated['parent_name'],
                'salary' => $validated['parent_salary'],
                'phone' => $validated['parent_phone']
            ]);
        }

        return redirect()->route('profile.index');
    }

    public function operatorUpdate(ProfileOperatorUpdateRequest $request)
    {
        $validated = $request->validated();

        if (isset($validated['picture'])) {
            if (auth()->user()->operator != null) {
                if (auth()->user()->operator->picture != null) {
                    Storage::delete(auth()->user()->operator->picture);
                }
            }

            $path = $this->upload('images', $validated['picture']);
            $validated['picture'] = $path;
        } else {
            unset($validated['picture']);
        }

        auth()->user()->update([
            'name' => $validated['name']
        ]);

        if (auth()->user()->operator == null) {
            $validated['user_id'] = auth()->user()->id;
            Operator::create($validated);
        } else {
            auth()->user()->operator->update($validated);
        }

        return redirect()->route('profile.index');
    }
}
