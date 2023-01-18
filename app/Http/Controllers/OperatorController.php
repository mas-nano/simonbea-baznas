<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function index()
    {
        $operator = User::with('operator')->where('role', 'operator')->get();

        return view('pages.dashboard.operator.index', compact('operator'));
    }

    public function create()
    {
        return view('pages.dashboard.operator.create');
    }
}
