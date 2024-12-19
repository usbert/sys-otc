<?php

namespace App\Repositories\Interfaces;

interface ProjectLocationRepositoryInterface
{
    public function getAll();
    public function find($id);
    public function edit($id);
    public function store(array $data);
    public function update(array $data);
    public function delete($id);
}
