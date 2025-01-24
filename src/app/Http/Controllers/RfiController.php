<?php
namespace App\Http\Controllers;
use App\Http\Requests\Rfi\CreateRfiRequest;
// use App\Http\Requests\Rfi\CreateLaborAppropriationRequest;
use App\Services\RfiService;
use Illuminate\Http\Request;

class RfiController extends Controller
{

    protected $rfiService;

    public function __construct(RfiService $rfiService)
    {
        $this->rfiService = $rfiService;
    }


    public function getAll() {

        $result = $this->rfiService->getAll();
        //  return response()->json($result);

        if(request()->ajax()) {

            return datatables()->of($result)
            ->addColumn('action', function($row){
                $idx = $row->id;
                $btn  = "<a href='rfi/edit/$idx' data-toggle='tooltip' data-id='$idx' class='edit'><span class='fas fa-pencil-alt'></a>&nbsp;";
                $btn .= "<a href='javascript:void(0)' data-toggle='tooltip' onClick='deleteReg($idx)' data-id='$idx' class='delete'><span class='fas fa-trash'></span></a>&nbsp;";
                $btn .= "<a href='javascript:void(0)' data-toggle='tooltip' onClick='printReg($idx)' data-id='$idx' class='delete'><span class='fas fa-print'></span></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('backend.rfi.rfilist');

    }


    public function getDataToCreate() {

        try {
            $result = $this->rfiService->getDataToCreate();
            return view('backend.rfi.create', compact('result'));

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }


}
