<?php

namespace App\Http\Controllers;
use App\Http\Requests\Company\CreateCompanyRequest;
use App\Services\CompanyService;

class CompanyController extends Controller
{

    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }


    public function getAll() {

        $result = $this->companyService->getAll();
        // return response()->json($result);

        if(request()->ajax()) {

            return datatables()->of($result)
            ->addColumn('action', function($row){
                $idx = $row->id;
                $btn = "<a href='javascript:void($idx)' data-toggle='tooltip' onClick='editFunc($idx)' data-id='$idx' class='edit'><span class='fas fa-pencil-alt'></a>&nbsp; <a href='javascript:void($idx)' data-toggle='tooltip' onClick='deleteFunc()' data-id='$idx' class='delete'><span class='fas fa-trash'></span></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('backend.company.companylist');

    }

    public function getDataToCreate() {

        try {
            return view('backend.company.create');
        } catch (\Exception $e) {
            dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }


    public function store(CreateCompanyRequest $request) {
        try {
            $result = $this->companyService->store( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

}
