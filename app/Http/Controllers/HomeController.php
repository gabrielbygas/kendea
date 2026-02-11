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
        
        // Get top 5 most popular UAE activities (one per category)
        // IDs: Burj Khalifa, Desert Safari, Aquaventure, Louvre, Dhow Cruise
        $topActivities = Activity::with('category')
            ->whereIn('id', [1, 6, 11, 21, 31])
            ->orderByRaw('FIELD(id, 1, 6, 11, 21, 31)')
            ->get();
            
        $featuredActivities = Activity::with('category')
            ->orderBy('notes', 'desc')
            ->limit(8)
            ->get();

        return view('home.index', compact('categories', 'topActivities', 'featuredActivities'));
    }
}
