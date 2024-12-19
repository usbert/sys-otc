<?php

namespace App\Http\Controllers;
use App\Services\EquipmentModelService;
use App\Http\Requests\EquipmentModel\CreateEquipmentModelRequest;
use App\Http\Requests\EquipmentModel\UpdateEquipmentModelRequest;
use Illuminate\Http\Request;

class EquipmentModelController extends Controller
{

    protected $equipmentModelService;

    public function __construct(EquipmentModelService $equipmentModelService)
    {
        $this->equipmentModelService = $equipmentModelService;
    }

    public function getAll() {

        $result = $this->equipmentModelService->getAll();
        // return response()->json($result);

        if(request()->ajax()) {

            return datatables()->of($result)
            ->addColumn('action', function($row){
                $idx = $row->id;
                $btn  = "<a href='model/edit/$idx' data-toggle='tooltip' data-id='$idx' class='edit'><span class='fas fa-pencil-alt'></a>&nbsp;";
                $btn .= "<a href='javascript:void(0)' data-toggle='tooltip' onClick='deleteReg($idx)' data-id='$idx' class='delete'><span class='fas fa-trash'></span></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('backend.model.modellist');

    }


    public function getDataToCreate() {
        try {
            $result = $this->equipmentModelService->getDataToCreate();
            // return response()->json($result);
            return view('backend.model.create', compact('result'));
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }

    public function store(CreateEquipmentModelRequest $request) {
        try {

            $result = $this->equipmentModelService->store( $request->all());

            if($result == true) {
                return 'existing data group';
            } else {
                return response()->json($result);
            }

        } catch (\Exception $e) {

            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

    public function edit($id) {
        try {
            $result = $this->equipmentModelService->edit($id);
            return view('backend.model.edit', compact('result'));
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


    public function update(UpdateEquipmentModelRequest $request) {

        try {
            $result = $this->equipmentModelService->update( $request->all());
            return response()->json($result);

        } catch (\Exception $e) {
           // dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


    public function delete(Request $request) {
        try {
            $result = $this->equipmentModelService->delete( $request->all());
            return response()->json($result);

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }



}
