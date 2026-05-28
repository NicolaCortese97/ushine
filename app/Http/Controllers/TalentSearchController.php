<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class TalentSearchController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('tipo_utente', 'Talent')->with('categories');

        // Filter by search query (name, cognome, or bio)
        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('cognome', 'like', "%{$q}%")
                    ->orWhere('bio', 'like', "%{$q}%");
            });
        }

        // Filter by category ID
        if ($request->filled('category_id')) {
            $catId = $request->input('category_id');
            $query->whereHas('categories', function ($sub) use ($catId) {
                $sub->where('categories.id', $catId);
            });
        }

        // Fetch Top 3 Talents as Featured/Famous
        $featuredTalents = User::where('tipo_utente', 'Talent')
            ->with('categories')
            ->orderBy('level', 'desc')
            ->orderBy('xp_points', 'desc')
            ->take(3)
            ->get();

        // Execute query for all talents matching criteria
        $talents = $query->orderBy('level', 'desc')
            ->orderBy('xp_points', 'desc')
            ->paginate(9)
            ->withQueryString();

        $categories = Category::all();

        if ($request->ajax()) {
            return view('pages.talents.partials.grid', compact('talents'))->render();
        }

        return view('pages.talents.index', compact('talents', 'featuredTalents', 'categories'));
    }
}
