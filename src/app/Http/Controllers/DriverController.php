<?php

namespace App\Http\Controllers;
use App\Http\Requests\Driver\CreateDriverRequest;
use App\Http\Requests\Driver\UpdateDriverRequest;
use App\Services\DriverService;
use Illuminate\Http\Request;

class DriverController extends Controller
{

    protected $driverService;

    public function __construct(DriverService $driverService)
    {
        $this->driverService = $driverService;
    }


    public function getAll() {

        $result = $this->driverService->getAll();
        // return response()->json($result);

        if(request()->ajax()) {

            return datatables()->of($result)
            ->addColumn('action', function($row){
                $idx = $row->id;
                $btn  = "<a href='driver/edit/$idx' data-toggle='tooltip' data-id='$idx' class='edit'><span class='fas fa-pencil-alt'></a>&nbsp;";
                $btn .= "<a href='javascript:void(0)' data-toggle='tooltip' onClick='deleteReg($idx)' data-id='$idx' class='delete'><span class='fas fa-trash'></span></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('backend.driver.driverlist');

    }

    public function getDataToCreate() {

        $result = $this->driverService->getDataToCreate();
        // return response()->json($result);
        return view('backend.driver.create', compact('result'));

    }


    public function store(CreateDriverRequest $request) {

        try {
            $result = $this->driverService->store( $request->all());
            return response()->json($result);

        } catch (\Exception $e) {
            // dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }


    }

    public function edit($id) {
        try {
            $result = $this->driverService->edit($id);
            return view('backend.driver.edit', compact('result'));
        } catch (\Exception $e) {
            // dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }


    public function update(UpdateDriverRequest $request) {
        try {
            $result = $this->driverService->update( $request->all());
            return response()->json($result);

        } catch (\Exception $e) {
            // dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

    public function delete(Request $request) {
        try {
            $result = $this->driverService->delete( $request->all());
            return response()->json($result);

        } catch (\Exception $e) {
            // dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


}
