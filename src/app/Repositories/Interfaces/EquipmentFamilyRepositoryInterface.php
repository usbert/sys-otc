<?php

namespace App\Repositories\Interfaces;

interface EquipmentFamilyRepositoryInterface
{
    public function getAll();
    public function edit($id);
    public function getDataToCreate();
    public function update(array $data);
    public function delete($id);
}
