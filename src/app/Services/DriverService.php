<?php

namespace App\Services;

use App\Repositories\Interfaces\DriverRepositoryInterface;

class DriverService
{

    public function __construct(DriverRepositoryInterface $driverRepository)
    {
        $this->driverRepository = $driverRepository;
    }

    public function getAll()
    {
        return $this->driverRepository->getAll();
    }

    public function find($id) {
        return $this->driverRepository->find($id);
    }

    public function getDataToCreate()
    {
        return $this->driverRepository->getDataToCreate();
    }

    public function store(array $data)
    {

        $driver = array(
            'name'         => $data['name'],
            'registration' => $data['registration'],
            'function'     => $data['function'],
            'project_id'   => $data['project_id'],
        );

        // SALVA E RETORNANDO O ID
        // $driverRepository = $this->driverRepository->store($driver);
       $this->driverRepository->store($driver);


    }

    public function edit($id) {
        return $this->driverRepository->edit($id);
    }

    public function update(array $data)
    {

        $driver = array(
            'id'            => $data['id'],
            'name'          => $data['name'],
            'registration'  => $data['registration'],
            'function'      => $data['function'],
            'project_id'    => $data['project_id'],

        );

        $updatedriver = $this->driverRepository->update($driver);

    }

    public function delete(array $data)
    {
        $project = $this->driverRepository->delete($data['id']);

    }

}
