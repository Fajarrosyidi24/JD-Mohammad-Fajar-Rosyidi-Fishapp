<?php

namespace App\Http\Controllers\Admin\Pengaturan;

use Inertia\Inertia;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use App\Services\HeroService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HeroRequest;

class PengaturanHeroController extends Controller
{
    protected HeroService $service;

    public function __construct(HeroService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hero = HeroSection::first();
        return Inertia::render('Menu/Pengaturan/PengaturanHero/index', [
            'hero' => $hero
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($role, $id)
    {
        $hero = HeroSection::where('id', $id)->first();
        return Inertia::render('Menu/Pengaturan/PengaturanHero/edit', [
            'hero' => $hero,
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HeroRequest $request, $role, $id)
    {
        $validated = $request->validated();
        $hero = $this->service->updateHero($id, $validated);
        if (!$hero) {
            return redirect()->back()->with('error', 'Data Hero setting tidak ditemukan.');
        }
        return redirect()->route('pengaturan_hero',['role' => $role] )->with('success', 'Pengaturan Hero berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
