<?php

namespace App\Repositories;

use App\Models\Pco;
use App\Models\Project;
use App\Models\ServiceItem;
use App\Repositories\Interfaces\PcoRepositoryInterface;
// use Illuminate\Support\Facades\DB;

class PcoRepository implements PcoRepositoryInterface
{

    public function getAll()
    {
        $addresses = Pco::select(
            'pcos.id',
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



    public function getAddressByProject($project_id) {

        $project = Project::select(
            'projects.name',
            'projects.street',
            'projects.city',
            'projects.state',
            'projects.client_id',
            'projects.project_manager',
            'clients.name as client_name',
            'clients.email'
        )
        ->where('projects.id', $project_id)
        ->leftJoin('clients', 'clients.id', '=', 'projects.client_id')
        ->get();


        $return = array(
            'project' => $project,
        );

        return $return;

    }


    public function store($data)
    {
        return Pco::create($data)->id;
    }


    public function storeServiceItem($data)
    {
        return ServiceItem::create($data)->id;
    }

    // $offset = $request->input('perPage', 0) * ($request->input('page', 1) - 1);

    // DB::statement(DB::raw('set @row_number = 0'));

    // return $query->select([
    //         DB::raw("(@row_number:=@row_number + 1) + $offset AS num"),
    //         'your_table_name.*'
    // ]);


    public function getServiceItemByUser($user_id) {

        $servicItems = ServiceItem::select(
            'id',
            'identification_level',
            'item_description',
            'item_cost',
        )
        ->selectRaw('CONCAT(REPLACE(REPLACE(REPLACE(FORMAT(item_cost, 2),\',\',\';\'),\',\',\'.\'),\';\',\',\')) AS item_cost_en')
        ->selectRaw('CONCAT(REPLACE(REPLACE(REPLACE(FORMAT(item_cost, 2),\'.\',\';\'),\',\',\'.\'),\';\',\',\')) AS item_cost_br')
        ->selectRaw('CONCAT(level_01, \'.\', level_02, \'.\', level_03) AS level')
        ->where('user_id', $user_id)
        ->orderBy('item_number')
        ->get();

       return $servicItems;

    }



    public function edit($id)
    {

        $pco = Pco::where('id', $id)->get();

        $project = Project::select(
            'id',
        )
        ->selectRaw('CONCAT(projects.code, \' - \', projects.name) AS name')
        ->where('is_activated', 1)
        ->orderBy('name', 'asc')
        ->get();

        $result = array(
            'pco' => $pco,
            'projectCombo' => $project,
        );

        return $result;

    }


    public function delete($id)
    {
        $return = Pco::destroy($id);
        return $return;
    }


    public function deleteServiceItemByUser($user_id) {
        try {
            $return = ServiceItem::where("user_id", $user_id)
            ->where("pco_id", null)
            ->delete();
            return $return;
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


}
