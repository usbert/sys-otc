<?php

namespace App\Repositories;

use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Models\Permission;
// use Illuminate\Support\Facades\Auth;

class PermissionRepository implements PermissionRepositoryInterface
{


    public function getAll()
    {

        $permissions = Permission::get();
        return  $permissions;

    }

    public function getPermissionByUser($user_id)
    {
        // $user_id = Auth::user()->id;

        $permissions = Permission::select(
            'system_modules.id as module_id',
            'menus.id as menu_id',
            'system_modules.name as module_name',
            'system_modules.icon as icon_module',
            'menus.icon as icon_name',
            'menus.name as menu_name',
            'menus.route as route_name',
            'actions.name as action_name',
        )
        ->where('permissions.user_id', '=', $user_id)
        ->where('menus.is_activated', '=', 1)
        ->Join('page_actions', 'page_actions.id', '=', 'permissions.page_action_id')
        ->Join('actions', 'actions.id', '=', 'page_actions.action_id')
        ->Join('menus', 'menus.id', '=', 'page_actions.menu_id')
        ->Join('system_modules', 'system_modules.id', '=', 'menus.system_module_id')
        ->orderBy('system_modules.name')
        ->orderBy('menus.order_by')
        ->get();

        $permission = [
           'permissions' => $permissions
        ];

        return response()->json($permission);

    }


    public function store($data)
    {
        return Permission::create($data)->id;
    }


    public function deletePermissionByUserId($id)
    {
        $permissiontUser = Permission::where('user_id', $id)->delete();
        return  $permissiontUser;
    }

}
