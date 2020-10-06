<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero;

class HomeController extends Controller
{
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $heroes = Hero::orderBy('created_at', 'desc')
                ->paginate(5);

        return view('home', compact('heroes'));
    }
}
