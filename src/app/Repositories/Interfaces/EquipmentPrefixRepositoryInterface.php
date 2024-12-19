<?php

namespace App\Repositories\Interfaces;

interface EquipmentPrefixRepositoryInterface
{
    public function getAll();
    public function store(array $data);
    public function update(array $data);
    public function delete($id);
}
