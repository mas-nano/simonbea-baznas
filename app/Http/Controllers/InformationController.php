<?php

namespace App\Http\Controllers;

use App\Traits\UploadFile;
use App\Models\Information;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\CreateInformationRequest;

class InformationController extends Controller
{
    use UploadFile;
    public function index()
    {
        $post = Information::all();
        return view('pages.dashboard.information.index', compact('post'));
    }

    public function create()
    {
        return view('pages.dashboard.information.create');
    }

    public function store(CreateInformationRequest $request)
    {
        $validated = $request->validated();

        $path = $this->upload('images', $validated['thumbnail']);
        $validated['thumbnail'] = $path;
        $validated['user_id'] = auth()->user()->id;
        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);
        Information::create($validated);

        return redirect()->route('information.index');
    }

    public function show(Information $information)
    {
        return view('pages.dashboard.information.show', compact('information'));
    }

    public function edit(Information $information)
    {
        return view('pages.dashboard.information.edit', compact('information'));
    }
}
