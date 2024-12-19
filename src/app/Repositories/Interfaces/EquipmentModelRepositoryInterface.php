<?php

namespace App\Repositories\Interfaces;

interface EquipmentModelRepositoryInterface
{
    public function getAll();
    public function edit($id);
    public function getDataToCreate();
    public function store(array $data);
    public function update(array $data);
    public function delete($id);

}
