<?php

namespace App\Services;

use App\Repositories\Interfaces\EquipmentPrefixRepositoryInterface;

class EquipmentPrefixService
{

    public function __construct(EquipmentPrefixRepositoryInterface $equipmentPrefixRepository)
    {
        $this->equipmentPrefixRepository = $equipmentPrefixRepository;
    }

    public function getAll()
    {
        return $this->equipmentPrefixRepository->getAll();
    }

    public function store(array $data)
    {
        // MAIN TABLE
        $equipmentPrefix = array(
            'prefix' => $data['prefix'],
            'name' => $data['name'],
            // 'user_id' => Auth::user()->id,
        );
        $equipment_prefix_id = $this->equipmentPrefixRepository->store($equipmentPrefix);
        // end MAIN TABLE

    }


    public function edit($id) {
        return $this->equipmentPrefixRepository->edit($id);
    }

    public function update(array $data)
    {
        $equipmentPrefix = array(
            'id'    => $data['id'],
            'prefix'  => $data['prefix'],
            'name'  => $data['name'],
        );
        $updateEquipmentPrefix = $this->equipmentPrefixRepository->update($equipmentPrefix);
    }


    public function delete(array $data)
    {
        $updateEquipmentPrefix = $this->equipmentPrefixRepository->delete($data['id']);

    }



}
