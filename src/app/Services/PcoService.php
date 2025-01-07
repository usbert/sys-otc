<?php

namespace App\Services;

use App\Repositories\Interfaces\PcoRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class PcoService
{

    public function __construct(PcoRepositoryInterface $pcoRepository)
    {
        $this->pcoRepository = $pcoRepository;
    }

    public function getAll()
    {
        return $this->pcoRepository->getAll();
    }


    public function getDataToCreate()
    {
        return $this->pcoRepository->getDataToCreate();
    }


    public function getAddressByProject($project_id) {
        return $this->pcoRepository->getAddressByProject($project_id);
    }



    public function store(array $data)
    {

        // MAIN TABLE

        // if(!empty($data['contract_value'])) {
        //     $contract_value = Parse_money_database_br($data['contract_value']);
        // } else {
        //     $contract_value = null;
        // }

        $pco = array(
            'project_id'    => $data['project_id'],
            'client_id'     => $data['client_id'],
            'pco_date'      => $data['pco_date'],
            'description'   => $data['description'],
            'responsible'   => $data['project_manager'],

        );
        $pco_id = $this->pcoRepository->store($pco);


        // end MAIN TABLE

    }


    public function storeServiceItem(array $data)
    {
        if(!empty($data['item_cost'])) {
            $item_cost = Parse_money_database_br($data['item_cost']);
        } else {
            $item_cost = null;
        }

        $item_number = str_pad($data['level_01'], 3, "0", STR_PAD_LEFT).str_pad($data['level_02'], 3, "0", STR_PAD_LEFT).str_pad($data['level_03'], 3, "0", STR_PAD_LEFT);

        $service_item = array(
            'level_01'          => $data['level_01'],
            'level_02'          => $data['level_02'],
            'level_03'          => $data['level_03'],
            'item_number'       => $item_number,
            'item_description'  => $data['item_description'],
            'item_cost'         => $item_cost,
            'user_id'           => Auth::user()->id,
        );
        $service_item_id = $this->pcoRepository->storeServiceItem($service_item);
    }


    public function getServiceItemByUser($user_id) {
        return $this->pcoRepository->getServiceItemByUser($user_id);
    }


    public function edit($id) {
        return $this->pcoRepository->edit($id);
    }


    public function delete(array $data)
    {
        $project = $this->pcoRepository->delete($data['id']);

    }


}
