<?php

namespace App\Services;

use App\Repositories\Interfaces\VehicleRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class VehicleService
{

    public function __construct(VehicleRepositoryInterface $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    public function getAll()
    {
        return $this->vehicleRepository->getAll();
    }

    public function getDataToCreate()
    {
        return $this->vehicleRepository->getDataToCreate();
    }

    public function getClient($id) {
        return $this->vehicleRepository->getClient($id);
    }

    public function getDriver($id) {
        return $this->vehicleRepository->getDriver($id);
    }

    public function getModel($id) {
        return $this->vehicleRepository->getModel($id);
    }

    public function getActivity($id) {
        return $this->vehicleRepository->getActivity($id);
    }


    public function store(array $data)
    {

        $prefix = $data['prefix'];

        if(!empty($data['km_control'])) {
            $km_control = Parse_money_database_br($data['km_control']);
        } else {
            $km_control = Null;
        }
        if(!empty($data['hour_control'])) {
            $hour_control = Parse_money_database_br($data['hour_control']);
        } else {
            $hour_control = Null;
        }

        if(!empty($data['has_km'])) {
            $has_km = 1;
        } else {
            $has_km = 0;
        }
        if(!empty($data['has_h'])) {
            $has_h = 1;
        } else {
            $has_h = 0;
        }

        if($data['unit_measure'] == 'Km') {
            $has_km = 1;
        } else if($data['unit_measure'] == 'H') {
            $has_h = 1;
        }

        $lastSequencial = $this->vehicleRepository->getLastSequencial($prefix);
        $sequencial = $lastSequencial + 1;

        $newPrefix = $prefix.str_pad($sequencial, 3,0,STR_PAD_LEFT);
        $project_id = $data['project_id'];

        $vehicle = array(
            'company_id'        => 14,
            'status_id'         => 1,
            'user_id'           => Auth::user()->id,
            'model_id'          => $data['model_id'],
            'tank_capacity'     => $data['tank_capacity'],
            'prefix'            => $newPrefix,
            'sequencial'        => $sequencial,
            'tag'               => $data['tag'],
            'renavam'           => $data['renavam'],
            'vin_number'        => $data['vin_number'],
            'manufacture_year'  => $data['manufacture_year'],
            'model_year'        => $data['model_year'],
            'supplyer_id'       => $data['supplyer_id'],
            'fuel_id'           => $data['fuel_id'],

            'project_id'        => $project_id,
            'client_id'         => $data['client_id'],
            'driver_id'         => $data['driver_id'],
            'activity_id'       => $data['activity_id'],

            'mobilization_date' => $data['mobilization_date'],
            'unit_measure'      => $data['unit_measure'],
            'km_control'        => $km_control,
            'hour_control'      => $hour_control,
            'has_km'            => $has_km,
            'has_h'             => $has_h,
            'has_kpi_report'    => 1,
        );

        // dd($vehicle);

        $vehicle_id = $this->vehicleRepository->store($vehicle);

        // MOBILIZAÇÃO
        $mobilization = array(
            'vehicle_id'        => $vehicle_id,
            'project_id'        => $project_id,
            'status_id'         => 1,
            'mobilization_date' => $data['mobilization_date'],
            'km_control'        => $km_control,
            'hour_control'      => $hour_control,
            'user_id'           => Auth::user()->id,
        );

        $this->vehicleRepository->storeMobilization($mobilization);

    }


    public function edit($id) {
        return $this->vehicleRepository->edit($id);
    }

    public function update(array $data)
    {

        if(!empty($data['rental_cost'])) {
            $rental_cost = Parse_money_database_br($data['rental_cost']);
        } else {
            $rental_cost = Null;
        }
        if(!empty($data['implement_value'])) {
            $implement_value = Parse_money_database_br($data['implement_value']);
        } else {
            $implement_value = Null;
        }
        if(!empty($data['body_value'])) {
            $body_value = Parse_money_database_br($data['body_value']);
        } else {
            $body_value = Null;
        }

        $equipmentModels = array(
            'tag'               => $data['tag'],
            'renavam'           => $data['renavam'],
            'vin_num'           => $data['vin_num'],
            'manufacture_year'  => $data['manufacture_year'],
            'model_year'        => $data['model_year'],
            'fuel_id'           => $data['fuel_id'],
            'rental_cost'       => $rental_cost,
            'implement_value'   => $implement_value,
            'body_value'        => $body_value,
        );
        $vehicle_id = $this->vehicleRepository->update($vehicle);

    }

    public function delete(array $data)
    {
        return false;

    }


    public function getEquipment(string $statuses, string $prefix, string $vin_number) {

        if($prefix == 'prefix') {
            return $this->vehicleRepository->getEquipmentByVinNumber($statuses, $vin_number);
        }
        return $this->vehicleRepository->getEquipmentByPrefix($statuses, $prefix);
    }


    public function getMobilization($vehicle_id) {
        return $this->vehicleRepository->getMobilization($vehicle_id);
    }

    public function getFile($id) {
        return $this->vehicleRepository->getFile($id);
    }


    public function getDataToDemob()
    {
        return $this->vehicleRepository->getDataToDemob();
    }


    public function getDataToTransfer()
    {
        return $this->vehicleRepository->getDataToDemob();
    }


    public function updateDemobilization(array $data)
    {

        // SAVE STATUS IN VEHICLE TABLE
        $demobilizationVehile = array(
           'id' => $data['id'],
        );
        $updateMobilization = $this->vehicleRepository->updateDemobilizationVehicle($demobilizationVehile);

        // SAVE STATUS, DATE... IN HISTORIC
        if(!empty($data['km_return'])) {
            $km_return = Parse_money_database_br($data['km_return']);
        } else {
            $km_return = null;
        }
        if(!empty($data['hour_control_return'])) {
            $hour_control_return = Parse_money_database_br($data['hour_control_return']);
        } else {
            $hour_control_return = null;
        }

        $demobilizationHist = array(
            'vehicle_id'                        => $data['id'],
            'demobilization_date_requested'     => $data['demobilization_date'],
            'demobilization_date'               => $data['demobilization_date'],
            'km_return_requested'               => $km_return,
            'km_return'                         => $km_return,
            'hour_control_return_requested'     => $hour_control_return,
            'hour_control_return'               => $hour_control_return,
            'status_id'                         => 2,
            'user_id_return_requested'          => Auth::user()->id,
            // 'request_status'                    => 'AD',     // descomentar se precisar aguardar aprovação
         );
         $updateMobilizationHist = $this->vehicleRepository->updateDemobilizationHistory($demobilizationHist);


    }


    public function updateTransfer(array $data)
    {

        // Update Status to Demobilized, Project and Values in main table

        // Valor do implemento
        if(!empty($data['implement_value'])) {
            $implement_value =  Parse_money_database_br($data['implement_value']);;
        } else {
            $implement_value = null;
        }
        if($data['has_implement'] == 0) {
            $implement_value = null;
        }

        // Valor da Carroceria
        if(!empty($data['body_value'])) {
            $body_value =  Parse_money_database_br($data['body_value']);;
        } else {
            $body_value = null;
        }

        // Valor do Km se houver
        if(!empty($data['has_km'])) {
            $has_km = 1;
        } else {
            $has_km = 0;
        }
        // Valor do Horímetro se houver
        if(!empty($data['has_h'])) {
            $has_h = 1;
        } else {
            $has_h = 0;
        }

        $transferVehile = array(
           'id'                 => $data['id'],
           'has_implement'      => $data['has_implement'],
           'implement_value'    => $implement_value,
           'body_value'         => $body_value,
           'unit_measure'       => $data['unit_measure'],
           'has_km'             => $has_km,
           'has_h'              => $has_h,
           'project_id'         => $data['project_id'],
           'client_id'          => $data['client_id'],
           'activity_id'        => $data['activity_id'],
        );
        $updateTransfer = $this->vehicleRepository->updateTransferVehicle($transferVehile);


        // Insert new historic mobilization data (Mobilized)
        if(!empty($data['km_control'])) {
            $km_control = Parse_money_database_br($data['km_control']);
        } else {
            $km_control = null;
        }
        if(!empty($data['hour_control'])) {
            $hour_control = Parse_money_database_br($data['hour_control']);
        } else {
            $hour_control = null;
        }

        $mobilization = array(
            'vehicle_id'        => $data['id'],
            'project_id'        => $data['project_id'],
            'status_id'         => 1,
            'mobilization_date' => $data['mobilization_date'],
            'km_control'        => $km_control,
            'hour_control'      => $hour_control,
            'user_id'           => Auth::user()->id,
        );

        $this->vehicleRepository->storeMobilization($mobilization);



    }

}
