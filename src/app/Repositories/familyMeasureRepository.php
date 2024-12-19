<?php

namespace App\Repositories;
use App\Models\FamilyMeasure;

use App\Repositories\Interfaces\FamilyMeasureRepositoryInterface;

class FamilyMeasureRepository implements FamilyMeasureRepositoryInterface
{

  public function store($data)
  {
    return FamilyMeasure::create($data)->id;
  }

  public function deleteByFamilyMeasureId($id)
  {
    $familyMeasure = FamilyMeasure::where('equipment_family_id', $id)->delete();
    return  $familyMeasure;
  }




}
