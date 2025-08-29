<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\About;
use App\Models\Destination;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use App\Services\TripService;

class LandingPageController extends Controller
{
    public function home()
    {
        $hero = HeroSection::first();
        return Inertia::render('Welcome', [
            'hero' => $hero,
        ]);
    }
}
