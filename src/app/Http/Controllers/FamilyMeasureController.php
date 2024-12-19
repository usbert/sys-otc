<?php

namespace App\Http\Controllers;

use App\Services\FamilyMeasureService;
use App\Http\Requests\FamilyMeasure\CreateFamilyMeasureRequest;

use Illuminate\Support\Facades\Auth;


class FamilyMeasureController extends Controller
{

    protected $equipmentFamilyService;

    public function __construct(FamilyMeasureService $equipmentFamilyService)
    {
        $this->equipmentFamilyService = $equipmentFamilyService;
    }

    public function store(CreateFamilyMeasureRequest $request) {

        $input = $request->all();
        // dd($input);

        try {
            // $dto = $request->toDTO();
            $result = $this->equipmentFamilyService->store( $input);
            return response()->json($result);

        } catch (\Exception $e) {
            return $e->getMessage();
            // return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

}
