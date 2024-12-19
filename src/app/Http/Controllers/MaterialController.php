<?php
namespace App\Http\Controllers;
// use App\Http\Requests\Material\CreateMaterialRequest;
// use App\Http\Requests\Material\UpdateMaterialRequest;
use App\Services\MaterialService;
use Illuminate\Http\Request;

class MaterialController extends Controller
{

    protected $materialService;

    public function __construct(MaterialService $materialService)
    {
        $this->materialService = $materialService;
    }


    // public function panel() {

    //     return view('backend.material.panel');

    // }


    public function getAll() {


        $result = $this->materialService->getAll();
        // return response()->json($result);

        if(request()->ajax()) {

            return datatables()->of($result)
            ->addColumn('action', function($row){
                $idx = $row->id;
                $btn  = "<a href='material/edit/$idx' data-toggle='tooltip' data-id='$idx' class='edit'><span class='fas fa-pencil-alt'></a>&nbsp;";
                $btn .= "<a href='javascript:void(0)' data-toggle='tooltip' onClick='deleteReg($idx)' data-id='$idx' class='delete'><span class='fas fa-trash'></span></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('backend.material.materiallist');


    }

    // Tela Cadastrar somente Contrato
    public function getDataToCreate() {

        return view('backend.material.create');

        // try {
        //     $result = $this->materialService->getDataToCreate();
        //     return view('backend.material.create', compact('result'));
        // } catch (\Exception $e) {
        //     return response()->json(["error" => $e->getMessage()], $e->getCode());
        // }
    }


}
