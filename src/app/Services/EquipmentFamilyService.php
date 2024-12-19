<?php

namespace App\Services;

use App\Repositories\Interfaces\EquipmentFamilyRepositoryInterface;
use App\Repositories\Interfaces\FamilyMeasureRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class EquipmentFamilyService
{

    public function __construct(
        EquipmentFamilyRepositoryInterface $equipmentFamilyRepository,
        FamilyMeasureRepositoryInterface $familyMeasureRepository
    ) {
        $this->equipmentFamilyRepository = $equipmentFamilyRepository;
        $this->familyMeasureRepository = $familyMeasureRepository;

    }

    public function getAll()
    {
        return $this->equipmentFamilyRepository->getAll();
    }

    // public function find($id) {
    //     return $this->equipmentFamilyRepository->find($id);
    // }

    public function edit($id) {
        return $this->equipmentFamilyRepository->edit($id);
    }

    public function getDataToCreate()
    {
        return $this->equipmentFamilyRepository->getDataToCreate();
    }

    public function store(array $data)
    {

        if(empty($data['has_model_year'])) {
            $has_model_year = 0;
        } else {
            $has_model_year = 1;
        }
        if(empty($data['has_tag'])) {
            $has_tag = 0;
        } else {
            $has_tag = 1;
        }
        if(empty($data['has_implement'])) {
            $has_implement = 0;
        } else {
            $has_implement = 1;
        }
        if(empty($data['has_vin_number'])) {
            $has_vin_number = 0;
        } else {
            $has_vin_number = 1;
        }

        $maximum_hour = Parse_money_database_br($data['maximum_hour']);
        $conversion_factor = Parse_money_database_br($data['conversion_factor']);

        $family = array(
            'name'               => $data['name'],
            'equipment_group_id' => $data['equipment_group_id'],
            'maximum_hour'       => $maximum_hour,
            'type'               => $data['type'],
            'has_implement'      => $has_implement,
            'has_tag'            => $has_tag,
            'has_vin_number'     => $has_vin_number,
            'has_model_year'     => $has_model_year,
            'conversion_factor'  => $conversion_factor,
            'user_id' => Auth::user()->id,
        );

        // SALVA E RETORNANDO O ID
        $equipment_family_id = $this->equipmentFamilyRepository->store($family);
        // $equipment_family_id = 189;


        // UNIDADES DE PESO
        $arrayWeightUnits = [];

        foreach ($data['weight_units'] as $rows =>$key) {

            $arrayWeightUnits['equipment_family_id'] = $equipment_family_id;
            $arrayWeightUnits['type'] = 1;
            $arrayWeightUnits['measurement_unit_id'] = $key;

            $this->familyMeasureRepository->store($arrayWeightUnits);

        }

        // UNIDADES DE CAPACIDADE
        $arrayCapacityUnits = [];

        foreach ($data['capacity_units'] as $rows =>$key) {
            $arrayCapacityUnits['equipment_family_id'] = $equipment_family_id;
            $arrayCapacityUnits['type'] = 2;
            $arrayCapacityUnits['measurement_unit_id'] = $key;

            $this->familyMeasureRepository->store($arrayCapacityUnits);

        }

        // UNIDADES DE POTÊNCIA/POWER SUPPLY
        $arrayPowerSupply = [];

        foreach ($data['power_supply'] as $rows =>$key) {
            $arrayPowerSupply['equipment_family_id'] = $equipment_family_id;
            $arrayPowerSupply['type'] = 3;
            $arrayPowerSupply['measurement_unit_id'] = $key;

            $this->familyMeasureRepository->store($arrayPowerSupply);

        }

    }


    public function update(array $data)
    {
        if(empty($data['has_model_year'])) {
            $has_model_year = 0;
        } else {
            $has_model_year = 1;
        }
        if(empty($data['has_tag'])) {
            $has_tag = 0;
        } else {
            $has_tag = 1;
        }
        if(empty($data['has_implement'])) {
            $has_implement = 0;
        } else {
            $has_implement = 1;
        }
        if(empty($data['has_vin_number'])) {
            $has_vin_number = 0;
        } else {
            $has_vin_number = 1;
        }

        $maximum_hour = Parse_money_database_br($data['maximum_hour']);
        $conversion_factor = Parse_money_database_br($data['conversion_factor']);

        $family = array(
            'id'                 => $data['id'],
            'name'               => $data['name'],
            'equipment_group_id' => $data['equipment_group_id'],
            'maximum_hour'       => $maximum_hour,
            'type'               => $data['type'],
            'has_implement'      => $has_implement,
            'has_tag'            => $has_tag,
            'has_vin_number'     => $has_vin_number,
            'has_model_year'     => $has_model_year,
            'conversion_factor'  => $conversion_factor,
            'user_id' => Auth::user()->id,
        );

        $updateEquipmentFamily = $this->equipmentFamilyRepository->update($family);


        // EXCLUIR AS UNIDADES DA FAMÍLIA
        $familyMeasure = $this->familyMeasureRepository->deleteByFamilyMeasureId($data['id']);


        // INSERIR NOVAS UNIDADES
        $arrayWeightUnits = [];

        foreach ($data['weight_units'] as $rows =>$key) {

            if(!empty($key)) {
                $arrayWeightUnits['equipment_family_id'] = $data['id'];
                $arrayWeightUnits['type'] = 1;
                $arrayWeightUnits['measurement_unit_id'] = $key;
                $this->familyMeasureRepository->store($arrayWeightUnits);
            }
        }


        // UNIDADES DE CAPACIDADE
        $arrayCapacityUnits = [];

        foreach ($data['capacity_units'] as $rows =>$key) {

            if(!empty($key)) {
                $arrayCapacityUnits['equipment_family_id'] = $data['id'];
                $arrayCapacityUnits['type'] = 2;
                $arrayCapacityUnits['measurement_unit_id'] = $key;
                $this->familyMeasureRepository->store($arrayCapacityUnits);
            }

        }

        // UNIDADES DE POTÊNCIA/POWER SUPPLY
        $arrayPowerSupply = [];

        foreach ($data['power_supply'] as $rows =>$key) {

            if(!empty($key)) {
                $arrayPowerSupply['equipment_family_id'] = $data['id'];
                $arrayPowerSupply['type'] = 3;
                $arrayPowerSupply['measurement_unit_id'] = $key;
                $this->familyMeasureRepository->store($arrayPowerSupply);
            }

        }


    }


    public function delete(array $data)
    {
        $familyMeasure = $this->equipmentFamilyRepository->delete($data['id']);

    }

    // public function prepareData(array $data) {

    // }


}
