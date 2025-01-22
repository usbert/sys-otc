<?php

namespace App\Services;

use App\Repositories\Interfaces\PcoRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

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

        if(empty($data['item_cost'])) {
            $item_cost = null;

        } else {
            if(Config::get('app.locale') == 'en') {
                $item_cost = Parse_money_database_en($data['item_cost']);
            } else {
                $item_cost = Parse_money_database_br($data['item_cost']);
            }

        }

        $item_number = str_pad($data['level_01'], 3, "0", STR_PAD_LEFT).str_pad($data['level_02'], 3, "0", STR_PAD_LEFT);

        if($data['level_02'] > 0) {
            $identification_level = 2;
        } else {
            $identification_level = 1;
        }

        $service_item = array(
            'level_01'              => $data['level_01'],
            'level_02'              => $data['level_02'],
            'identification_level'  => $identification_level,
            'item_number'           => $item_number,
            'item_description'      => $data['item_description'],
            'item_cost'             => $item_cost,
            'user_id'               => Auth::user()->id,
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


    public function deleteServiceItemByUser(array $data)
    {
        $del = $this->pcoRepository->deleteServiceItemByUser($data['user_id']);
    }


    public function updateServiceItem(array $data)
    {

        if(empty($data['item_cost'])) {
            $item_cost = null;

        } else {
            if(Config::get('app.locale') == 'en') {
                $item_cost = Parse_money_database_en($data['item_cost']);
            } else {
                $item_cost = Parse_money_database_br($data['item_cost']);
            }

        }

        $item_number = str_pad($data['level_01'], 3, "0", STR_PAD_LEFT).str_pad($data['level_02'], 3, "0", STR_PAD_LEFT);

        if($data['level_02'] > 0) {
            $identification_level = 2;
        } else {
            $identification_level = 1;
        }

        $service_item = array(

            'service_item_id'       => $data['service_item_id'],
            'level_01'              => $data['level_01'],
            'level_02'              => $data['level_02'],
            'identification_level'  => $identification_level,
            'item_number'           => $item_number,
            'item_description'      => $data['item_description'],
            'item_cost'             => $item_cost,
            'user_id'               => Auth::user()->id,

        );

        $updateServiceItem = $this->pcoRepository->updateServiceItem($service_item);

    }


    public function deleteServiceItem(array $data)
    {
        $pcoServiceItem = $this->pcoRepository->deleteServiceItem($data['id']);

    }


    public function deleteLaborAppropriation(array $data)
    {
        $del = $this->pcoRepository->deleteLaborAppropriation($data['id']);
    }


    public function storeLaborAppropriation(array $data)
    {
        if(Config::get('app.locale') == 'en') {
            $hours = Parse_money_database_en($data['hours']);
            $rate = Parse_money_database_en($data['rate']);
        } else {
            $hours = Parse_money_database_br($data['hours']);
            $rate = Parse_money_database_br($data['rate']);
        }

        $laborAppropriation = array(
            'service_item_id'   => $data['service_item_labor'],
            'employee_role_id'  => $data['employee_role_id'],
            'hours'             => $hours,
            'rate'              => $rate,
            'status'            => 1,
            'user_id'           => Auth::user()->id,
        );


        $laborAppropriation_id = $this->pcoRepository->storeLaborAppropriation($laborAppropriation);
    }



    public function updateLaborAppropriation(array $data)
    {

        dd('chegou na alteração service', $data);

        // if(Config::get('app.locale') == 'en') {
        //     $rate = Parse_money_database_en($data['rate']);
        //     $hours = Parse_money_database_en($data['hours']);
        // } else {
        //     $rate = Parse_money_database_br($data['rate']);
        //     $hours = Parse_money_database_br($data['hours']);
        // }

        // $laborAppropriation = array(

        //     'employee_role_id'  => $data['employee_role_id'],
        //     'hours'             => $hours,
        //     'rate'              => $rate,
        //     'status'            => 1,
        //     'user_id'           => Auth::user()->id
        // );

        // $updateLaborAppropriation = $this->pcoRepository->updateLaborAppropriation($laborAppropriation);

    }



    public function getLaborAppropriationByUser($service_item_id, $user_id)
    {
        return $this->pcoRepository->getLaborAppropriationByUser($service_item_id, $user_id);
    }





}
