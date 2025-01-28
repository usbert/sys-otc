<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RfiRepositoryInterface;
use App\Models\Project;
use App\Models\Rfi;
use App\Models\RfiOverview;
use Illuminate\Support\Facades\Auth;

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



    public function getRfiOverviewByUser($user_id) {

        $rfiOverview = RfiOverview::select(
            'rfi_overviews.id',
            'question',
            'sugestion',
            'client_answear',
            'users.name as from',
            'cost_impact',
            'schedule_impact',
            'deadline',
            'status',
        )
        ->selectRaw('lpad(rfi_overviews.id, 2, 0) as code')
        ->where('user_id', $user_id)
        ->where('rfi_id', null)
        ->leftJoin('users', 'users.id', '=', 'rfi_overviews.user_id')
        ->orderBy('id')
        ->get();

       return $rfiOverview;

    }


    public function storeRfiOverviewByUser($data)
    {
        return RfiOverview::create($data)->rfi_overview_id;
    }


    public function deleteRfiOverview($rfi_overview_id) {
        try {
            $return = RfiOverview::where("id", $rfi_overview_id)
            ->delete();
            return $return;
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


    public function getRfiOverview($rfi_overview_id) {

        try {

            $rfiOverview = RfiOverview::select(
               'rfi_id',
                'user_id',
                'question',
                'sugestion',
                'client_answear',
                'cost_impact',
                'schedule_impact',
                'deadline',
                'status'
            )
            ->where('id', $rfi_overview_id)
            ->get();

            return $rfiOverview;


        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


    public function updateRfiOverviewByUser(array $data)
    {
        try {

            $input                  = RfiOverview::find($data['rfi_overview']);
            $input->question        = $data['question'];
            $input->sugestion       = $data['sugestion'];
            $input->client_answear  = $data['client_answear'];
            $input->cost_impact     = $data['cost_impact'];
            $input->schedule_impact = $data['schedule_impact'];
            $input->deadline        = $data['deadline'];
            $input->status          = $data['status'];
            $input->user_id         = Auth::user()->id;

            $input->save();

            return $input;

        } catch (\Exception $e) {
            // dd($e);
            return response()->json(["error" => $e->getMessage()]);
        }

    }

    public function store($data)
    {
        return Rfi::create($data)->id;

    }



    public function updateOverviewFilled(array $data)
    {
        try {

            RfiOverview::where('user_id', $data['user_id'])
            ->whereNull('rfi_id')
            ->update([
                'rfi_id' => $data['rfi_id']
              ]
            );

        } catch (\Exception $e) {
             dd($e);
            return response()->json(["error" => $e->getMessage()]);
        }


    }




    // Clear all temporary RFI Overviews records
    public function deleteRfiOverviewByUser($user_id) {
        try {
            $return = RfiOverview::where("user_id", $user_id)
            ->delete();
            return $return;
        } catch (\Exception $e) {
            dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


}

