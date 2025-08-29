<?php

namespace App\Services;

use App\Models\Destination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DestinationService
{
    public function store(array $data, $file = null): Destination
    {
        $slug = Str::slug($data['name']);
        $originalSlug = $slug;
        $count = 1;
        while (Destination::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $data['slug'] = $slug;
        Storage::disk('public')->makeDirectory('destinasi');

        if ($file) {
            $fileName = 'destinasi/' . Str::uuid() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put($fileName, file_get_contents($file));
            $data['image'] = $fileName;
        }

        return Destination::create($data);
    }

    public function update(Destination $destination, array $data, $file = null): Destination
{
    if (isset($data['name']) && $data['name'] !== $destination->name) {
        $slug = Str::slug($data['name']);
        $originalSlug = $slug;

        $count = 1;
        while (Destination::where('slug', $slug)->where('id', '!=', $destination->id)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $data['slug'] = $slug;
    }
    if ($file) {
        if ($destination->image && Storage::disk('public')->exists($destination->image)) {
            Storage::disk('public')->delete($destination->image);
        }

        Storage::disk('public')->makeDirectory('destinasi');

        $fileName = 'destinasi/' . Str::uuid() . '.' . $file->getClientOriginalExtension();
        Storage::disk('public')->put($fileName, file_get_contents($file));
        $data['image'] = $fileName;
    } else {
        unset($data['image']);
    }

    $destination->update($data);

    return $destination;
}

}
