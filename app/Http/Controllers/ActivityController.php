<?php
// Modified by Claude

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Category;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display main view with categories
     */
    public function index()
    {
        $categories = Category::with('activities')->get();
        return view('activities.index', compact('categories'));
    }

    /**
     * AJAX endpoint for activities (returns JSON)
     */
    public function getActivities(Request $request)
    {
        $query = Activity::with('category');

        // Apply category filter if provided
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('categorie_id', $request->category_id);
        }

        // Apply sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'nom_asc':
                    $query->orderBy('nom', 'asc');
                    break;
                case 'nom_desc':
                    $query->orderBy('nom', 'desc');
                    break;
                case 'prix_asc':
                    $query->orderBy('prix', 'asc');
                    break;
                case 'prix_desc':
                    $query->orderBy('prix', 'desc');
                    break;
                case 'notes_desc':
                    $query->orderBy('notes', 'desc');
                    break;
                default:
                    $query->orderBy('nom', 'asc');
            }
        } else {
            $query->orderBy('nom', 'asc');
        }

        $activities = $query->get();

        return response()->json([
            'success' => true,
            'activities' => $activities
        ]);
    }

    /**
     * Get single activity details
     */
    public function show($id)
    {
        $activity = Activity::with('category')->findOrFail($id);
        return response()->json($activity);
    }

    /**
     * Generate XML sitemap
     */
    public function sitemap()
    {
        $activities = Activity::all();
        return response()
            ->view('sitemap', compact('activities'))
            ->header('Content-Type', 'application/xml');
    }

    /**
     * Helper to render star rating
     */
    private function renderStars($rating)
    {
        $stars = '';
        $fullStars = floor($rating);
        $halfStar = ($rating - $fullStars) >= 0.5;

        for ($i = 0; $i < $fullStars; $i++) {
            $stars .= '<i class="bi bi-star-fill text-warning"></i>';
        }

        if ($halfStar) {
            $stars .= '<i class="bi bi-star-half text-warning"></i>';
        }

        $emptyStars = 5 - ceil($rating);
        for ($i = 0; $i < $emptyStars; $i++) {
            $stars .= '<i class="bi bi-star text-warning"></i>';
        }

        return $stars;
    }
}
