<?php

namespace App\Repositories;

use App\Models\Material;
use App\Repositories\Interfaces\MaterialRepositoryInterface;

class MaterialRepository implements MaterialRepositoryInterface
{
  public function getAll()
  {
    $materialts = Material::select(
        'materials.id',
        'disciplines.name as discipline',
        'materials.name',
        'brands.name as brand_name',
        'measurement_units.name as measurement_unit_name',
    )
    ->selectRaw('lpad(materials.id, 5, 0) as code')
    ->where('materials.is_activated', Material::ACTIVATED)
    ->leftJoin('brands', 'brands.id', '=', 'materials.brand_id')
    ->leftJoin('disciplines', 'disciplines.id', '=', 'materials.discipline_id')
    ->join('measurement_units', 'measurement_units.id', '=', 'materials.measurement_unit_id')
    ->get();

    return $materialts;

  }


}
