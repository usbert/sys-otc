<?php

namespace App\Repositories;

use App\Models\Pco;
use App\Repositories\Interfaces\PcoRepositoryInterface;

class PcoRepository implements PcoRepositoryInterface
{

    public function getAll()
    {
        $addresses = Pco::select(

            'pcos.id',
            'clients.name as cg',
            'pcos.responsible',
            'pcos.description',
        )
        ->where('pcos.is_activated', Pco::ACTIVATED)
        ->leftJoin('projects', 'projects.id', '=', 'pcos.project_id')
        ->leftJoin('clients', 'clients.id', '=', 'projects.client_id')
        ->get();

        return $addresses;

    }

    public function getDataToCreate()
    {
        // $project = Project::select('id', 'short_name')
        // ->where('is_activated', 1)
        // ->orderBy('short_name', 'asc')
        // ->get();


        // $return = array(
        //     'projectCombo' => $project,
        //     'supplyerCombo' => $supplyerCombo,
        // );

        return $return;
    }

}
