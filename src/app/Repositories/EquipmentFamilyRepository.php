<?php

namespace App\Repositories;

use App\Models\EquipmentFamily;
use App\Models\EquipmentGroup;
use App\Models\FamilyMeasure;
use App\Models\MeasurementUnit;

use App\Repositories\Interfaces\EquipmentFamilyRepositoryInterface;

class EquipmentFamilyRepository implements EquipmentFamilyRepositoryInterface
{
  public function getAll()
  {
     $equipmentFamilys = EquipmentFamily::with('EquipmentGroup')
     ->where('is_activated', 1)
    ->get();

    return $equipmentFamilys;

  }

  public function getDataToCreate()
  {
    $groupCombo = EquipmentGroup::select('id', 'name')->orderBy('name', 'asc')->get();
    $measurementWeight =  MeasurementUnit::where('type', '=', 1)->select('id','name')->orderBy('name', 'asc')->get();
    $measurementCapacity =  MeasurementUnit::where('type', '=', 2)->select('id','name')->orderBy('name', 'asc')->get();
    $measurementPower =  MeasurementUnit::where('type', '=', 3)->select('id','name')->orderBy('name', 'asc')->get();

    $return = array(
        'groupCombo' => $groupCombo,
        'measurementWeight' => $measurementWeight,
        'measurementCapacity' => $measurementCapacity,
        'measurementPower' => $measurementPower,
    );

    return $return;

  }

  public function store($data)
  {
    // CRIA UM ID E ENVIA PARA USAR DE FK DAS UNITS MEASURES
    return EquipmentFamily::create($data)->id;
  }

  public function getById($id) {
    return EquipmentFamily::findOrFail($id);
  }

  public function update(array $data)
  {

    try {

        $input                       = EquipmentFamily::find($data['id']);
        $input->name                 = $data['name'];
        $input->equipment_group_id   = $data['equipment_group_id'];
        $input->type                 = $data['type'];
        $input->conversion_factor    = $data['conversion_factor'];
        $input->maximum_hour         = $data['maximum_hour'];
        $input->has_model_year       = $data['has_model_year'];
        $input->has_tag              = $data['has_tag'];
        $input->has_implement        = $data['has_implement'];
        $input->has_vin_number       = $data['has_vin_number'];

        $input->save();

        return $input;

    } catch (\Exception $e) {
        return response()->json(["error" => $e->getMessage()]);
    }


  }


  public function edit($id)
  {
    $equipmentFamily = EquipmentFamily::with('EquipmentGroup')
    ->where('id', $id)
   ->get();

   // dd( $equipmentFamily);

    $groupCombo = EquipmentGroup::select('id', 'name')->orderBy('name', 'asc')->get();
    $measurementWeight =  MeasurementUnit::where('type', '=', 1)->select('id','name')->orderBy('name', 'asc')->get();
    $measurementCapacity =  MeasurementUnit::where('type', '=', 2)->select('id','name')->orderBy('name', 'asc')->get();
    $measurementPower =  MeasurementUnit::where('type', '=', 3)->select('id','name')->orderBy('name', 'asc')->get();

    $FamilyMeasureWeight = FamilyMeasure::where('equipment_family_id', '=', $id)
    ->where('type', '=', 1)
    ->get();

    $FamilyMeasureCapacity = FamilyMeasure::where('equipment_family_id', '=', $id)
    ->where('type', '=', 2)
    ->get();

    $FamilyMeasurePower = FamilyMeasure::where('equipment_family_id', '=', $id)
    ->where('type', '=', 3)
    ->get();

    // dd($FamilyMeasureWeight );

     $result = array(
        // TABELA PRINCIPAL
         'equipmentFamily'      => $equipmentFamily,

        // GRUPOS E UNIDADES DE MEDIDAS
        'groupCombo'           => $groupCombo,
        'measurementWeight'     => $measurementWeight,
        'measurementCapacity'   => $measurementCapacity,
        'measurementPower'      => $measurementPower,

        // UNIDADES DE MEDIDAS DA FAMÍLIA
        'familyMeasureWeight'   => $FamilyMeasureWeight,
        'familyMeasureCapacity' => $FamilyMeasureCapacity,
        'familyMeasurePower' => $FamilyMeasurePower,

    );

    return $result;

  }



  public function delete($id)
  {

    $return = EquipmentFamily::destroy($id);
        return $return;

  }

}
