<?php

namespace App\Services;

use App\Repositories\Interfaces\SupplyerRepositoryInterface;

class SupplyerService
{

    public function __construct(SupplyerRepositoryInterface $supplyerRepository)
    {
        $this->supplyerRepository = $supplyerRepository;
    }

    public function getAll()
    {
        return $this->supplyerRepository->getAll();
    }

    public function getDataToCreate()
    {
        return $this->supplyerRepository->getDataToCreate();
    }

    public function store(array $data)
    {
        // MAIN TABLE
        $supervisor = array(
            'name'              => $data['name'],
            'fantasy_name'      => $data['fantasy_name'],
            'document_number'   => $data['document_number'],

        );
        $supplyer_id = $this->supplyerRepository->store($supervisor);
        // end MAIN TABLE

    }

    public function edit($id) {
        return $this->supplyerRepository->edit($id);
    }


    public function update(array $data)
    {
        $supplyer = array(
            'id'                => $data['id'],
            'name'              => $data['name'],
            'fantasy_name'      => $data['fantasy_name'],
            'document_number'   => $data['document_number'],
        );
        $updateSupplyer = $this->supplyerRepository->update($supplyer);

    }

    public function delete(array $data)
    {
        $del = $this->supplyerRepository->delete($data['id']);

    }


}
