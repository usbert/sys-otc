<?php

namespace App\Repositories\Interfaces;

interface ProjectRepositoryInterface
{
    public function getAll();
    public function find($id);
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
}
