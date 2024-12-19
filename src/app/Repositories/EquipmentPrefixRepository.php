<?php

namespace App\Repositories;

use App\Models\EquipmentPrefix;
use App\Repositories\Interfaces\EquipmentPrefixRepositoryInterface;

class EquipmentPrefixRepository implements EquipmentPrefixRepositoryInterface
{
  public function getAll()
  {
    $equipmentPrefixes = EquipmentPrefix::where('is_activated', 1)
    ->get();

    return $equipmentPrefixes;

  }

  public function store($data)
  {
    return EquipmentPrefix::create($data)->id;
  }

  public function update(array $data)
    {

        try {
            $input                  = EquipmentPrefix::find($data['id']);
            $input->prefix          = $data['prefix'];
            $input->name            = $data['name'];
            $input->save();

            return $input;

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()]);
        }

    }

    public function edit($id)
    {

      $equipmentPrefix = EquipmentPrefix::where('id', $id)->get();
      $result = array(
          'equipmentPrefix' => $equipmentPrefix,
      );

      return $result;

    }


    public function delete($id)
    {
        $return = EquipmentPrefix::destroy($id);
        return $return;
    }

}
