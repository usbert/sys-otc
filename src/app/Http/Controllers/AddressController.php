<?php

namespace App\Http\Controllers;
// use App\Http\Requests\Address\CreateAddressRequest;
use App\Services\AddressService;

class AddressController extends Controller
{

    protected $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }


    public function getAll() {

        $result = $this->addressService->getAll();
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

        return view('backend.address.addresslist');

    }

    public function getDataToCreate() {

        return view('backend.address.create');

        // try {
        //     return view('backend.address.create');
        // } catch (\Exception $e) {
        //     dd($e);
        //     return response()->json(["error" => $e->getMessage()], $e->getCode());
        // }

    }


    // public function store(CreateAddressRequest $request) {
    //     try {
    //         $result = $this->addressService->store( $request->all());
    //         return response()->json($result);
    //     } catch (\Exception $e) {
    //         dd($e);
    //         return response()->json(["error" => $e->getMessage()], $e->getCode());
    //     }

    // }

}
