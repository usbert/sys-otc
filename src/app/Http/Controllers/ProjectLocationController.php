<?php

namespace App\Http\Controllers;

use App\Services\ProjectLocationService;
use App\Http\Requests\ProjectLocation\CreateProjectLocationRequest;
use App\Http\Requests\ProjectLocation\UpdateProjectLocationRequest;
use Illuminate\Http\Request;

class ProjectLocationController extends Controller
{

    protected $projectLocationService;

    public function __construct(ProjectLocationService $projectLocationService)
    {
        $this->projectLocationService = $projectLocationService;
    }

    public function getAll() {

        $result = $this->projectLocationService->getAll();
        //   return $result;

        if(request()->ajax()) {

            return datatables()->of($result)
            ->addColumn('action', function($row){
                $idx = $row->id;
                $btn  = "<a href='location/edit/$idx' data-toggle='tooltip' data-id='$idx' class='edit'><span class='fas fa-pencil-alt'></a>&nbsp;";
                $btn .= "<a href='javascript:void(0)' data-toggle='tooltip' onClick='deleteReg($idx)' data-id='$idx' class='delete'><span class='fas fa-trash'></span></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('backend.location.locationlist');

    }


    public function getDataToCreate() {

        try {
            $result = $this->projectLocationService->getDataToCreate();
            //  return response()->json($result);
            return view('backend.location.create', compact('result'));

        } catch (\Exception $e) {
            // dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }

    public function store(CreateProjectLocationRequest $request) {
        try {
            $result = $this->projectLocationService->store( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

    public function update(UpdateProjectLocationRequest $request) {
        try {
            $result = $this->projectLocationService->update( $request->all());
            return response()->json($result);

        } catch (\Exception $e) {
            // dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


    public function edit($id) {
        try {
            $result = $this->projectLocationService->edit($id);
            return view('backend.location.edit', compact('result'));
        } catch (\Exception $e) {
            // dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

    public function delete(Request $request) {
        try {
            $result = $this->projectLocationService->delete( $request->all());
            return response()->json($result);

        } catch (\Exception $e) {
            dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }



}
