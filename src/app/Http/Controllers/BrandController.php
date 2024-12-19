<?php

namespace App\Http\Controllers;
use App\Http\Requests\Brand\CreateBrandRequest;
use App\Http\Requests\Brand\UpdateBrandRequest;
use App\Services\BrandService;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }


    public function getAll()
    {

        $result = $this->brandService->getAll();
        // return response()->json($result);

        if(request()->ajax()) {

            return datatables()->of($result)
            ->addColumn('action', function($row){
                $idx = $row->id;
                $btn  = "<a href='brand/edit/$idx' data-toggle='tooltip' data-id='$idx' class='edit'><span class='fas fa-pencil-alt'></a>&nbsp;";
                $btn .= "<a href='javascript:void(0)' data-toggle='tooltip' onClick='deleteReg($idx)' data-id='$idx' class='delete'><span class='fas fa-trash'></span></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

        }


        return view('backend.brand.brandlist');

        // $brands = Brand::latest()->paginate(6);
        // return view('backend.brand.brandlist', compact('brands'));
    }


    public function getDataToCreate() {

        try {
            return view('backend.brand.create');
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }


    public function store(CreateBrandRequest $request) {
        try {
            $result = $this->brandService->store( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            // dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


    public function edit($id) {
        try {
            $result = $this->brandService->edit($id);
            return view('backend.brand.edit', compact('result'));
        } catch (\Exception $e) {
            // dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

    public function update(UpdateBrandRequest $request) {
        try {
            $result = $this->brandService->update( $request->all());
            return response()->json($result);

        } catch (\Exception $e) {
            dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

    public function delete(Request $request) {

        try {
            $result = $this->brandService->delete( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


}
