<?php

namespace App\Http\Controllers;

use App\Services\MeasurementUnitService;

class MeasurementUnitController extends Controller
{

    protected $measurementUnitService;

    public function __construct(MeasurementUnitService $measurementUnitService)
    {
        $this->measurementUnitService = $measurementUnitService;
    }

    public function getAll() {

        $result = $this->measurementUnitService->getAll();
        return response()->json($result);

    }

}

