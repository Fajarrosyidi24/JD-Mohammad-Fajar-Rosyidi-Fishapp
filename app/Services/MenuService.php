<?php

namespace App\Services;

use App\Models\Menu;
use App\Models\SiteSetting;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;

class MenuService
{
    /**
     * Ambil menu dalam bentuk array berdasarkan nama role.
     *
     * @param string $roleName
     * @return array
     */
    public function getMenusByRole(string $roleName): array
    {
        $role = Role::where('name', $roleName)->first();

        if (!$role) {
            return [];
        }
        $permissions = $role->permissions->pluck('name')->toArray();
        $menus = Menu::whereNull('parent_id')
            ->with(['children' => function ($query) use ($permissions) {
                $query->whereIn('permission_name', $permissions);
            }])
            ->orderBy('order')
            ->get()
            ->filter(function ($menu) use ($permissions) {
                return (
                    ($menu->permission_name && in_array($menu->permission_name, $permissions))
                    || $menu->children->isNotEmpty()
                );
            })
            ->map(function ($menu) {
                return [
                    'name'       => $menu->name,
                    'slug'       => $menu->slug,
                    'icon'       => $menu->icon,
                    'permission' => $menu->permission_name,
                    'children'   => $menu->children->map(function ($child) {
                        return [
                            'name'       => $child->name,
                            'slug'       => $child->slug,
                            'icon'       => $child->icon,
                            'permission' => $child->permission_name,
                        ];
                    })->toArray(),
                ];
            })
            ->toArray();

        return $menus;
    }
}
