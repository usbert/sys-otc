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
        'projects.code',
        'projects.name',
        'contract_number',
        'clients.name as client_name',
        'project_manager',
        'trades.name as trade_name',
        'signature_date',
        'start_date',
        'finish_date',
        'contract_value',
        'projects.street',
        'projects.city',
        'projects.state',
        'projects.country',
        'projects.zip_code',

    )
    ->selectRaw('CONCAT(projects.street, \'-\', projects.city, \'-\', projects.state, \'-\', projects.country) AS address')
    ->where('projects.is_activated', Project::ACTIVATED)
    ->join('clients', 'clients.id', '=', 'projects.client_id')
    ->join('trades', 'trades.id', '=', 'projects.trade_id')
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
        'project'           => $project,
        'clientCombo'       => $clients,
        'tradeCombo'        => $trades,
        'typeDocumentCombo' => $typeDocuments,
    );

     return $return;

  }

  public function store($data)
  {
    return Project::create($data)->id;
  }

  public function update(array $data)
  {

    try {

        $input = Project::find($data['id']);
        $input->code        = $data['code'];
        $input->name        = $data['name'];

        $input->contract_number   = $data['contract_number'];
        $input->client_id         = $data['client_id'];
        $input->project_manager   = $data['project_manager'];
        $input->trade_id          = $data['trade_id'];
        $input->signature_date    = $data['signature_date'];
        $input->start_date        = $data['start_date'];
        $input->finish_date       = $data['finish_date'];
        // $input->contract_value    = $data['contract_value'];

        $input->street            = $data['street'];
        $input->city              = $data['city'];
        $input->state             = $data['state'];
        $input->country           = $data['country'];
        $input->zip_code          = $data['zip_code'];

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
