<?php

namespace App\Repositories;
use App\Models\ProjectClient;

use App\Repositories\Interfaces\ProjectClientRepositoryInterface;

class ProjectClientRepository implements ProjectClientRepositoryInterface
{

  public function store($data)
  {
    return ProjectClient::create($data)->id;
  }

//   public function deleteByProjectClientId($id)
//   {
//     $projectClient = ProjectClient::where('client_id', $id)->delete();
//     return  $projectClient;
//   }

  public function deleteByProjectClientById($id)
  {
       $projectSupervisor = ProjectClient::where('project_id', $id)->delete();
       return  $projectSupervisor;
  }



}
