<?php

namespace App\Repositories;

use App\Models\Pco;
use App\Models\Project;
use App\Repositories\Interfaces\PcoRepositoryInterface;

class PcoRepository implements PcoRepositoryInterface
{

    public function getAll()
    {
        $addresses = Pco::select(
            'clients.name as client_name',
            'pcos.responsible',
            'pcos.description',
        )
        ->selectRaw('lpad(pcos.id, 5, 0) as code')
        ->where('pcos.is_activated', Pco::ACTIVATED)
        ->leftJoin('projects', 'projects.id', '=', 'pcos.project_id')
        ->leftJoin('clients', 'clients.id', '=', 'projects.client_id')
        ->get();

        return $addresses;

    }


    public function getDataToCreate()
    {
        $project = Project::select(
            'id',
        )
        ->selectRaw('CONCAT(projects.code, \' - \', projects.name) AS name')
        ->where('is_activated', 1)
        ->orderBy('name', 'asc')
        ->get();

        $return = array(
            'projectCombo' => $project,
        );

        return $return;
    }

}
