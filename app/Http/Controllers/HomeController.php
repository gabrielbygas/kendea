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
        
        // Get top 5 activities for hero slider (best rated)
        $topActivities = Activity::with('category')
            ->orderBy('notes', 'desc')
            ->take(5)
            ->get();
            
        $featuredActivities = Activity::with('category')
            ->orderBy('notes', 'desc')
            ->limit(8)
            ->get();

        return view('home.index', compact('categories', 'topActivities', 'featuredActivities'));
    }
}
