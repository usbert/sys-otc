<?php

namespace App\Repositories;

use App\Repositories\Interfaces\VehicleRepositoryInterface;
use App\Models\Driver;
use App\Models\EquipmentModel;
use App\Models\Vehicle;
use App\Models\Fuel;
use App\Models\MobilizationHistoric;
use App\Models\Project;
use App\Models\Statuses;
use App\Models\ProjectActivity;
use App\Models\ProjectClient;
use App\Models\Supplyer;
use App\Models\EquipmentContract;
use App\Models\File;
use Illuminate\Support\Facades\Auth;

class VehicleRepository implements VehicleRepositoryInterface
{

    public function getAll()
    {

        $vehicles = Vehicle::select(
            'vehicles.id', 'vehicles.prefix', 'tag', 'vin_number', 'unit_measure',
            'projects.short_name as project_short_name',
            'equipment_models.name as model_name',
            'equipment_prefixes.name as model_description',
            'brands.name as brand_name',
            'equipment_families.name as family_name',
            'equipment_families.type',
            'statuses.name as status_name',
        )
        ->where('vehicles.is_activated', Vehicle::ACTIVATED)
        ->where('vehicles.company_id', 14)
        ->where('user_projects.user_id', Auth::user()->id)
        ->join('projects', 'projects.id', '=', 'vehicles.project_id')
        ->join('equipment_models', 'equipment_models.id', '=', 'vehicles.model_id')
        ->join('equipment_prefixes', 'equipment_prefixes.id', '=', 'equipment_models.equipment_prefix_id')
        ->join('brands', 'brands.id', '=', 'equipment_models.equipment_brand_id')
        ->join('equipment_families', 'equipment_families.id', '=', 'equipment_models.equipment_family_id')
        ->join('statuses', 'statuses.id', '=', 'vehicles.status_id')
        ->join('user_projects', 'user_projects.project_id', '=', 'vehicles.project_id')
        ->orderBy('vehicles.prefix')
        ->orderBy('vehicles.sequencial')
        ->get();

        return $vehicles;

    }


    public function getDataToCreate()
    {
        // $equipmentPrefixGrid    = EquipmentPrefix::where('is_activated', '=', '1')->orderBy('name', 'asc')->get();
        // $modelGrid              = EquipmentModel::where('is_activated', '=', '1')->orderBy('prefix', 'asc')->get();
        $projectCombo = Project::select(
            'projects.id',
            'projects.short_name',
        )
        ->where('projects.is_activated', '=', '1')
        ->where('user_projects.user_id', '=', Auth::user()->id)
        ->join('user_projects', 'user_projects.project_id', '=', 'projects.id')
        ->orderBy('short_name', 'asc')
        ->get();

        $supplyerCombo          = Supplyer::orderBy('name', 'asc')->get();
        $fuelCombo              = Fuel::orderBy('name', 'asc')->get();
       //  $models = EquipmentModel::where('id', '=', 111)->get();

        $return = array(
            // 'modelGrid'             => $modelGrid,
            // 'equipmentPrefixGrid'   => $equipmentPrefixGrid,
            'projectCombo'          => $projectCombo,
            'supplyerCombo'         => $supplyerCombo,
            'fuelCombo'             => $fuelCombo,
          //  'models'                => $models,
        );

        return $return;


    }


    public function getDataToDemob()
    {
        $projectCombo = Project::select(
            'projects.id',
            'projects.short_name',
        )
        ->where('projects.is_activated', '=', '1')
        ->where('user_projects.user_id', '=', Auth::user()->id)
        ->join('user_projects', 'user_projects.project_id', '=', 'projects.id')
        ->orderBy('short_name', 'asc')
        ->get();

        $return = array(
            'projectCombo' => $projectCombo,
        );

        return $return;


    }



    public function getDataToTransfer()
    {
        $projectCombo = Project::select(
            'projects.id',
            'projects.short_name',
        )
        ->where('projects.is_activated', '=', '1')
        ->where('user_projects.user_id', '=', Auth::user()->id)
        ->join('user_projects', 'user_projects.project_id', '=', 'projects.id')
        ->orderBy('short_name', 'asc')
        ->get();

        $return = array(
            'projectCombo' => $projectCombo,
        );

        return $return;


    }



    public function getModel($id) {

        $models = EquipmentModel::with([
            'Brand',
            'EquipmentPrefix',
            'EquipmentFamily'
        ])
        ->where('id', '=', $id)
        ->where('is_activated', '=', 1)->get();

        $return = array(
            'models' => $models,
        );

        return $return;

    }

    // Busca os CLIENTES do projeto selecionado no form de Cadastro
    public function getClient($id) {

        $clients = ProjectClient::select(
            'clients.id',
            'clients.name',
        )
        ->where('project_id', '=', $id)
        ->where('clients.is_activated', ProjectClient::ACTIVATED)
        ->join('clients', 'clients.id', 'project_clients.client_id')
        ->orderBy('name', 'asc')
        ->get();

        $client = [
            'clients' => $clients
        ];

        return response()->json($client);

    }


    // Busca os ATIVIDADES do projeto selecionado no form de Cadastro
    public function getActivity($id) {

        $activities = ProjectActivity::select(
            'project_activities.field_activity_id',
            'fa.id',
            'fa.code',
            'fa.name',
        )
        ->where('project_id', '=', $id)
        ->join('field_activities as fa', 'fa.id', '=', 'project_activities.field_activity_id')
        ->get();

        $activiy = [
           'activities' => $activities
        ];

        return response()->json($activiy);

    }

    // Busca os MOTORISTAS do projeto selecionado no form de Cadastro
    public function getDriver($id) {

        $drivers = Driver::where('project_id', '=', $id)
        ->where('is_activated', '=', 1)
        ->orderBy('name', 'asc')
        ->get();

        $driver = [
            'drivers' => $drivers
        ];

        return response()->json($driver);

    }

    public function store($data)
    {
        return Vehicle::create($data)->id;
    }

    public function getLastSequencial($prefix)
    {

        $last_sequencial = Vehicle::select(
            'sequencial',
        )
        ->where('prefix', 'LIKE', "{$prefix}%")
        ->orderBy('prefix', 'desc')
        ->take(1)
        ->first();

        return $last_sequencial->sequencial;


    }

    public function storeMobilization($data)
    {
        return MobilizationHistoric::create($data);
    }

    public function edit($id)
    {
        $vehicle = Vehicle::select(
            'vehicles.*',
            'statuses.name as status_name',
            'supplyers.name as supplyer_name',
            'projects.short_name as project_short_name'
        )
        ->where('vehicles.id', $id)
        ->where('vehicles.is_activated', 1)
        ->join('statuses', 'statuses.id', '=', 'vehicles.status_id')
        ->join('projects', 'projects.id', '=', 'vehicles.project_id')
        ->join('supplyers', 'supplyers.id', '=', 'vehicles.supplyer_id')
        ->join('user_projects', 'user_projects.project_id', '=', 'vehicles.project_id')
        ->get();

        // if($vehicle->count() == 0) {
        //     // return Redirect::route('vehicle-list');
        //     exit;
        //     // return redirect()->route('vehicle-list');
        // }

        $projectCombo   = Project::where('is_activated', '=', '1')->orderBy('short_name', 'asc')->get();
        $supplyerCombo  = Supplyer::orderBy('name', 'asc')->get();
        $fuelCombo      = Fuel::orderBy('name', 'asc')->get();
        $has_contract   = EquipmentContract::where('vehicle_id', '=', $id)->count();

        $mobilizationHistoric = MobilizationHistoric::select(
            'short_name',
            'mobilization_date',
            'km_control',
            'hour_control',
            'demobilization_date',
            'km_return',
            'hour_control_return'
        )
        ->where('mobilization_historics.vehicle_id', $id)
        ->join('projects', 'projects.id', '=', 'mobilization_historics.project_id')
        ->orderBy('mobilization_historics.mobilization_date')
        ->get();

        $result = array(

            'vehicle'               => $vehicle,

            'projectCombo'          => $projectCombo,
            'supplyerCombo'         => $supplyerCombo,
            'fuelCombo'             => $fuelCombo,
            'has_contract'          => $has_contract,               // TOTAL DE CONTRATOS
            'mobilizationHistoric'  => $mobilizationHistoric // HISTÓRICO DE MOBILIZAÇÕES
        );

        return $result;

    }



    public function update(array $data)
    {

        return false;

    }

    public function delete(array $data)
    {
        return false;

    }


    public function getEquipmentByPrefix($statuses, $prefix) {

        $statuses = array(
            'statuses' => $statuses,
        );

        $vehicles = Vehicle::select(
            'vehicles.id', 'vehicles.prefix', 'tag', 'vin_number',
            'renavam', 'unit_measure', 'has_km', 'has_h',
            'vehicles.project_id',
            'vehicles.supplyer_id',
            'projects.short_name as project_short_name',
            'equipment_models.name as model_name',
            'equipment_prefixes.name as model_description',
            'brands.name as brand_name',
            'supplyers.name as supplyer_name',
            'statuses.name as status_name',
        )
        ->where('vehicles.is_activated', 1)
        ->whereIn('vehicles.status_id', $statuses)
        ->where('vehicles.company_id', 14)
        ->where('user_projects.user_id', Auth::user()->id)
        ->where('vehicles.prefix', $prefix)

        ->join('projects', 'projects.id', '=', 'vehicles.project_id')
        ->join('equipment_models', 'equipment_models.id', '=', 'vehicles.model_id')
        ->join('equipment_prefixes', 'equipment_prefixes.id', '=', 'equipment_models.equipment_prefix_id')
        ->join('brands', 'brands.id', '=', 'equipment_models.equipment_brand_id')
        ->join('supplyers', 'supplyers.id', '=', 'vehicles.supplyer_id')
        ->join('statuses', 'statuses.id', '=', 'vehicles.status_id')
        ->join('user_projects', 'user_projects.project_id', '=', 'vehicles.project_id')
        ->get();


        $return = array(
            'vehicles' => $vehicles,
        );

        return $return;

    }

    public function getEquipmentByVinNumber($statuses, $vin_number) {

        $statuses = array(
            'statuses' => $statuses,
        );

        $vehicles = Vehicle::select(
            'vehicles.id', 'vehicles.prefix', 'tag', 'vin_number',
            'renavam', 'unit_measure', 'has_km', 'has_h',
            'projects.short_name as project_short_name',
            'equipment_models.name as model_name',
            'equipment_prefixes.name as model_description',
            'brands.name as brand_name',
            'supplyers.name as supplyer_name',
            'statuses.name as status_name',
        )
        ->where('vehicles.is_activated', 1)
        ->whereIn('vehicles.status_id', $statuses)
        ->where('vehicles.company_id', 14)
        ->where('user_projects.user_id', Auth::user()->id)
        ->where('vehicles.vin_number', $vin_number)
        ->join('projects', 'projects.id', '=', 'vehicles.project_id')
        ->join('equipment_models', 'equipment_models.id', '=', 'vehicles.model_id')
        ->join('equipment_prefixes', 'equipment_prefixes.id', '=', 'equipment_models.equipment_prefix_id')
        ->join('brands', 'brands.id', '=', 'equipment_models.equipment_brand_id')
        ->join('supplyers', 'supplyers.id', '=', 'vehicles.supplyer_id')
        ->join('statuses', 'statuses.id', '=', 'vehicles.status_id')
        ->join('user_projects', 'user_projects.project_id', '=', 'vehicles.project_id')
        ->get();

        $return = array(
            'vehicles' => $vehicles,
        );

        return $return;

    }


    public function getMobilization($vehicle_id) {

        $mobilizationHistoric = MobilizationHistoric::select(
            'short_name',
            'mobilization_date',
            'mobilization_historics.km_control',
            'mobilization_historics.hour_control',
            'mobilization_historics.demobilization_date',
            'mobilization_historics.km_return',
            'mobilization_historics.hour_control_return'
        )
        ->where('vehicles.id', $vehicle_id)
        ->join('projects', 'projects.id', '=', 'mobilization_historics.project_id')
        ->join('vehicles', 'vehicles.id', '=', 'mobilization_historics.vehicle_id')
        ->orderBy('mobilization_historics.mobilization_date')
        ->get();

        return $mobilizationHistoric;

    }


    public function getFile($id) {

        $fileVehicle = File::select(
            'files.id',
            'files.uuid',
            'projects.short_name',
            'files.name as file_name',
            'files.original_name as original_name',
            'files.type_document_id',
            'type_documents.name as type_name',
            'files.comment'
        )
        ->where('files.vehicle_id', $id)
        ->where('files.is_activated', Statuses::MOBILIZED)
        ->join('projects', 'projects.id', '=', 'files.project_id')
        ->join('type_documents', 'type_documents.id', '=', 'files.type_document_id')
        ->orderBy('files.name')
        ->get();

       return $fileVehicle;

    }


    // ****** Demobilization main in table ******
    public function updateDemobilizationVehicle(array $data)
    {
        try {
            // VEHICLE TABLE
            $input = Vehicle::find($data['id']);
            $input->status_id = Statuses::DEMOBILIZED;
            $input->save();

            return $input;

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()]);
        }

    }
    // Update in Mobilization Historic table
    public function updateDemobilizationHistory(array $data)
    {
       try {

            $mobilization_id = MobilizationHistoric::select('id')
            ->where('vehicle_id', $data['vehicle_id'])
            ->where('mobilization_historics.demobilization_date', null);

            $input   = MobilizationHistoric::find($mobilization_id);
            $input->demobilization_date_requested   = $data['demobilization_date_requested'];
            $input->demobilization_date             = $data['demobilization_date'];        // comentar se precisar aguardar aprovação
            $input->km_return_requested             = $data['km_return_requested'];
            $input->km_return                       = $data['km_return'];                  // comentar se precisar aguardar aprovação
            $input->hour_control_return_requested   = $data['hour_control_return_requested'];
            $input->hour_control_return             = $data['hour_control_return'];        // comentar se precisar aguardar aprovação
            $input->status_id                       = $data['status_id'];
            $input->user_id_return_requested        = $data['user_id_return_requested'];
            $input->request_status                  = Statuses::DEMOBILIZED;

            $input->save();

            return $input;

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()]);
        }
    }



    // ****** Transfer  main in table ******
    public function updateTransferVehicle(array $data)
    {
        try {
            // VEHICLE TABLE
            $input = Vehicle::find($data['id']);
            $input->status_id           = Statuses::MOBILIZED;    // Set equipment as mobilizezed
            $input->has_implement       = $data['has_implement'];
            $input->implement_value     = $data['implement_value'];
            $input->body_value          = $data['body_value'];
            $input->unit_measure        = $data['unit_measure'];
            $input->has_km              = $data['has_km'];
            $input->has_h               = $data['has_h'];
            $input->project_id          = $data['project_id'];
            $input->client_id           = $data['client_id'];
            $input->activity_id         = $data['activity_id'];

            $input->save();

            return $input;

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()]);
        }

    }

     // Update and Insert in Mobilization Historic table
     public function updateTransferHistory(array $data)
     {
        try {

            //  $mobilization_id = MobilizationHistoric::select('id')
            //  ->where('vehicle_id', $data['vehicle_id'])
            //  ->where('mobilization_historics.demobilization_date', null);

            //  $input                                  = MobilizationHistoric::find($mobilization_id);
            //  $input->demobilization_date_requested   = $data['demobilization_date_requested'];
            //  // $input->demobilization_date          = $data['demobilization_date'];
            //  $input->km_return_requested             = $data['km_return_requested'];
            //  // $input->km_return                    = $data['km_return'];
            //  $input->hour_control_return_requested   = $data['hour_control_return_requested'];
            //  // $input->hour_control_return          = $data['hour_control_return'];
            //  $input->status_id                       = $data['status_id'];
            //  $input->user_id_return_requested        = $data['user_id_return_requested'];
            //  $input->request_status                  = $data['request_status'];

            //  $input->save();

            //  return $input;

         } catch (\Exception $e) {
             return response()->json(["error" => $e->getMessage()]);
         }
     }

}
