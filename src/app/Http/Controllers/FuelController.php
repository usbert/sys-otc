<?php

namespace App\Http\Controllers;
use App\Models\Fuel;
use Illuminate\Http\Request;

class FuelController extends Controller
{
    public function index()
    {
        $fuel = Fuel::get();

        if(request()->ajax()) {

            return datatables()->of($fuel)
            ->addColumn('action', function($row){
                $idx = $row->id;
                $btn = "<a href='javascript:void($idx)' data-toggle='tooltip' onClick='editFunc($idx)' data-id='$idx' class='edit btn btn-primary edit'><span class='fas fa-pencil-alt'></a> <a href='javascript:void($idx)' data-toggle='tooltip' onClick='deleteFunc()' data-id='$idx' class='delete btn btn-danger'><span class='fa fa-trash'></span></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('backend.fuel.fuellist');
    }


}
