<?php

namespace App\Services;

use App\Repositories\Interfaces\PermissionRepositoryInterface;

class PermissionService
{

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }


    public function getAll()
    {
        return $this->permissionRepository->getAll();
    }


    public function getPermissionByUser($user_id) {
        return $this->permissionRepository->getPermissionByUser($user_id);
    }


}
