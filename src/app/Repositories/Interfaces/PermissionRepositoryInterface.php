<?php

namespace App\Repositories\Interfaces;

interface PermissionRepositoryInterface
{
    public function getAll();
    public function getPermissionByUser($user_id);
    // public function store(array $data);
    // public function update(array $data);
    // public function delete($id);

}
