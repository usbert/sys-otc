<?php

namespace App\Services;

use App\Repositories\Interfaces\ContractRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ContractService
{

    public function __construct(ContractRepositoryInterface $contractRepository)
    {
        $this->contractRepository = $contractRepository;
    }

    public function getAll()
    {
        return $this->contractRepository->getAll();
    }

    public function getDataToCreate()
    {
        return $this->contractRepository->getDataToCreate();
    }

    public function getEquipmentContract()
    {
        return $this->contractRepository->getEquipmentContract();
    }


    public function store(array $data)
    {
        // MAIN TABLE

        if($data['type'] == 1) {

            $contract_number = $data['contract_number'];
            $contract_year   = $data['contract_year'];
            $order_number           = null;
            $order_year      = null;

        } else if($data['type'] == 2) {

            $contract_number = null;
            $contract_year   = null;
            $order_number    = $data['order_number'];
            $order_year      = $data['order_year'];
        }

        $contract = array(
            'supplyer_id'           => $data['supplyer_id'],
            'project_id'            => $data['project_id'],
            'contract_number'       => $contract_number,
            'contract_year'         => $contract_year,
            'order_number'          => $order_number,
            'order_year'            => $order_year,
            'contract_start_date'   => $data['contract_start_date'],
            'contract_end_date'     => $data['contract_end_date'],
            'user_id' => Auth::user()->id,
        );

        $contract_id = $this->contractRepository->store($contract);
        // end MAIN TABLE

    }


    public function getContractBySupplyer($supplyer_id, $vehicle_id) {
        return $this->contractRepository->getContractBySupplyer($supplyer_id, $vehicle_id);
    }


    // public function edit($id) {
    //     return $this->contractRepository->edit($id);
    // }

    // public function update(array $data)
    // {
    //     $contracts = array(
    //         'id'    => $data['id'],
    //         'name'  => $data['name']
    //     );
    //     $updateContract = $this->contractRepository->update($contracts);

    // }

    // public function delete(array $data)
    // {
    //     $project = $this->contractRepository->delete($data['id']);

    // }

}
