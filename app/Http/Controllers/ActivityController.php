<?php
// Modified by Claude

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
     * AJAX endpoint for DataTables (NO FOREACH - server-side processing)
     */
    public function getActivities(Request $request)
    {
        $query = Activity::with('category');

        // Apply category filter if provided
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('categorie_id', $request->category_id);
        }

        return DataTables::of($query)
            ->addColumn('checkbox', function ($activity) {
                return '<div class="activite-card" data-id="' . $activity->id . '" data-prix="' . $activity->prix . '">
                    <input type="checkbox" class="activite-checkbox" id="activite-' . $activity->id . '" value="' . $activity->id . '">
                </div>';
            })
            ->addColumn('image', function ($activity) {
                $firstImage = $activity->images[0] ?? 'images/default.jpg';
                return '<img src="/' . $firstImage . '" alt="' . $activity->nom . '" class="activite-image img-fluid" loading="lazy">';
            })
            ->addColumn('details', function ($activity) {
                return '<div class="activite-details">
                    <h5 class="activite-nom">' . $activity->nom . '</h5>
                    <p class="activite-location"><i class="bi bi-geo-alt"></i> ' . $activity->location . '</p>
                    <div class="activite-rating">' . $this->renderStars($activity->notes) . ' <span>(' . $activity->notes . ')</span></div>
                    <p class="activite-description">' . substr($activity->description, 0, 150) . '...</p>
                    <div class="activite-prix"><strong>' . number_format($activity->prix, 2) . ' AED</strong></div>
                </div>';
            })
            ->addColumn('actions', function ($activity) {
                return '<button class="btn btn-sm btn-outline-primary voir-details" data-id="' . $activity->id . '">
                    <i class="bi bi-eye"></i> Voir détails
                </button>';
            })
            ->rawColumns(['checkbox', 'image', 'details', 'actions'])
            ->make(true);
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
