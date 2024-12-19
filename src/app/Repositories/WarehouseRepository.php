<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\Warehouse;
use App\Repositories\Interfaces\WarehouseRepositoryInterface;

class WarehouseRepository implements WarehouseRepositoryInterface
{
  public function getAll()
  {
    $warehousets = Warehouse::select(
        'warehouses.id',
        'name',
        'responsible',
    )
    ->selectRaw('lpad(warehouses.code, 4, 0) AS code')
    ->selectRaw('CONCAT(addresses.street, \', \', addresses.city, \', \', zip_code) AS address_name')
    ->where('warehouses.is_activated', Warehouse::ACTIVATED)
    ->join('addresses', 'addresses.id', '=', 'warehouses.address_id')
    ->get();

    return $warehousets;


  }



    public function getDataToCreate()
    {

        $address = Address::select(
            'id',
            'street',
            'city',
            'state'
        )
        ->where('is_activated', 1)
        ->orderBy('street', 'asc')
        ->get();

        $return = array(
            'addressCombo' => $address,
        );

        return $return;

    }



}
