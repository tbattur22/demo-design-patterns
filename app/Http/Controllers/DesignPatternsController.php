<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DesignPatternsController extends Controller
{
    public function welcome()
    {
        $patterns = ['singular', 'strategy'];
        return view('welcome')->with('patterns', $patterns);
    }
}
