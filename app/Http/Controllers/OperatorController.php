<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOperatorRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateOperatorRequest;
use App\Models\Operator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadFile;

class OperatorController extends Controller
{
    use UploadFile;
    public function index()
    {
        $operator = User::with('operator')->where('role', 'operator')->get();

        return view('pages.dashboard.operator.index', compact('operator'));
    }

    public function create()
    {
        return view('pages.dashboard.operator.create');
    }

    public function store(CreateOperatorRequest $request)
    {
        $validated = $request->validated();

        if (isset($validated['picture'])) {
            $path = $this->upload('images', $validated['picture']);
        }

        $user = User::create([
            'name' => $validated['name'],
            'password' => Hash::make($validated['password']),
            'email' => $validated['email'],
            'role' => 'operator'
        ]);


        Operator::create([
            'address' => $validated['address'],
            'picture' => $path,
            'user_id' => $user->id
        ]);

        return redirect()->route('operator.index');
    }

    public function show(User $user)
    {
        $operator = $user->load('operator');

        return view('pages.dashboard.operator.show', compact('operator'));
    }

    public function edit(User $user)
    {
        $operator = $user->load('operator');

        return view('pages.dashboard.operator.edit', compact('operator'));
    }

    public function update(User $user, UpdateOperatorRequest $request)
    {
        $operator = $user->load('operator');
        $validated = $request->validated();

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        if (isset($validated['picture'])) {
            Storage::delete($operator->operator->picture);
            $path = $this->upload('images', $validated['picture']);
            $validated['picture'] = $path;
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
        $user->operator->update($validated);

        return redirect()->route('operator.index');
    }

    public function delete(User $user)
    {
        $user->delete();

        return redirect()->route('operator.index');
    }
}
