<?php
// Modified by Claude

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Activity;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a category with its activities
     */
    public function show(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        
        // Build query for this category
        $query = Activity::with('category')->where('categorie_id', $id);
        
        // Apply emirate filter if provided
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
        
        // Get filter values for form persistence
        $filters = [
            'emirate' => $request->get('emirate', ''),
            'sort' => $sort
        ];
        
        return view('categories.show', compact('category', 'activities', 'filters'));
    }
}
