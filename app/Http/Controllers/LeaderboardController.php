<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    /**
     * Display the leaderboard.
     */
    public function index()
    {
        // Fetch talents ordered by XP points
        $talents = User::where('tipo_utente', 'Talent')
            ->with('categories')
            ->orderBy('xp_points', 'desc')
            ->get();

        // Fetch sponsors joined with sponsors table, ordered by total donated XP
        $sponsors = User::where('tipo_utente', 'Sponsor')
            ->leftJoin('sponsors', 'users.id', '=', 'sponsors.sponsor_id')
            ->select('users.*', DB::raw('COALESCE(sponsors.xp_donati_totali, 0) as xp_donati_totali'))
            ->orderBy('xp_donati_totali', 'desc')
            ->get();

        return view('pages.leaderboard', compact('talents', 'sponsors'));
    }
}
