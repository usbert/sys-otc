<?php

namespace App\Repositories;

use App\Models\EmployeeRole;
use App\Models\LaborAppropriation;
use App\Models\Pco;
use App\Models\Project;
use App\Models\Rfi;
use App\Models\ServiceItem;
use App\Repositories\Interfaces\PcoRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

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

        $employee_role = EmployeeRole::select(
            'id',
            'name',
        )
        ->where('is_activated', 1)
        ->orderBy('name', 'asc')
        ->get();



        $rfi = Rfi::select(
            'id',
        )
        ->selectRaw('lpad(id, 5, 0) as code')
        ->get();

        $return = array(
            'projectCombo'      => $project,
            'employeeRoleCombo' => $employee_role,
            'rfiCombo'          => $rfi,
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
        ->selectRaw('CONCAT(level_01, \'.\', level_02) AS level')
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



    public function updateServiceItem(array $data)
    {
        try {

            $input                          = ServiceItem::find($data['service_item_id']);
            $input->level_01                = $data['level_01'];
            $input->level_02                = $data['level_02'];
            $input->identification_level    = $data['identification_level'];
            $input->item_description        = $data['item_description'];
            $input->item_number             = $data['item_number'];
            $input->item_description        = $data['item_description'];
            // $input->item_cost               = $data['item_cost'];
            $input->user_id                 = Auth::user()->id;


            $input->save();

            return $input;

        } catch (\Exception $e) {
            // dd($e);
            return response()->json(["error" => $e->getMessage()]);
        }

    }

    public function deleteServiceItem($id)
    {
        $return = ServiceItem::destroy($id);
        return $return;
    }


    public function getLaborAppropriationByUser($service_item_id, $user_id) {

        $laborAppropriation = LaborAppropriation::select(
            'labor_appropriations.id',
            'labor_appropriations.employee_role_id',
            'employee_roles.name as employee_role_name',
        )
        ->selectRaw('CONCAT(REPLACE(REPLACE(REPLACE(FORMAT(hours, 2),\',\',\';\'),\',\',\'.\'),\';\',\',\')) AS hours')
        ->selectRaw('CONCAT(REPLACE(REPLACE(REPLACE(FORMAT(rate, 2),\',\',\';\'),\',\',\'.\'),\';\',\',\')) AS rate')
        ->selectRaw('CONCAT(REPLACE(REPLACE(REPLACE(FORMAT((hours * rate), 2),\',\',\';\'),\',\',\'.\'),\';\',\',\')) AS subtotal')
        ->where('service_item_id', $service_item_id)
        ->where('user_id', $user_id)
        ->where('labor_appropriations.pco_id', '=', null)
        ->leftJoin('employee_roles', 'employee_roles.id', '=', 'labor_appropriations.employee_role_id')
        ->orderBy('employee_role_name')
        ->get();

       return $laborAppropriation;

    }





    public function storeLaborAppropriation($data)
    {
        return LaborAppropriation::create($data)->service_item_id;
    }

    public function updateLaborAppropriation(array $data)
    {
        try {

            $input                      = LaborAppropriation::find($data['labor_appropriation_id']);
            $input->employee_role_id   = $data['employee_role_id'];
            $input->hours              = $data['hours'];
            $input->rate               = $data['rate'];
            $input->status             = $data['status'];
            $input->user_id            = Auth::user()->id;

            $input->save();

            return $input;

        } catch (\Exception $e) {
            // dd($e);
            return response()->json(["error" => $e->getMessage()]);
        }

    }


    // ATUALIZA O TOTAL NO SERVICE ITENS (SOMA DOS LABOR APPROPRIATIONS)

    public function updateItemCostServiceItem(array $dataItemCost)
    {
        try {

            $somaSI = LaborAppropriation::select(
                'service_item_id',
            )
            ->selectRaw('CONCAT(REPLACE(REPLACE(REPLACE(FORMAT(sum(hours * rate), 2),\',\',\';\'),\',\',\'.\'),\';\',\',\')) AS total')
            ->where('service_item_id', $dataItemCost['service_item_id'])
            ->groupBY('service_item_id')
            ->get();

            if(Config::get('app.locale') == 'en') {
                $item_cost = Parse_money_database_en($somaSI[0]['total']);
            } else {
                $item_cost = Parse_money_database_br($somaSI[0]['total']);
            }

            $input = ServiceItem::find($dataItemCost['service_item_id']);
            $input->item_cost = $item_cost;
            $input->save();

            return $input;

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()]);
        }

    }



    public function deleteLaborAppropriation($id)
    {
        $return = LaborAppropriation::destroy($id);
        return $return;
    }

}

