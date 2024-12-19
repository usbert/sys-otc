<?php

namespace App\Repositories\Interfaces;

interface ProjectRepositoryInterface
{
    public function getAll();
    // public function find($id);
    public function edit($id);
    // public function getDataToCreate();
    public function store(array $data);
    public function update(array $data);
    public function delete($id);
}
