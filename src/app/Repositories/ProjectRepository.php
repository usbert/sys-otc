<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\Project;
use App\Models\FieldActivity;
use App\Models\Supervisor;
use App\Models\Client;
use App\Models\ProjectActivity;
use App\Models\ProjectSupervisor;
use App\Models\Trade;
use App\Models\TypeDocument;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use SebastianBergmann\CodeCoverage\Report\Xml\Project as XmlProject;

class ProjectRepository implements ProjectRepositoryInterface
{
  public function getAll()
  {
    $project = Project::Select(
        // 'projects.code',
        'projects.id',
        'clients.name as client_name',
        'projects.name as description',
    )
    // ->selectRaw('CONCAT(addresses.code, \'-\', clients.code, \'-\', lpad(projects.id, 4, 0)) AS code')
    ->where('projects.is_activated', Project::ACTIVATED)
    ->join('clients', 'clients.id', '=', 'projects.client_id')
    ->orderBy('projects.code')
    ->get();

    return $project;

  }

  public function getDataToCreate()
  {
    $clients = Client::select(
        'id',
        'code',
        'name',
    )
    ->where('is_activated', 1)
    ->orderBy('name', 'asc')
    ->get();

    $trades = Trade::select(
        'id',
        'name',
    )
    ->where('is_activated', 1)
    ->orderBy('name', 'asc')
    ->get();

    $typeDocuments = TypeDocument::select(
        'id',
        'name',
    )
    ->where('is_activated', 1)
    ->orderBy('name', 'asc')
    ->get();

    $return = array(
        'clientCombo'       => $clients,
        'tradeCombo'        => $trades,
        'typeDocumentCombo' => $typeDocuments,
    );

    return $return;

  }

  public function edit($id)
  {

     $project = Project::where('id', $id)->get();

     $fieldActivity = FieldActivity::select('id', 'code', 'name')
     ->where('is_activated', 1)
     ->orderBy('code', 'asc')
     ->orderBy('name', 'asc')
     ->get();

     $supervisor = Supervisor::select('id', 'name')
     ->where('is_activated', 1)
     ->orderBy('name', 'asc')
     ->get();

     $clientCombo = Client::select('id', 'name')
     ->where('is_activated', 1)
     ->orderBy('name', 'asc')
     ->get();


      //  TABELAS PIVOT
     $projectActivities = ProjectActivity::where('project_id', '=', $id)->get();
     $project_supervisors = ProjectSupervisor::where('project_id', '=', $id)->get();
     $project_clients = ProjectClient::where('project_id', '=', $id)->get();

     $result = array(
         'project' => $project,
         'fieldActivity' => $fieldActivity,
         'supervisor' => $supervisor,
         'clientCombo' => $clientCombo,

         // TABELAS PIVOT
        'projectActivities'   => $projectActivities,
        'project_supervisors'  => $project_supervisors,
        'project_clients' => $project_clients,
     );

     return $result;

  }

  public function store($data)
  {
    return Project::create($data)->id;
  }

  public function update(array $data)
  {

    try {

        $input              = Project::find($data['id']);
        $input->short_name  = $data['short_name'];
        $input->name        = $data['name'];
        $input->prefix_code = $data['prefix_code'];
        $input->cost_center = $data['cost_center'];
        $input->save();

        return $input;

    } catch (\Exception $e) {
        // dd($e);
        return response()->json(["error" => $e->getMessage()]);
    }

  }

  public function getById($id) {
    return Project::findOrFail($id);
  }

  public function delete($id)
  {

    $return = Project::destroy($id);
        return $return;

  }

}
