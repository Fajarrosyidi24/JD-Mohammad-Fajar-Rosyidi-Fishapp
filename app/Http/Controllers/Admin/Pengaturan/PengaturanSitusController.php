<?php

namespace App\Http\Controllers\Admin\Pengaturan;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SiteSettingService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\SiteSettingRequest;

class PengaturanSitusController extends Controller
{
    protected SiteSettingService $service;
    public function __construct(SiteSettingService $service)
    {
        $this->service = $service;
    }


    public function index()
    {
        return Inertia::render('Menu/Pengaturan/PengaturanSitus/index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return Inertia::render('Menu/Pengaturan/PengaturanSitus/edit');
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(SiteSettingRequest $request, $role, $id)
    {
        $validated = $request->validated();
        $siteSetting = $this->service->updateSiteSetting($id, $validated);
        if (!$siteSetting) {
            return redirect()->back()->with('error', 'Data site setting tidak ditemukan.');
        }
        return redirect()->route('pengaturan_situs',['role' => $role] )->with('success', 'Site setting berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function sitesjson()
    {
        $settings = $this->service->getSettings();
        return response()->json($settings);
    }
}
