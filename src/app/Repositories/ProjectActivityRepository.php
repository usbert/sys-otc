<?php

namespace App\Repositories;
use App\Models\ProjectActivity;
use App\Models\ProjectClient;
use App\Models\ProjectSupervisor;
use App\Repositories\Interfaces\ProjectActivityRepositoryInterface;

class ProjectActivityRepository implements ProjectActivityRepositoryInterface
{

  public function store($data)
  {
    return ProjectActivity::create($data)->id;
  }

  public function deleteByProjectActivityId($id)
  {
    $projectActivity = ProjectActivity::where('project_id', $id)->delete();
    return  $projectActivity;
  }

  public function deleteByProjectSupervisorById($id)
  {
    $projectSupervisor = ProjectSupervisor::where('project_id', $id)->delete();
    return  $projectSupervisor;
  }


}
