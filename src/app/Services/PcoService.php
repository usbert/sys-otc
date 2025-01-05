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



    public function edit($id) {
        return $this->pcoRepository->edit($id);
    }


    public function delete(array $data)
    {
        $project = $this->pcoRepository->delete($data['id']);

    }


}
