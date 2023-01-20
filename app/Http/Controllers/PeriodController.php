<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeriodRequest;
use App\Models\Period;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    public function store(PeriodRequest $request)
    {
        $validated = $request->validated();
        Period::find(1)->update($validated);
        return redirect()->route('document.index');
    }
}
