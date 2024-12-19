<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\ProjectLocation;
use App\Repositories\Interfaces\ProjectLocationRepositoryInterface;

class ProjectLocationRepository implements ProjectLocationRepositoryInterface
{
  public function getAll()
  {

    $projectLocations = ProjectLocation::select(
        'project_locations.id',
        'project_locations.name as location_name',
        'projects.name as project_name',
        'projects.short_name as project_short_name'
    )
    ->join('projects', 'projects.id', '=', 'project_locations.project_id')
    ->get();

    return $projectLocations;

  }

  public function getDataToCreate()
  {
    $project = Project::select('id', 'short_name')
    ->where('is_activated', 1)
    ->orderBy('short_name', 'asc')
    ->get();

    $return = array(
        'projectCombo' => $project,
    );

    return $return;

  }

  public function find($id)
  {
    return false;
  }


  public function store($data)
  {
    return ProjectLocation::create($data)->id;
  }


  public function edit($id)
  {
    $projectLocation = ProjectLocation::where('id', $id)->get();

    $project = Project::select('id', 'short_name')
    ->where('is_activated', 1)
    ->orderBy('short_name', 'asc')
    ->get();

    $return = array(
        'projectLocation' => $projectLocation,
        'projectCombo' => $project,
    );

    return $return;

  }

  public function update(array $data)
  {

    try {

        $input              = ProjectLocation::find($data['id']);
        $input->name        = $data['name'];
        $input->project_id = $data['project_id'];
        $input->save();

        return $input;

    } catch (\Exception $e) {
        return response()->json(["error" => $e->getMessage()]);
    }

  }

  public function delete($id)
  {
        $return = ProjectLocation::destroy($id);
        return $return;
  }

}
