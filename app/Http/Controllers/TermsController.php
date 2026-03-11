<?php
// Modified by Claude

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function index()
    {
        return view('legal.terms');
    }
}
