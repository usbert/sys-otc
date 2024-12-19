<?php

namespace App\Http\Controllers;
use App\Http\Requests\EquipmentPrefix\CreateEquipmentPrefixRequest;
use App\Http\Requests\EquipmentPrefix\UpdateEquipmentPrefixRequest;
use App\Services\EquipmentPrefixService;
use Illuminate\Http\Request;

class EquipmentPrefixController extends Controller
{
    protected $equipmentPrefixService;

    public function __construct(EquipmentPrefixService $equipmentPrefixService)
    {
        $this->equipmentPrefixService = $equipmentPrefixService;
    }

    public function getAll()
    {

        $result = $this->equipmentPrefixService->getAll();
        // return response()->json($result);

        if(request()->ajax()) {

            return datatables()->of($result)
            ->addColumn('action', function($row){
                $idx = $row->id;
                $btn  = "<a href='prefix/edit/$idx' data-toggle='tooltip' data-id='$idx' class='edit'><span class='fas fa-pencil-alt'></a>&nbsp;";
                $btn .= "<a href='javascript:void(0)' data-toggle='tooltip' onClick='deleteReg($idx)' data-id='$idx' class='delete'><span class='fas fa-trash'></span></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }


        return view('backend.prefix.prefixlist');

    }

    public function getDataToCreate() {

        try {
            return view('backend.prefix.create');
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }


    public function store(CreateEquipmentPrefixRequest $request) {
        try {
            $result = $this->equipmentPrefixService->store( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            // dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


    public function edit($id) {
        try {
            $result = $this->equipmentPrefixService->edit($id);
            return view('backend.prefix.edit', compact('result'));
        } catch (\Exception $e) {
            // dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

    public function update(UpdateEquipmentPrefixRequest $request) {
        try {
            $result = $this->equipmentPrefixService->update( $request->all());
            return response()->json($result);

        } catch (\Exception $e) {
            dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

    public function delete(Request $request) {
        try {
            $result = $this->equipmentPrefixService->delete( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }




}
