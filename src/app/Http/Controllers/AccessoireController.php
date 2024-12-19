<?php
namespace App\Http\Controllers;
// use App\Http\Requests\Accessoire\CreateAccessoireRequest;
// use App\Http\Requests\Accessoire\UpdateAccessoireRequest;
use App\Services\AccessoireService;
use Illuminate\Http\Request;

class AccessoireController extends Controller
{

    protected $accessoireService;

    public function __construct(AccessoireService $accessoireService)
    {
        $this->accessoireService = $accessoireService;
    }


    // public function panel() {

    //     return view('backend.accessoire.panel');

    // }


    public function getAll() {

        $result = $this->accessoireService->getAll();
        // return response()->json($result);

        if(request()->ajax()) {

            return datatables()->of($result)
            ->addColumn('action', function($row){
                $idx = $row->id;
                $btn  = "<a href='accessoire/edit/$idx' data-toggle='tooltip' data-id='$idx' class='edit'><span class='fas fa-pencil-alt'></a>&nbsp;";
                $btn .= "<a href='javascript:void(0)' data-toggle='tooltip' onClick='deleteReg($idx)' data-id='$idx' class='delete'><span class='fas fa-trash'></span></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('backend.accessoire.accessoirelist');


    }

    // Tela Cadastrar somente Contrato
    public function getDataToCreate() {

        return view('backend.accessoire.create');

        // try {
        //     $result = $this->accessoireService->getDataToCreate();
        //     return view('backend.accessoire.create', compact('result'));
        // } catch (\Exception $e) {
        //     return response()->json(["error" => $e->getMessage()], $e->getCode());
        // }
    }


}
