<?php

namespace App\Services;

use App\Repositories\Interfaces\ProjectRepositoryInterface;
use App\Repositories\Interfaces\ProjectActivityRepositoryInterface;
use App\Repositories\Interfaces\ProjectSupervisorRepositoryInterface;
use App\Repositories\Interfaces\ProjectClientRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ProjectService
{

    public function __construct(
        ProjectRepositoryInterface $projectRepository,
        ProjectActivityRepositoryInterface $projectActivityRepository,
        ProjectSupervisorRepositoryInterface $projectSupervisorRepository,
        ProjectClientRepositoryInterface $projectClientRepository,
    ) {
        $this->projectRepository = $projectRepository;
        $this->projectActivityRepository = $projectActivityRepository;
        $this->projectSupervisorRepository = $projectSupervisorRepository;
        $this->projectClientRepository = $projectClientRepository;
    }

    public function getAll()
    {
        return $this->projectRepository->getAll();
    }

    // public function find($id) {
    //     return $this->projectRepository->find($id);
    // }

    public function edit($id) {
        return $this->projectRepository->edit($id);
    }

    public function getDataToCreate()
    {
        return $this->projectRepository->getDataToCreate();
    }


    public function store(array $data)
    {

        // MAIN TABLE

        if(!empty($data['contract_value'])) {
            $contract_value = Parse_money_database_br($data['contract_value']);
        } else {
            $contract_value = null;
        }

        $project = array(
            'code'              => $data['code'],
            'name'              => $data['name'],
            'contract_number'   => $data['contract_number'],
            'client_id'         => $data['client_id'],
            'project_manager'   => $data['project_manager'],
            'trade_id'          => $data['trade_id'],
            'signature_date'    => $data['signature_date'],
            'start_date'        => $data['start_date'],
            'finish_date'       => $data['finish_date'],
            'contract_value'    => $contract_value,

            'street'            => $data['street'],
            'city'              => $data['city'],
            'state'             => $data['state'],
            'country'           => $data['country'],
            'zip_code'          => $data['zip_code'],

        );
        $project_id = $this->projectRepository->store($project);


        // end MAIN TABLE

    }


    public function update(array $data)
    {

        // if(!empty($data['contract_value'])) {
        //     $contract_value = Parse_money_database_br($data['contract_value']);
        // } else {
        //     $contract_value = null;
        // }

        $project = array(
            'id'                => $data['id'],
            'code'              => $data['code'],
            'name'              => $data['name'],
            'contract_number'   => $data['contract_number'],
            'client_id'         => $data['client_id'],
            'project_manager'   => $data['project_manager'],
            'trade_id'          => $data['trade_id'],
            'signature_date'    => $data['signature_date'],
            'start_date'        => $data['start_date'],
            'finish_date'       => $data['finish_date'],
            // 'contract_value'    => $contract_value,

            'street'            => $data['street'],
            'city'              => $data['city'],
            'state'             => $data['state'],
            'country'           => $data['country'],
            'zip_code'          => $data['zip_code'],

        );

        $updateProject = $this->projectRepository->update($project);

    }


    public function delete(array $data)
    {
        $project = $this->projectRepository->delete($data['id']);

    }

}
