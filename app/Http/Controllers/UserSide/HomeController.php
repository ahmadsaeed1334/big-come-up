<?php

namespace App\Http\Controllers\UserSide;

use App\Http\Controllers\Controller;
use App\Models\HomeHero;
use Illuminate\Http\Request;
use App\Models\HeroSection;
use App\Models\HowItWorksStep;

class HomeController extends Controller
{
    public function index()
    {
        $title = "Home";
        $hero = HeroSection::first();
        $steps = HowItWorksStep::orderBy('step_number')->get();
        return view('user-side.home.home', compact('hero', 'title', 'steps'));
    }
}
