<?php

namespace App\Services;

use App\Repositories\Interfaces\EquipmentModelRepositoryInterface;

class EquipmentModelService
{

    public function __construct(EquipmentModelRepositoryInterface $equipmentModelRepository)
    {
        $this->equipmentModelRepository = $equipmentModelRepository;
    }

    public function getAll()
    {
        return $this->equipmentModelRepository->getAll();
    }

    public function getDataToCreate()
    {
        return $this->equipmentModelRepository->getDataToCreate();
    }

    public function store(array $data)
    {

        $exist = $this->equipmentModelRepository->dataExists($data);
        // dd($exist);

        if($exist == false) {

            // MAIN TABLE
            $weight_measurment      = Parse_money_database_br($data['weight_measurment']);
            $capacity_measurment    = Parse_money_database_br($data['capacity_measurment']);
            $power_measurment       = Parse_money_database_br($data['power_measurment']);
            $tank_capacity          = Parse_money_database_br($data['tank_capacity']);

            $equipmentModel = array(
                'equipment_prefix_id'   => $data['equipment_prefix_id'],
                'prefix'                => $data['prefix'],
                'equipment_brand_id'    => $data['equipment_brand_id'],
                'equipment_family_id'   => $data['equipment_family_id'],
                'name'                  => $data['name'],
                'weight_measurment'     => $weight_measurment,
                'unit1'                 => $data['unit1'],
                'capacity_measurment'   => $capacity_measurment,
                'unit2'                 => $data['unit2'],
                'power_measurment'      => $power_measurment,
                'unit3'                 => $data['unit3'],
                'tank_capacity'         => $tank_capacity,
            );
            $equipmentModel_id = $this->equipmentModelRepository->store($equipmentModel);
            // end MAIN TABLE

        } else {

            return 'true';
        }

    }

    public function edit($id) {
        return $this->equipmentModelRepository->edit($id);
    }

    public function update(array $data)
    {

        $weight_measurment      = Parse_money_database_br($data['weight_measurment']);
        $capacity_measurment    = Parse_money_database_br($data['capacity_measurment']);
        $power_measurment       = Parse_money_database_br($data['power_measurment']);
        $tank_capacity          = Parse_money_database_br($data['tank_capacity']);

        $equipmentModels = array(
            'id'                    => $data['id'],
            'equipment_prefix_id'   => $data['equipment_prefix_id'],
            'prefix'                => $data['prefix'],
            'equipment_brand_id'    => $data['equipment_brand_id'],
            'equipment_family_id'   => $data['equipment_family_id'],
            'name'                  => $data['name'],
            'weight_measurment'     => $weight_measurment,
            'unit1'                 => $data['unit1'],
            'capacity_measurment'   => $capacity_measurment,
            'unit2'                 => $data['unit2'],
            'power_measurment'      => $power_measurment,
            'unit3'                 => $data['unit3'],
            'tank_capacity'         => $tank_capacity,

        );
        $updateEquipmentModel = $this->equipmentModelRepository->update($equipmentModels);

    }

    public function delete(array $data)
    {
        $project = $this->equipmentModelRepository->delete($data['id']);

    }

}
