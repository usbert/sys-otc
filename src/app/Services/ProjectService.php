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
        $project = array(
            'short_name'    => $data['short_name'],
            'name'          => $data['name'],
            'prefix_code'   => $data['prefix_code'],
            'cost_center'   => $data['cost_center'],
        );
        $project_id = $this->projectRepository->store($project);
        // end MAIN TABLE


        // PIVOT TABLES

        // ATIVIDADES DO PROJETO (field_activities)
        if(!empty($data['field_activity'])) {

            $arrayFieldActivities = [];

            foreach ($data['field_activity'] as $rows =>$key) {

                $arrayFieldActivities['project_id'] = $project_id;
                $arrayFieldActivities['field_activity_id'] = $key;

                //  SALVAR EM project_ativities JUNTO COM O CÓDIGO DO PROJETO
                $this->projectActivityRepository->store($arrayFieldActivities);

            }
        }

         // SALVAR CÓDIGOS DO PROJETO + CÓDIGO DOS SUPERVISORES
         // project_supervisors (tbl_supervisor_projeto)
         if(!empty($data['supervisor'])) {

            $arrayProjectSupervisors = [];

            foreach ($data['supervisor'] as $rows =>$key) {

                $arrayProjectSupervisors['project_id'] = $project_id;
                $arrayProjectSupervisors['supervisor_id'] = $key;

            //  SALVAR EM project_supervisors JUNTO COM O CÓDIGO DO PROJETO
                $this->projectSupervisorRepository->store($arrayProjectSupervisors);

            }

        }


        if(!empty($data['multipleClients'])) {

            $arrayClientProjects = [];

            foreach ($data['multipleClients'] as $rows =>$key) {

                $arrayClientProjects['project_id'] = $project_id;
                $arrayClientProjects['client_id'] = $key;

            //  SALVAR EM project_clients JUNTO COM O CÓDIGO DO PROJETO
                $this->projectClientRepository->store($arrayClientProjects);

            }

        }

        // end PIVOT TABLES


    }


    public function update(array $data)
    {

        $projects = array(
            'id'          => $data['id'],
            'short_name'  => $data['short_name'],
            'name'        => $data['name'],
            'prefix_code' => $data['prefix_code'],
            'cost_center' => $data['cost_center'],

        );

        $updateProject = $this->projectRepository->update($projects);

        // EXCLUIR AS ATIVIDADES DO PROJETO
        $projectActivity = $this->projectActivityRepository->deleteByProjectActivityId($data['id']);

        // SALVAR NOVAMENTE ATIVIDADES DO PROJETO
        if(!empty($data['field_activity'])) {

            $arrayFieldActivities = [];

            foreach ($data['field_activity'] as $rows =>$key) {

                $arrayFieldActivities['project_id'] = $data['id'];
                $arrayFieldActivities['field_activity_id'] = $key;

                //  SALVAR EM project_ativities JUNTO COM O CÓDIGO DO PROJETO
                $this->projectActivityRepository->store($arrayFieldActivities);

            }
        }


        // EXCLUIR E SALVAR SUPERVISORES
        $projectSupervisor = $this->projectActivityRepository->deleteByProjectSupervisorById($data['id']);

        // SALVAR NOVAMENTE SUPERVISORES
         if(!empty($data['supervisor'])) {

            $arrayProjectSupervisors = [];

            foreach ($data['supervisor'] as $rows =>$key) {

                $arrayProjectSupervisors['project_id'] = $data['id'];
                $arrayProjectSupervisors['supervisor_id'] = $key;

            //  SALVAR EM project_ativities JUNTO COM O CÓDIGO DO PROJETO
                $this->projectSupervisorRepository->store($arrayProjectSupervisors);

            }

        }



         // EXCLUIR E CLIENTES DO PROJETO
         $projectClient = $this->projectClientRepository->deleteByProjectClientById($data['id']);

         if(!empty($data['multipleClients'])) {

            $arrayClientProjects = [];

            foreach ($data['multipleClients'] as $rows =>$key) {

                $arrayClientProjects['project_id'] = $data['id'];
                $arrayClientProjects['client_id'] = $key;

            //  SALVAR EM project_clients JUNTO COM O CÓDIGO DO PROJETO
                $this->projectClientRepository->store($arrayClientProjects);

            }

        }



        // end PIVOT TABLES


    }


    public function delete(array $data)
    {
        $project = $this->projectRepository->delete($data['id']);

    }

}
