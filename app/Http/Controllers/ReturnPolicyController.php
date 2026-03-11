<?php
// Modified by Claude

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReturnPolicyController extends Controller
{
    public function index()
    {
        return view('legal.return-policy');
    }
}
