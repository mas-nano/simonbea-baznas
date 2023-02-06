<?php

namespace App\Http\Controllers;

use App\Models\Awardee;
use App\Models\Fund;
use App\Models\Information;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $peserta = Awardee::all()->count();
        $awardee = Awardee::where('status', 'aktif')->get()->count();
        $transfer = Fund::where('status', 'sudah transfer')->get()->count();
        $notTransfer = Fund::where('status', 'belum transfer')->get()->count();
        $post = Information::latest()->limit(3)->get();
        return view('pages.dashboard.index', compact('peserta', 'awardee', 'transfer', 'notTransfer', 'post'));
    }
}
