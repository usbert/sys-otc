<?php

namespace App\Http\Controllers;

use App\Services\FieldActivityService;
use App\Http\Requests\FieldActivity\CreateFieldActivityRequest;
use App\Http\Requests\FieldActivity\UpdateFieldActivityRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FieldActivityController extends Controller
{

    protected $fieldActivityService;

    public function __construct(FieldActivityService $fieldActivityService)
    {
        $this->fieldActivityService = $fieldActivityService;
    }

    public function getAll() {

        $result = $this->fieldActivityService->getAll();

        if(request()->ajax()) {

            return datatables()->of($result)
            ->addColumn('action', function($row){
                $idx = $row->id;
                $btn  = "<a href='field-activity/edit/$idx' data-toggle='tooltip' data-id='$idx' class='edit'><span class='fas fa-pencil-alt'></a>&nbsp;";
                $btn .= "<a href='javascript:void(0)' data-toggle='tooltip' onClick='deleteReg($idx)' data-id='$idx' class='delete'><span class='fas fa-trash'></span></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('backend.field-activity.field-activity-list');

    }

    public function getDataToCreate() {
        return view('backend.field-activity.create');
    }


    public function store(CreateFieldActivityRequest $request) {

        try {
            $result = $this->fieldActivityService->store( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
            // return $e->getMessage();
        }

    }


    public function edit($id) {
        try {
            $result = $this->fieldActivityService->edit($id);
            return view('backend.field-activity.edit', compact('result'));
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


    public function update(UpdateFieldActivityRequest $request) {

        try {
            $result = $this->fieldActivityService->update( $request->all());
            return response()->json($result);

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


    public function delete(Request $request) {
        try {
            $result = $this->fieldActivityService->delete( $request->all());
            return response()->json($result);

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


}
