<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAwardeeRequest;
use App\Models\Awardee;
use App\Models\Document;
use App\Models\OrangTua;
use App\Models\User;

class AwardeeController extends Controller
{
    public function index()
    {
        $awardee = User::with(['awardee' => ['operator', 'parent']])->where('role', 'awardee')->get();

        return view('pages.dashboard.awardee.index', compact('awardee'));
    }

    public function show(User $user)
    {
        $awardee = $user->load('awardee');

        return view('pages.dashboard.awardee.show', compact('awardee'));
    }

    public function edit(User $user)
    {
        $awardee = $user->load(['awardee' => ['operator', 'parent']]);

        return view('pages.dashboard.awardee.edit', compact('awardee'));
    }

    public function update(User $user, UpdateAwardeeRequest $request)
    {
        $validated = $request->validated();
        if ($user->awardee == null) {
            $parent = OrangTua::create([
                'name' => $validated['parent_name'],
                'salary' => $validated['parent_salary'],
                'phone' => $validated['parent_phone'],
            ]);
            $validated['user_id'] = $user->id;
            $validated['parent_id'] = $parent->id;
            $validated['operator_id'] = auth()->user()->id;
            Awardee::create($validated);
        } else {
            $validated['operator_id'] = auth()->user()->id;
            $user->awardee->update($validated);
            $user->awardee->parent->update([
                'name' => $validated['parent_name'],
                'salary' => $validated['parent_salary'],
                'phone' => $validated['parent_phone'],
            ]);
        }

        return redirect()->route('awardee.index');
    }

    public function delete(User $user)
    {
        $user->delete();

        return redirect()->route('awardee.index');
    }

    public function awardeeView()
    {
        $awardee = Document::with(['user.awardee'])->where('status', 'validasi')->orWhere('status', 'transfer')->get();

        return view('pages.dashboard.penerima.index', compact('awardee'));
    }
}
