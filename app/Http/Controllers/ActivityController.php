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
    /**
     * Display activities with optional filters
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        
        // Build query
        $query = Activity::with('category');
        
        // Apply filters from request
        if ($request->filled('category')) {
            $query->where('categorie_id', $request->category);
        }
        
        if ($request->filled('emirate')) {
            $query->where('emirate', $request->emirate);
        }
        
        // Apply sorting
        $sort = $request->get('sort', 'nom_asc');
        switch ($sort) {
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
        
        // Get top activities for hero slider
        $topActivities = Activity::with('category')
            ->whereIn('id', [1, 6, 11, 21, 31])
            ->orderByRaw('FIELD(id, 1, 6, 11, 21, 31)')
            ->get();
        
        // Get filter values for form persistence
        $filters = [
            'category' => $request->get('category', ''),
            'emirate' => $request->get('emirate', ''),
            'sort' => $sort
        ];
        
        return view('activities.index', compact('categories', 'activities', 'filters', 'topActivities'));
    }

    /**
     * AJAX endpoint for activities (returns JSON)
     */
    public function getActivities(Request $request)
    {
        $query = Activity::with('category');

        // Apply category filter if provided (accepts both 'category_id' and 'category')
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('categorie_id', $request->category_id);
        } elseif ($request->has('category') && $request->category != '') {
            $query->where('categorie_id', $request->category);
        }

        // Apply emirate filter if provided
        if ($request->has('emirate') && $request->emirate != '') {
            $query->where('emirate', $request->emirate);
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
        
        // Get total count without filters for display
        $total = Activity::count();

        return response()->json([
            'success' => true,
            'activities' => $activities,
            'total' => $total,
            'filtered' => $activities->count()
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
     * Show activity detail page
     */
    public function showPage($slug)
    {
        $activity = Activity::with('category')->where('slug', $slug)->firstOrFail();
        return view('activities.show', compact('activity'));
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
    /**
     * Display cart page with items from session
     */
    public function cart()
    {
        // Get cart from session
        $cart = session('cart', []);
        
        // MIGRATION: Convert old format [1, 2, 3] to new format {'1': {'quantity': 1}}
        if (!empty($cart) && isset($cart[0])) {
            // Old format detected (indexed array)
            $newCart = [];
            foreach ($cart as $activityId) {
                if (is_numeric($activityId)) {
                    $newCart[$activityId] = ['quantity' => 1];
                }
            }
            $cart = $newCart;
            session(['cart' => $cart]);
        }
        
        $cartIds = array_keys($cart);
        
        // Fetch activities details
        $activities = Activity::with('category')
            ->whereIn('id', $cartIds)
            ->get()
            ->keyBy('id');
        
        // Build cart items with quantity
        $cartActivities = collect($cartIds)
            ->map(function($id) use ($activities, $cart) {
                $activity = $activities->get($id);
                if ($activity) {
                    $activity->quantity = $cart[$id]['quantity'] ?? 1;
                }
                return $activity;
            })
            ->filter(); // Remove null values
        
        return view('cart.index', compact('cartActivities'));
    }
    
    /**
     * Add activity to cart
     */
    public function addToCart(Request $request)
    {
        $activityId = $request->input('activity_id');
        $quantity = $request->input('quantity', 1); // Default 1 guest
        
        // Verify activity exists
        $activity = Activity::find($activityId);
        if (!$activity) {
            return response()->json(['success' => false, 'message' => 'Activity not found'], 404);
        }
        
        // Get current cart (now stores ['id' => ['quantity' => X]])
        $cart = session('cart', []);
        
        // Add or update quantity
        if (!isset($cart[$activityId])) {
            $cart[$activityId] = ['quantity' => max(1, (int)$quantity)];
        }
        
        session(['cart' => $cart]);
        
        return response()->json([
            'success' => true,
            'count' => count($cart)
        ]);
    }
    
    /**
     * Update cart item quantity
     */
    public function updateCartQuantity(Request $request)
    {
        $activityId = $request->input('activity_id');
        $quantity = max(1, (int)$request->input('quantity', 1));
        
        $cart = session('cart', []);
        
        if (isset($cart[$activityId])) {
            $cart[$activityId]['quantity'] = $quantity;
            session(['cart' => $cart]);
        }
        
        return response()->json([
            'success' => true,
            'count' => count($cart)
        ]);
    }
    
    /**
     * Remove activity from cart
     */
    public function removeFromCart(Request $request)
    {
        $activityId = $request->input('activity_id');
        
        $cart = session('cart', []);
        unset($cart[$activityId]);
        session(['cart' => $cart]);
        
        return response()->json([
            'success' => true,
            'count' => count($cart)
        ]);
    }
    
    /**
     * Get cart count
     */
    public function getCartCount()
    {
        $cart = session('cart', []);
        return response()->json(['count' => count($cart)]);
    }
    
    /**
     * Clear cart
     */
    public function clearCart()
    {
        session()->forget('cart');
        return response()->json(['success' => true, 'count' => 0]);
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
