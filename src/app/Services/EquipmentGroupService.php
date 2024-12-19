<?php

namespace App\Services;

use App\Repositories\Interfaces\EquipmentGroupRepositoryInterface;

class EquipmentGroupService
{

    public function __construct(EquipmentGroupRepositoryInterface $equipmentGroupRepository)
    {
        $this->equipmentGroupRepository = $equipmentGroupRepository;
    }

    public function getAll()
    {
        return $this->equipmentGroupRepository->getAll();
    }



    public function store(array $data)
    {
        // MAIN TABLE
        $equipmentGroup = array(
            'name' => $data['name'],
        );
        $equipmentGroup_id = $this->equipmentGroupRepository->store($equipmentGroup);
        // end MAIN TABLE

    }

    public function edit($id) {
        return $this->equipmentGroupRepository->edit($id);
    }

    public function update(array $data)
    {
        $equipmentGroups = array(
            'id'    => $data['id'],
            'name'  => $data['name']
        );
        $updateEquipmentGroups = $this->equipmentGroupRepository->update($equipmentGroups);

    }

    public function delete(array $data)
    {
        $project = $this->equipmentGroupRepository->delete($data['id']);

    }




}
