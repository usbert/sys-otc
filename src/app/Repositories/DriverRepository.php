<?php

namespace App\Repositories;

use App\Models\Driver;
use App\Models\Project;

use App\Repositories\Interfaces\DriverRepositoryInterface;

class DriverRepository implements DriverRepositoryInterface
{
  public function getAll()
  {
    $drivers = Driver::select(
        'drivers.id',
        'drivers.name',
        'registration',
        'drivers.function',
        'projects.short_name'
    )
    ->join('projects', 'projects.id', '=', 'drivers.project_id')
    ->get();

    return $drivers;

  }

  public function find($id)
  {
    return false;
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

  public function store($data)
  {
    return Driver::create($data)->id;
  }

  public function edit($id)
  {

    $driver = Driver::where('id', $id)->get();

    $projectCombo = Project::select('id', 'short_name')
    ->where('is_activated', 1)
    ->orderBy('short_name', 'asc')
    ->get();

    $return = array(
        'driver' => $driver,
        'projectCombo' => $projectCombo,
    );

    return $return;

  }

  public function update(array $data)
  {
    try {
        $input                  = Driver::find($data['id']);
        $input->name            = $data['name'];
        $input->registration    = $data['registration'];
        $input->function        = $data['function'];
        $input->project_id      = $data['project_id'];

        $input->save();

        return $input;

    } catch (\Exception $e) {
        return response()->json(["error" => $e->getMessage()]);
    }

  }

  public function delete($id)
  {
        $return = Driver::destroy($id);
        return $return;
  }


}
