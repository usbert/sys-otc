<?php
namespace App\Http\Controllers;
use App\Http\Requests\Pco\CreatePcoRequest;
// use App\Http\Requests\Pco\UpdatePcoRequest;
use App\Services\PcoService;
use Illuminate\Http\Request;

class PcoController extends Controller
{

    protected $pcoService;

    public function __construct(PcoService $pcoService)
    {
        $this->pcoService = $pcoService;
    }


    // public function panel() {

    //     return view('backend.pco.panel');

    // }


    public function getAll() {

        $result = $this->pcoService->getAll();
        //  return response()->json($result);

        if(request()->ajax()) {

            return datatables()->of($result)
            ->addColumn('action', function($row){
                $idx = $row->id;
                $btn  = "<a href='pco/edit/$idx' data-toggle='tooltip' data-id='$idx' class='edit'><span class='fas fa-pencil-alt'></a>&nbsp;";
                $btn .= "<a href='javascript:void(0)' data-toggle='tooltip' onClick='deleteReg($idx)' data-id='$idx' class='delete'><span class='fas fa-trash'></span></a>&nbsp;";
                $btn .= "<a href='javascript:void(0)' data-toggle='tooltip' onClick='printReg($idx)' data-id='$idx' class='delete'><span class='fas fa-print'></span></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('backend.pco.pcolist');

    }

    // Tela Cadastrar somente Contrato
    public function getDataToCreate() {

        return view('backend.pco.create');

        // try {
        //     $result = $this->pcoService->getDataToCreate();
        //     return view('backend.pco.create', compact('result'));
        // } catch (\Exception $e) {
        //     return response()->json(["error" => $e->getMessage()], $e->getCode());
        // }
    }


}
