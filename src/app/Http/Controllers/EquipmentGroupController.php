<?php

namespace App\Http\Controllers;
use App\Http\Requests\EquipmentGroup\CreateEquipmentGroupRequest;
use App\Http\Requests\EquipmentGroup\UpdateEquipmentGroupRequest;
use App\Services\EquipmentGroupService;
use Illuminate\Http\Request;

class EquipmentGroupController extends Controller
{
    protected $equipmentGroupService;

    public function __construct(EquipmentGroupService $equipmentGroupService)
    {
        $this->equipmentGroupService = $equipmentGroupService;
    }

    public function getAll() {

        $result = $this->equipmentGroupService->getAll();
        // return response()->json($result);

        if(request()->ajax()) {

            return datatables()->of($result)
            ->addColumn('action', function($row){
                $idx = $row->id;
                $btn  = "<a href='equipment-group/edit/$idx' data-toggle='tooltip' data-id='$idx' class='edit'><span class='fas fa-pencil-alt'></a>&nbsp;";
                $btn .= "<a href='javascript:void(0)' data-toggle='tooltip' onClick='deleteReg($idx)' data-id='$idx' class='delete'><span class='fas fa-trash'></span></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('backend.equipment-group.equipment-group-list');

    }

    public function getDataToCreate() {

        try {
            return view('backend.equipment-group.create');
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }

    public function store(CreateEquipmentGroupRequest $request) {
        try {
            $result = $this->equipmentGroupService->store( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }


    public function edit($id) {
        try {
            $result = $this->equipmentGroupService->edit($id);
            return view('backend.equipment-group.edit', compact('result'));
        } catch (\Exception $e) {
            // dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }

    public function update(UpdateEquipmentGroupRequest $request) {

        try {
            $result = $this->equipmentGroupService->update( $request->all());
            return response()->json($result);

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

    public function delete(Request $request) {

        try {
            $result = $this->equipmentGroupService->delete( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }



}

