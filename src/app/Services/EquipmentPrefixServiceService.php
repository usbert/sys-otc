<?php

namespace App\Services;

use App\Repositories\Interfaces\EquipmentPrefixRepositoryInterface;
// use Illuminate\Support\Facades\Auth;

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
    public function create(array $data)
    {
        return false;
    }

    public function store(array $data)
    {
        // MAIN TABLE
        $equipmentPrefix = array(
            'prefix'            => $data['prefix'],
            'name'              => $data['name'],
            // 'user_id' => Auth::user()->id,
        );
        $equipmentPrefix_id = $this->equipmentPrefixRepository->store($equipmentPrefix);
        // end MAIN TABLE

    }

    public function edit($id) {
        return $this->equipmentPrefixRepository->edit($id);
    }

    public function update(array $data)
    {
        $equipmentPrefix = array(
            'id'    => $data['id'],
            'name'  => $data['name'],
        );
        $updateBrad = $this->equipmentPrefixRepository->update($equipmentPrefix);
    }


    public function delete(array $data)
    {
        $project = $this->equipmentPrefixRepository->delete($data['id']);

    }


}
