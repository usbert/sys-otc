<?php

namespace App\Repositories\Interfaces;

interface SupervisorRepositoryInterface
{
    public function getAll();
    public function store(array $data);
    public function update(array $data);
    public function delete($id);

}
