<?php

namespace App\Services;

use App\Repositories\Interfaces\WarehouseRepositoryInterface;
// use Illuminate\Support\Facades\Auth;

class WarehouseService
{

    public function __construct(WarehouseRepositoryInterface $warehouseRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
    }

    public function getAll()
    {
        return $this->warehouseRepository->getAll();
    }
    public function create(array $data)
    {
        return false;
    }


    public function getDataToCreate()
    {
        return $this->warehouseRepository->getDataToCreate();
    }



}
