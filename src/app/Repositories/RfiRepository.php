<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RfiRepositoryInterface;
use App\Models\Project;
use App\Models\Rfi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class RfiRepository implements RfiRepositoryInterface
{

    public function getAll()
    {
        $addresses = Rfi::select(
            'rfis.id',
            'rfis.reference',
            'users.name as received_from',
            'rfis.rfi_date',
            'projects.contract_number',
            'projects.name as contract_name',
            'schedule_impact',
            'status',
        )
        ->selectRaw('lpad(rfis.id, 5, 0) as code')
        ->leftJoin('users', 'users.id', '=', 'rfis.received_from')
        ->leftJoin('projects', 'projects.id', '=', 'rfis.project_id')
        ->where('rfis.is_activated', Rfi::ACTIVATED)
        ->get();

        return $addresses;

    }

    public function getDataToCreate()
    {
        $projectCombo   = Project::select('id','name')->
        where('is_activated', Project::ACTIVATED)
        ->orderBy('name', 'asc')
        ->get();

        $return = array(
            'projectCombo'  => $projectCombo,
        );

        return $return;

    }


}

