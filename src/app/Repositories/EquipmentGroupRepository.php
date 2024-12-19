<?php

namespace App\Repositories;

use App\Models\EquipmentGroup;
use App\Repositories\Interfaces\EquipmentGroupRepositoryInterface;

class EquipmentGroupRepository implements EquipmentGroupRepositoryInterface
{

    public function getAll()
    {
        $equipmentGroups = EquipmentGroup::where('is_activated', 1)
        ->get();

        return $equipmentGroups;

    }

    public function store($data)
    {
        return EquipmentGroup::create($data)->id;
    }


    public function edit($id)
    {

        $equipmentGroup = EquipmentGroup::where('id', $id)->get();
        $result = array(
            'equipmentGroup' => $equipmentGroup,
        );

        return $result;

    }


    public function update(array $data)
    {
        try {

            $input              = EquipmentGroup::find($data['id']);
            $input->name        = $data['name'];
            $input->save();

            return $input;

        } catch (\Exception $e) {
            // dd($e);
            return response()->json(["error" => $e->getMessage()]);
        }

    }

    public function delete($id)
    {
        $return = EquipmentGroup::destroy($id);
        return $return;
    }


}
