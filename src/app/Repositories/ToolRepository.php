<?php

namespace App\Repositories;

use App\Models\Discipline;
use App\Models\Material;
use App\Models\Tool;
use App\Repositories\Interfaces\ToolRepositoryInterface;

class ToolRepository implements ToolRepositoryInterface
{

    public function getAll()
    {
        $materialts = Tool::select(
            'tools.id',
            'tools.name',
            'tools.application',
            'tools.serial_number',
            'tools.category',
            'tools.voltage',
            'brands.name as brand_name',
        )
        ->selectRaw('lpad(tools.id, 5, 0) as code')
        ->where('tools.is_activated', Tool::ACTIVATED)
        ->leftJoin('brands', 'brands.id', '=', 'tools.brand_id')

        ->get();

        return $materialts;

    }


    public function getDataToCreate()
    {
        $materialCombo = Material::select('id', 'name')->orderBy('name', 'asc')->get();
        $disciplineCombo = Discipline::select('id', 'name')->orderBy('name', 'asc')->get();

        $return = array(
            'materialCombo' => $materialCombo,
            'disciplineCombo' => $disciplineCombo,
        );

        return $return;

    }




}
