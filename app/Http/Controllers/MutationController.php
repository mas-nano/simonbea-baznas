<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateMutationRequest;
use App\Models\Mutation;
use Illuminate\Http\Request;

class MutationController extends Controller
{
    public function index()
    {
        $mutation = Mutation::with('user')->get();

        return view('pages.dashboard.mutation.index', compact('mutation'));
    }

    public function edit(Mutation $mutation)
    {
        $mutation = $mutation->load('user');

        return view('pages.dashboard.mutation.edit', compact('mutation'));
    }

    public function update(Mutation $mutation, UpdateMutationRequest $request)
    {
        $validated = $request->validated();
        $mutation->update($validated);

        return redirect()->route('mutation.index');
    }
}
