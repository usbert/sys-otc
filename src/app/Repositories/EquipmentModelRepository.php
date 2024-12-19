<?php

namespace App\Repositories;

use App\Models\EquipmentPrefix;
use App\Models\EquipmentModel;
use App\Models\EquipmentFamily;
use App\Models\Brand;
use App\Models\MeasurementUnit;
use App\Repositories\Interfaces\EquipmentModelRepositoryInterface;

class EquipmentModelRepository implements EquipmentModelRepositoryInterface
{
    public function getAll()
    {
        $equipmentModels = EquipmentModel::select(
            'equipment_models.id',
            'equipment_models.prefix',
            'equipment_models.name',
            'tank_capacity',
        )
        ->selectRaw('equipment_prefixes.name as prefix_name')
        ->selectRaw('brands.name as brand_name')
        ->selectRaw('equipment_families.name as family_name')
        ->selectRaw('equipment_families.type')
        ->selectRaw('CONCAT(weight_measurment, \' \', unit1) AS weight_measurment')
        ->selectRaw('CONCAT(capacity_measurment, \' \', unit2) AS capacity_measurment')
        ->selectRaw('CONCAT(power_measurment, \' \', unit3) AS power_measurment')

        ->join('equipment_prefixes', 'equipment_prefixes.id', '=', 'equipment_models.equipment_prefix_id')
        ->join('brands', 'brands.id', '=', 'equipment_models.equipment_brand_id')
        ->join('equipment_families', 'equipment_families.id', '=', 'equipment_models.equipment_family_id')
        ->orderBy('prefix_name')
        ->orderBy('brand_name')
        ->orderBy('name')
        ->orderBy('family_name')
        ->get();

        return $equipmentModels;

    }

    public function getDataToCreate()
    {
        $equipmentPrefixCombo   = EquipmentPrefix::orderBy('name', 'asc')->get();
        $equipmentBrandCombo    = Brand::orderBy('name', 'asc')->get();
        $equipmentFamilyCombo   = EquipmentFamily::orderBy('name', 'asc')->get();
        $measurementUnit1       = MeasurementUnit::where('type', '=', 1)->orderBy('name', 'asc')->get();
        $measurementUnit2       = MeasurementUnit::where('type', '=', 2)->orderBy('name', 'asc')->get();
        $measurementUnit3       = MeasurementUnit::where('type', '=', 3)->orderBy('name', 'asc')->get();

        $return = array(
            'equipmentPrefixCombo'  => $equipmentPrefixCombo,
            'equipmentBrandCombo'   => $equipmentBrandCombo,
            'equipmentFamilyCombo'  => $equipmentFamilyCombo,
            'measurementUnit1'      => $measurementUnit1,
            'measurementUnit2'      => $measurementUnit2,
            'measurementUnit3'      => $measurementUnit3,
        );

        return $return;

    }


    public function store($data)
    {
      return EquipmentModel::create($data)->id;
    }


    public function edit($id)
    {

        $equipmentModel = EquipmentModel::where('id', $id)->get();

        $equipmentPrefixCombo   = EquipmentPrefix::orderBy('name', 'asc')->get();
        $equipmentBrandCombo    = Brand::orderBy('name', 'asc')->get();
        $equipmentFamilyCombo   = EquipmentFamily::orderBy('name', 'asc')->get();
        $measurementUnit1       = MeasurementUnit::where('type', '=', 1)->orderBy('name', 'asc')->get();
        $measurementUnit2       = MeasurementUnit::where('type', '=', 2)->orderBy('name', 'asc')->get();
        $measurementUnit3       = MeasurementUnit::where('type', '=', 3)->orderBy('name', 'asc')->get();

        $result = array(

            'equipmentModel'        => $equipmentModel,

            'equipmentPrefixCombo'  => $equipmentPrefixCombo,
            'equipmentBrandCombo'   => $equipmentBrandCombo,
            'equipmentFamilyCombo'  => $equipmentFamilyCombo,
            'measurementUnit1'      => $measurementUnit1,
            'measurementUnit2'      => $measurementUnit2,
            'measurementUnit3'      => $measurementUnit3,
        );

        return $result;

    }


    public function update(array $data)
    {

        try {

            $input                        = EquipmentModel::find($data['id']);
            $input->name                  = $data['name'];
            $input->weight_measurment     = $data['weight_measurment'];
            $input->unit1                 = $data['unit1'];
            $input->capacity_measurment   = $data['capacity_measurment'];
            $input->unit2                 = $data['unit2'];
            $input->power_measurment      = $data['power_measurment'];
            $input->unit3                 = $data['unit3'];
            $input->tank_capacity         = $data['tank_capacity'];

            $input->save();

            return $input;

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()]);
        }

    }

    public function delete($id)
    {
        $return = EquipmentModel::destroy($id);
        return $return;
    }

    public function dataExists($data)
    {
        $hasDataCombination = EquipmentModel::select()
        ->where('name', $data['name'])
        ->where('equipment_brand_id', $data['equipment_brand_id'])
        ->where('equipment_family_id', $data['equipment_family_id'])
        ->where('equipment_prefix_id', $data['equipment_prefix_id'])
        ->exists();

        return $hasDataCombination;
    }


}
