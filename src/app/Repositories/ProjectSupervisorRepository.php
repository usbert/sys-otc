<?php

namespace App\Repositories;
use App\Models\ProjectSupervisor;

use App\Repositories\Interfaces\ProjectSupervisorRepositoryInterface;

class ProjectSupervisorRepository implements ProjectSupervisorRepositoryInterface
{

  public function store($data)
  {
    return ProjectSupervisor::create($data)->id;
  }

//   public function deleteByProjectActivityId($id)
//   {
//     $familyMeasure = ProjectActivity::where('equipment_family_id', $id)->delete();
//     return  $familyMeasure;
//   }




}
