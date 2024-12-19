<?php
namespace App\Http\Controllers;
// use App\Http\Requests\Warehouse\CreateWarehouseRequest;
// use App\Http\Requests\Warehouse\UpdateWarehouseRequest;
use App\Services\WarehouseService;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{

    protected $warehouseService;

    public function __construct(WarehouseService $warehouseService)
    {
        $this->warehouseService = $warehouseService;
    }

    public function getAll() {

        $result = $this->warehouseService->getAll();
        // return response()->json($result);

        if(request()->ajax()) {

            return datatables()->of($result)
            ->addColumn('action', function($row){
                $idx = $row->id;
                $btn  = "<a href='warehouse/edit/$idx' data-toggle='tooltip' data-id='$idx' class='edit'><span class='fas fa-pencil-alt'></a>&nbsp;";
                $btn .= "<a href='javascript:void(0)' data-toggle='tooltip' onClick='deleteReg($idx)' data-id='$idx' class='delete'><span class='fas fa-trash'></span></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('backend.warehouse.warehouselist');

    }

    public function getDataToCreate() {

        try {
            $result = $this->warehouseService->getDataToCreate();
            //  return response()->json($result);
            return view('backend.warehouse.create', compact('result'));
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }




}
