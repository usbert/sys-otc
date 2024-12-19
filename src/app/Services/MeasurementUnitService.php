<?php

namespace App\Services;

use App\Repositories\Interfaces\MeasurementUnitRepositoryInterface;
use App\DTO\MeasurementUnitDTO;

class MeasurementUnitService
{

    public function __construct(MeasurementUnitRepositoryInterface $measurementUnitRepository)
    {
        $this->measurementUnitRepository = $measurementUnitRepository;
    }

    public function getAll()
    {
        return $this->measurementUnitRepository->getAll();
    }

    public function find($id) {
        return $this->measurementUnitRepository->find($id);
    }

    public function create(MeasurementUnitDTO $dto)
    {
        return $this->measurementUnitRepository->create(get_object_vars($dto));
    }


    public function update(array $data, $id)
    {
        return false;
    }

    public function delete($id)
    {
        return false;
    }




}
