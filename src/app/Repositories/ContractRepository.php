<?php

namespace App\Repositories;

use App\Models\Contract;
use App\Models\EquipmentContract;
use App\Models\MobilizationHistoric;
use App\Models\Project;
use App\Models\Supplyer;
use App\Repositories\Interfaces\ContractRepositoryInterface;

class ContractRepository implements ContractRepositoryInterface
{
  public function getAll()
  {
    $contracts = Contract::select(
        'contracts.id',
        'supplyers.name as supplyer_name',
        'supplyers.document_number',
	    'projects.short_name as project_short_name',
        'contract_number',
        'contract_start_date',
        'contract_end_date',
        'order_number',
        'order_year'
    )
    ->selectRaw('CONCAT(contract_number, \'-\', contract_year) AS contract_number_and_year')
    ->selectRaw('CONCAT(order_number, \'-\', order_year) AS order_and_year')
    ->where('contracts.is_activated', Contract::ACTIVATED)
    ->join('supplyers', 'supplyers.id', '=', 'contracts.supplyer_id')
    ->join('projects', 'projects.id', '=', 'contracts.project_id')
    // ->orderBy('mobilization_historics.mobilization_date')
    ->get();

    return $contracts;


  }

    public function getDataToCreate()
    {
        $supplyerCombo = Supplyer::orderBy('name', 'asc')->get();

        $project = Project::select('id', 'short_name')
        ->where('is_activated', 1)
        ->orderBy('short_name', 'asc')
        ->get();


        $return = array(
            'projectCombo' => $project,
            'supplyerCombo' => $supplyerCombo,
        );

        return $return;
    }

    public function store($data)
    {
      return Contract::create($data)->id;
    }


    public function getEquipmentContract()
    {
        $supplyerCombo = Supplyer::orderBy('name', 'asc')->get();

        $return = array(
            'supplyerCombo' => $supplyerCombo,
        );

        return $return;

    }

    public function edit($id)
    {

        $contract = Contract::where('id', $id)->get();
        $result = array(
            'contract' => $contract,
        );

        return $result;

    }


    public function update(array $data)
    {

        try {

            $input              = Contract::find($data['id']);
            $input->name        = $data['name'];
            $input->save();

            return $input;

        } catch (\Exception $e) {
            // dd($e);
            return response()->json(["error" => $e->getMessage()]);
        }

    }


    public function getContractBySupplyer($supplyer_id, $vehicle_id)
    {
        // select 	contracts.id,
        //         equipment_contracts.id,
        //         contracts.project_id,
        //         contracts.contract_number,
        //         equipment_contracts.contract_value,
        //         equipment_contracts.mobilization_value,
        //         equipment_contracts.demobilization_value
        // from contracts
        // inner join supplyers on supplyers.id = contracts.supplyer_id
        // left join equipment_contracts on (equipment_contracts.contract_id = contracts.id
        //     and equipment_contracts.vehicle_id = 1107)
        // where contracts.is_activated = 1
        // and contracts.supplyer_id = 240
        // -- and equipment_contracts.vehicle_id = 1107
        // and contracts.deleted_at is null
        // and equipment_contracts.id is not null


        $contracts = Contract::select(
            'contracts.id',
            'eqc1.id',
            'supplyers.name as supplyer_name',
            'contract_start_date',
            'contract_end_date',
            'eqc1.contract_value',
            'eqc1.mobilization_value',
            'eqc1.demobilization_value',
        )
        ->selectRaw('CONCAT(contract_number, \'/\', contract_year) AS contract_number_and_year')
        ->selectRaw('CONCAT(order_number, \'/\', order_year) AS order_and_year')
        ->join('supplyers', 'supplyers.id', '=', 'contracts.supplyer_id')
        ->join('projects', 'projects.id', '=', 'contracts.project_id')

        ->leftJoin('equipment_contracts as eqc1', 'eqc1.contract_id', '=', 'contracts.id')
            // and (eqc1.vehicle_id = ".$vehicle_id." and eqc1.is_activated = 1)

        ->where('contracts.supplyer_id', $supplyer_id)
        ->get();



        // >leftJoin('bookings', function($join) use ($param1, $param2) {
        //     $join->on('rooms.id', '=', 'bookings.room_type_id');
        //     $join->on(function($query) use ($param1, $param2) {
        //         $query->on('bookings.arrival', '=', $param1);
        //         $query->orOn('departure', '=',$param2);
        //     });
        // })

        // $contracts = EquipmentContract::select(
        //     'equipment_contracts.id',
        //     'supplyers.name as supplyer_name',
        //     'supplyers.document_number',
        //     'projects.short_name as project_short_name',
        //     'contract_start_date',
        //     'contract_end_date',
        //     'equipment_contracts.contract_value',
		// 	'equipment_contracts.mobilization_value',
		// 	'equipment_contracts.demobilization_value',
        // )
        // ->selectRaw('CONCAT(contract_number, \'/\', contract_year) AS contract_number_and_year')
        // ->selectRaw('CONCAT(order_number, \'/\', order_year) AS order_and_year')
        // ->join('contracts', 'contracts.id', '=', 'equipment_contracts.contract_id')
        // ->join('supplyers', 'supplyers.id', '=', 'contracts.supplyer_id')
        // ->join('projects', 'projects.id', '=', 'contracts.project_id')
        // ->where('equipment_contracts.vehicle_id', $vehicle_id)
        // ->get();

        // TESTE COM SUBQUERY
        // ->whereIn('mobilization_historics.project_id', MobilizationHistoric::select(['project_id'])
        //     ->where('vehicle_id', '=', 1619)
        //     ->where('project_id', '=', 29)
        // )
        // ->groupBy('contracts.id')

        return $contracts;

  }



    public function delete($id)
    {
        $return = Contract::destroy($id);
        return $return;
    }


}
