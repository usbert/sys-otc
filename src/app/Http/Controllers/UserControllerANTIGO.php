<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // select s.name as module,
        //         m.name as menu,
        //         a.name as action_user,
        //         p.user_id
        // from system_modules s
        // inner join menus m on m.system_module_id = s.id
        // inner join page_actions pa on pa.menu_id = m.id
        // inner join actions a on a.id = pa.action_id
        // left join permissions p on p.page_action_id = pa.id
        // where p.user_id = 1


        // $vehicle = Sys::select(
        //     'vehicles.*',
        //     'statuses.name as status_name',
        //     'supplyers.name as supplyer_name',
        //     'projects.short_name as project_short_name'
        // )
        // ->where('vehicles.id', $id)
        // ->where('vehicles.is_activated', 1)
        // ->join('statuses', 'statuses.id', '=', 'vehicles.status_id')
        // ->join('projects', 'projects.id', '=', 'vehicles.project_id')
        // ->join('supplyers', 'supplyers.id', '=', 'vehicles.supplyer_id')
        // ->get();


        //  $permission = User::join('permissions', 'permissions.user_id', 'users.id')
        //     ->join('page_actions', 'page_actions.action_id', 'permissions.page_action_id')
        //     ->join('actions', 'actions.id', 'page_actions.action_id')
        //     ->select('xusers.name', 'users.email', 'actions.name')
        //     ->get();

       //   dd($users);



        // $userId = Auth::user()->id;

        $users = User::with([
                // 'permission',
                'permission.pageAction.action',
                // 'permission.pageAction.menu',
            ])
            ->orderBy('name', 'asc')
            ->get();

            //  dd($users);

        return view('backend.userlist', compact('users'));
    }

    // public function menu()
    // {
    //     $users = User::with([
    //             'permission',
    //             'permission.pageAction.action',
    //             'permission.pageAction.menu'
    //         ])
    //         ->orderBy('name', 'asc')
    //         ->get();

    //         dd($users);

    //     return view('backend.userlist', compact('users'));
    // }

}
