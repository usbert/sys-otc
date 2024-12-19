<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\UserProjectRepositoryInterface;
use App\Repositories\Interfaces\PermissionRepositoryInterface;

use Illuminate\Support\Facades\Auth;

class UserService
{

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserProjectRepositoryInterface $userProjectRepository,
        PermissionRepositoryInterface $permissionRepository,
    )  {
        $this->userRepository = $userRepository;
        $this->userProjectRepository = $userProjectRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function getAll()
    {
        return $this->userRepository->getAll();
    }

    public function getDataToCreate()
    {
        return $this->userRepository->getDataToCreate();
    }

    public function edit($id) {
        return $this->userRepository->edit($id);
    }

    public function store(array $data)
    {

        if(empty($data['is_admin'])) {
            $is_admin = 2;
        } else {
            $is_admin = 1;
        }
        if(empty($data['is_activated'])) {
            $is_activated = 0;
        } else {
            $is_activated = 1;
        }

        $user = array(
            'name'          => $data['name'],
            'email'         => strtolower($data['email']),
            'password'      => '12345678',
            'is_admin'      => $is_admin,
            'is_activated'  => $is_activated,
            'user_id'       => Auth::user()->id,
        );

        // SALVA E RETORNA O ID
        $user_id = $this->userRepository->store($user);

        // PROJETOS DO USUÁRIO
        if(!empty($data['user_projects'])) {

            $arrayUserProjects = [];

            foreach ($data['user_projects'] as $rows =>$key) {

                $arrayUserProjects['user_id'] = $user_id;
                $arrayUserProjects['project_id'] = $key;

                $this->userProjectRepository->store($arrayUserProjects);
            }

        }

        // PERMISSÕES DO USUÁRIO
        if(!empty($data['page_actions'])) {

            $arraypageActions = [];

            foreach ($data['page_actions'] as $rows =>$key) {

                $arraypageActions['user_id'] = $user_id;
                $arraypageActions['page_action_id'] = $key;

                $this->permissionRepository->store($arraypageActions);

            }

        }

    }


    public function update(array $data)
    {

        if(empty($data['is_admin'])) {
            $is_admin = 2;
        } else {
            $is_admin = 1;
        }
        if(empty($data['is_activated'])) {
            $is_activated = 0;
        } else {
            $is_activated = 1;
        }

        $user = array(
            'id'            => $data['id'],
            'name'          => $data['name'],
            'email'         => strtolower($data['email']),
            'is_admin'      => $is_admin,
            'is_activated'  => $is_activated,
        );

        $updateUser = $this->userRepository->update($user);

        // EXCLUIR PROJETOS DO USUÁRIO EXISTENTES
        $this->userProjectRepository->deleteProjectByUserId($data['id']);

        // PROJETOS DO USUÁRIO
        if(!empty($data['user_projects'])) {

            $arrayUserProjects = [];

            foreach ($data['user_projects'] as $rows =>$key) {

                $arrayUserProjects['user_id'] = $data['id'];
                $arrayUserProjects['project_id'] = $key;

                $this->userProjectRepository->store($arrayUserProjects);
            }

        }

        // EXCLUIR PERMISSÕES DO USUÁRIO EXISTENTES
        $this->permissionRepository->deletePermissionByUserId($data['id']);

        // PERMISSÕES DO USUÁRIO

        if(!empty($data['page_actions'])) {

            $arraypageActions = [];

            foreach ($data['page_actions'] as $rows =>$key) {

                $arraypageActions['user_id'] = $data['id'];
                $arraypageActions['page_action_id'] = $key;

                $this->permissionRepository->store($arraypageActions);

            }

        }



    }




}
