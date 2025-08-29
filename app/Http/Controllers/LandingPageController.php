<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\HeroSection;

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
