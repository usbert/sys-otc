<?php

namespace App\Services;

use App\Repositories\Interfaces\FieldActivityRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class FieldActivityService
{

    public function __construct(
        FieldActivityRepositoryInterface $fieldActivityRepository
            ) {
        $this->fieldActivityRepository = $fieldActivityRepository;
    }

    public function getAll()
    {
        return $this->fieldActivityRepository->getAll();
    }

    // public function find($id) {
    //     return $this->fieldActivityRepository->find($id);
    // }

    public function edit($id) {
        return $this->fieldActivityRepository->edit($id);
    }

    // public function getDataToCreate()
    // {
    //     return $this->fieldActivityRepository->getDataToCreate();
    // }


    public function store(array $data)
    {
        $activity = array(
            'code' => $data['code'],
            'name' => $data['name'],
        );
        $fieldActivity = $this->fieldActivityRepository->store($activity);

    }


    public function update(array $data)
    {
        $activities = array(
            'id'                 => $data['id'],
            'code'               => $data['code'],
            'name'               => $data['name'],
        );

        $updateFieldActivity = $this->fieldActivityRepository->update($activities);

    }


    public function delete(array $data)
    {
        $fieldActivity = $this->fieldActivityRepository->delete($data['id']);

    }

}
