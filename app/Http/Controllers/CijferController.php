<?php

namespace App\Http\Controllers;

use App\Models\GedaanKeuzedeel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CijferController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->rol !== 'student') {
            abort(403, 'Alleen studenten kunnen hun cijfers bekijken.');
        }
        
        $gedaneKeuzedelen = GedaanKeuzedeel::where('user_id', $user->id)
            ->with('keuzedeel')
            ->orderBy('datum_afgerond', 'desc')
            ->get();
            
        return view('cijfers.index', compact('gedaneKeuzedelen'));
    }
}
