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
        if ($request->has('category') && $request->category != '') {
            $query->where('categorie_id', $request->category);
        }

        // Apply emirate filter if provided
        if ($request->has('emirate') && $request->emirate != '') {
            $query->where('emirat', $request->emirate);
        }

        // Apply sorting
        $sort = $request->get('sort', 'nom_asc');
        switch ($sort) {
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
     * Display cart page
     */
    public function cart()
    {
        return view('cart.index');
    }

    /**
     * Get multiple activities by IDs
     */
    public function getBulk(Request $request)
    {
        $ids = $request->input('ids', []);
        $activities = Activity::with('category')
            ->whereIn('id', $ids)
            ->get()
            ->map(function ($activity) {
                return [
                    'id' => $activity->id,
                    'nom' => $activity->nom,
                    'nom_en' => $activity->nom_en,
                    'slug' => $activity->slug,
                    'location' => $activity->location,
                    'location_en' => $activity->location_en,
                    'prix' => $activity->prix,
                    'notes' => $activity->notes,
                    'first_image' => $activity->first_image,
                    'category' => $activity->category ? $activity->category->nom : null
                ];
            });

        return response()->json($activities);
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
