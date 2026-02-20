<?php
// Modified by Claude

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a category with its activities
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        
        return view('categories.show', compact('category'));
    }
}
