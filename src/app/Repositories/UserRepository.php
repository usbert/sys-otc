<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Models\Project;
use App\Models\SystemModule;
use App\Models\User;
use App\Models\UserProject;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserRegister;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{

    public function getAll()
    {
        $users = User::select(
            'id',
            'name',
            'email',
            'is_activated',
        )
        // ->join('projects', 'projects.id', '=', 'users.project_id')
        ->get();

        return $users;

    }

    public function getDataToCreate()
    {
        $projectCombo = Project::where('is_activated', '=', '1')->orderBy('short_name', 'asc')->get()->take(5);

        $permissionCombo = SystemModule::select(
            'page_actions.id as page_action_id',
            'system_modules.name as module_name',
            'menus.name as menu_name',
            'actions.name as action_name',
        )
        ->where('system_modules.is_activated', 1)
        ->where('menus.is_activated', 1)
        ->join('menus', 'menus.system_module_id', '=', 'system_modules.id')
        ->join('page_actions', 'page_actions.menu_id', '=', 'menus.id')
        ->join('actions', 'actions.id', '=', 'page_actions.action_id')
        ->orderBy('system_modules.name')
        ->orderBy('menus.name')
        ->orderBy('actions.name')
        ->get();

        $return = array(
            'projectCombo' => $projectCombo,
            'permissionCombo' => $permissionCombo,
        );
        // dd($return);
        return $return;
    }


    public function store($data)
    {
        // CRIA UM ID E ENVIA PARA USAR FK

       // $user = Auth()->id;
       // $sent = Mail::to($user)->send(new NewUserRegister([
       $sent = Mail::to('usbert@gmail.com', name: 'Marcelo Usbert')->send(new NewUserRegister([
            'fromName' => $data['name'],
            'fromEmail' => $data['email'],
            'subject' => 'New SGE - Novo Usuário Cadastrado',
            'message' => 'Seu usuário foi cadastrado com sucesso',
        ]));

        return User::create($data)->id;


    }

    public function edit($id)
    {

        $user = User::select(
            'id',
            'name',
            'email',
            'access_level',
            'is_activated',
        )
        ->where('id', $id)
        ->where('is_activated', 1)
        ->get();

        $projectCombo = Project::where('is_activated', '=', '1')->orderBy('short_name', 'asc')->get()->take(5);

        $permissionCombo = SystemModule::select(
            'page_actions.id',
            'system_modules.name as module_name',
            'menus.name as menu_name',
            'actions.name as action_name',
        )
        ->where('system_modules.is_activated', 1)
        ->where('menus.is_activated', 1)
        ->join('menus', 'menus.system_module_id', '=', 'system_modules.id')
        ->join('page_actions', 'page_actions.menu_id', '=', 'menus.id')
        ->join('actions', 'actions.id', '=', 'page_actions.action_id')
        ->orderBy('system_modules.name')
        ->orderBy('menus.name')
        ->orderBy('actions.name')
        ->get();

        $userProject = UserProject::where('user_id', '=', $id)->get();
        $userPermission = Permission::where('user_id', '=', $id)->get();

        $return = array(
            // TABELA PRINCIPAL
            'user' => $user,

            // COMBOBOX
            'projectCombo' => $projectCombo,
            'permissionCombo' => $permissionCombo,

            // PROJETOS DO USUÁRIO
            'userProject' => $userProject,
            'userPermission' => $userPermission,

        );
        // dd($return);
        return $return;

    }

    public function update(array $data)
    {
        try {
            $input                  = User::find($data['id']);
            $input->name            = $data['name'];
            $input->email           = $data['email'];
            $input->is_admin        = $data['is_admin'];
            $input->is_activated    = $data['is_activated'];

            $input->save();

            return $input;

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()]);
        }

    }


}
