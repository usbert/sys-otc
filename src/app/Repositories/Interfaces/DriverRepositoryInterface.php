<?php

namespace App\Repositories\Interfaces;

interface DriverRepositoryInterface
{
    public function getAll();
    public function edit($id);
    public function store(array $data);
    public function update(array $data);
    public function delete($id);
}
