<?php

namespace App\Services;

use App\Repositories\Interfaces\ProjectLocationRepositoryInterface;

class ProjectLocationService
{

    public function __construct(ProjectLocationRepositoryInterface $projectLocationRepository)
    {
        $this->projectLocationRepository = $projectLocationRepository;
    }

    public function getAll()
    {
        return $this->projectLocationRepository->getAll();
    }

    public function find($id) {
        return $this->projectLocationRepository->find($id);
    }

    public function getDataToCreate()
    {
        return $this->projectLocationRepository->getDataToCreate();
    }

    public function store(array $data)
    {
        // MAIN TABLE
        $projectLocation = array(
            'name'       => $data['name'],
            'project_id' => $data['project_id'],
        );
        $project_id = $this->projectLocationRepository->store($projectLocation);
        // end MAIN TABLE

    }

    public function edit($id) {
        return $this->projectLocationRepository->edit($id);
    }

    public function update(array $data)
    {
        $projectLocation = array(
            'id'         => $data['id'],
            'name'       => $data['name'],
            'project_id' => $data['project_id'],

        );

        $updateProjectLocation = $this->projectLocationRepository->update($projectLocation);
    }

    public function delete(array $data)
    {
        $project = $this->projectLocationRepository->delete($data['id']);

    }

}
