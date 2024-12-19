<?php

namespace App\Services;

use App\Repositories\Interfaces\SupervisorRepositoryInterface;

class SupervisorService
{

    public function __construct(SupervisorRepositoryInterface $supervisorRepository)
    {
        $this->supervisorRepository = $supervisorRepository;
    }

    public function getAll()
    {
        return $this->supervisorRepository->getAll();
    }

    // public function create(array $data)
    // {
    //     return false;
    // }

    public function store(array $data)
    {
        // MAIN TABLE
        $supervisor = array(
            'name' => $data['name'],
        );
        $supervisor_id = $this->supervisorRepository->store($supervisor);
        // end MAIN TABLE

    }

    public function edit($id) {
        return $this->supervisorRepository->edit($id);
    }

    public function update(array $data)
    {
        $supervisors = array(
            'id'    => $data['id'],
            'name'  => $data['name']
        );
        $updateSupervisor = $this->supervisorRepository->update($supervisors);

    }

    public function delete(array $data)
    {
        $project = $this->supervisorRepository->delete($data['id']);

    }

}
