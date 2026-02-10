<?php
// Modified by Antigravity

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display homepage
     */
    public function index()
    {
        $categories = Category::all();
        $featuredActivities = Activity::with('category')
            ->orderBy('notes', 'desc')
            ->limit(8)
            ->get();

        return view('home.index', compact('categories', 'featuredActivities'));
    }
}
