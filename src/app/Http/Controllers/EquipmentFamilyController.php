<?php

namespace App\Http\Controllers;

use App\Services\EquipmentFamilyService;
use App\Http\Requests\EquipmentFamily\CreateEquipmentFamilyRequest;
use App\Http\Requests\EquipmentFamily\UpdateEquipmentFamilyRequest;
use App\Models\EquipmentFamily;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EquipmentFamilyController extends Controller
{

    protected $equipmentFamilyService;

    public function __construct(EquipmentFamilyService $equipmentFamilyService)
    {
        $this->equipmentFamilyService = $equipmentFamilyService;
    }

    public function getAll() {

        $result = $this->equipmentFamilyService->getAll();

        if(request()->ajax()) {

            return datatables()->of($result)
            ->addColumn('action', function($row){
                $idx = $row->id;
                $btn  = "<a href='family/edit/$idx' data-toggle='tooltip' data-id='$idx' class='edit'><span class='fas fa-pencil-alt'></a>&nbsp;";
                $btn .= "<a href='javascript:void(0)' data-toggle='tooltip' onClick='deleteReg($idx)' data-id='$idx' class='delete'><span class='fas fa-trash'></span></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('backend.family.familylist');

    }

    public function getDataToCreate() {
        try {
            $result = $this->equipmentFamilyService->getDataToCreate();
            //  return response()->json($result);
            return view('backend.family.create', compact('result'));

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }


    public function store(CreateEquipmentFamilyRequest $request) {
        try {
            $result = $this->equipmentFamilyService->store( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


    public function edit($id) {
        try {
            $result = $this->equipmentFamilyService->edit($id);
            return view('backend.family.edit', compact('result'));
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


    public function update(UpdateEquipmentFamilyRequest $request) {

        try {
            $result = $this->equipmentFamilyService->update( $request->all());
            return response()->json($result);

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


    public function delete(Request $request) {
        try {
            $result = $this->equipmentFamilyService->delete( $request->all());
            return response()->json($result);

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
        // $return = EquipmentFamily::destroy($request->id);
        // return $return;

    }


}
