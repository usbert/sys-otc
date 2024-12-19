<?php

namespace App\Http\Controllers;
use App\Http\Requests\Supplyer\CreateSupplyerRequest;
use App\Http\Requests\Supplyer\UpdateSupplyerRequest;
use App\Services\SupplyerService;
use Illuminate\Http\Request;

class SupplyerController extends Controller
{
    protected $supplyerService;

    public function __construct(SupplyerService $supplyerService)
    {
        $this->supplyerService = $supplyerService;
    }

    public function getAll()
    {

        $result = $this->supplyerService->getAll();
        // return response()->json($result);

        if(request()->ajax()) {

            return datatables()->of($result)
            ->addColumn('action', function($row){
                $idx = $row->id;
                $btn  = "<a href='supplyer/edit/$idx' data-toggle='tooltip' data-id='$idx' class='edit'><span class='fas fa-pencil-alt'></a>&nbsp;";
                $btn .= "<a href='javascript:void(0)' data-toggle='tooltip' onClick='deleteReg($idx)' data-id='$idx' class='delete'><span class='fas fa-trash'></span></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }

        return view('backend.supplyer.supplyerlist');
    }



    public function getDataToCreate() {
        try {
            return view('backend.supplyer.create');
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }


    public function store(CreateSupplyerRequest $request) {
        try {
            $result = $this->supplyerService->store( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            // dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


    public function edit($id) {
        try {
            $result = $this->supplyerService->edit($id);
            return view('backend.supplyer.edit', compact('result'));
        } catch (\Exception $e) {
            // dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

    public function update(UpdateSupplyerRequest $request) {

        try {
            $result = $this->supplyerService->update( $request->all());
            return response()->json($result);

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

    public function delete(Request $request) {

        try {
            $result = $this->supplyerService->delete( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


}
