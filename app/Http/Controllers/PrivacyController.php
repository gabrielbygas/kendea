<?php
// Modified by Claude

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function index()
    {
        return view('legal.privacy');
    }
}
