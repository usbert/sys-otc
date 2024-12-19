<?php

namespace App\Repositories;

use App\Models\MeasurementUnit;
use App\Repositories\Interfaces\MeasurementUnitRepositoryInterface;

class MeasurementUnitRepository implements MeasurementUnitRepositoryInterface
{
  public function getAll()
  {
    $measurementUnit = MeasurementUnit::get();

    return $measurementUnit;

  }

  public function find($id)
  {
    return false;
  }

  public function create(array $data)
  {
    $result = MeasurementUnit::create($data);
    return $result;

  }

  public function update($id, $data)
  {
    dd('CHEGOU NO UPDATE');
    return false;
  }

  public function delete($id)
  {
    dd('CHEGOU NO DELETE');
    return false;
  }
}
