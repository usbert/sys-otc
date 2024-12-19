<?php

namespace App\Repositories;
use App\Models\UserProject;

use App\Repositories\Interfaces\UserProjectRepositoryInterface;

class UserProjectRepository implements UserProjectRepositoryInterface
{

  public function store($data)
  {
    return UserProject::create($data)->id;
  }

  public function deleteProjectByUserId($id)
  {
    $projectUser = UserProject::where('user_id', $id)->delete();
    return  $projectUser;
  }


}
