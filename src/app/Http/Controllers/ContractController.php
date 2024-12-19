<?php
namespace App\Http\Controllers;
use App\Http\Requests\Contract\CreateContractRequest;
// use App\Http\Requests\Contract\UpdateContractRequest;
use App\Services\ContractService;
use Illuminate\Http\Request;

class ContractController extends Controller
{

    protected $contractService;

    public function __construct(ContractService $contractService)
    {
        $this->contractService = $contractService;
    }


    public function panel() {

        return view('backend.contract.panel');

    }


    public function getAll() {

        $result = $this->contractService->getAll();
        //  return response()->json($result);

        if(request()->ajax()) {

            return datatables()->of($result)
            ->addColumn('action', function($row){
                $idx = $row->id;
                $btn  = "<a href='contract/edit/$idx' data-toggle='tooltip' data-id='$idx' class='edit'><span class='fas fa-pencil-alt'></a>&nbsp;";
                $btn .= "<a href='javascript:void(0)' data-toggle='tooltip' onClick='deleteReg($idx)' data-id='$idx' class='delete'><span class='fas fa-trash'></span></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('backend.contract.contractlist');

    }

    // Tela Cadastrar somente Contrato
    public function getDataToCreate() {
        try {
            $result = $this->contractService->getDataToCreate();
            return view('backend.contract.create', compact('result'));
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }


    // Tela para Cadastrar Contrato no equipamento
    public function getEquipmentContract() {
        try {
            $result = $this->contractService->getEquipmentContract();
            return view('backend.contract.equipment-contract', compact('result'));
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }
    public function store(CreateContractRequest $request) {
        try {
            $result = $this->contractService->store( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }

    // Mostrar os Contratos de um fornecedor específico pelo ID do fornecedor

    // IMPLEMENTAR ESSE METODO
    // UTILIZAR RADIOBOX PARA ABRIR MODAL DE VALORES
    //                         OU HABILITAR CAMPOS DE VALORES

    public function getContractBySupplyer($supplyer_id, $vehicle_id) {

        try {
            $result = $this->contractService->getContractBySupplyer($supplyer_id, $vehicle_id);

            return response()->json($result);

            if(request()->ajax()) {
                return datatables()->of($result)
                ->addIndexColumn()
                ->make(true);
            }

        } catch (\Exception $e) {
            dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }





    // public function edit($id) {
    //     try {
    //         $result = $this->contractService->edit($id);
    //         return view('backend.contract.edit', compact('result'));
    //     } catch (\Exception $e) {
    //         // dd($e);
    //         return response()->json(["error" => $e->getMessage()], $e->getCode());
    //     }

    // }

    // public function update(UpdateContractRequest $request) {

    //     try {
    //         $result = $this->contractService->update( $request->all());
    //         return response()->json($result);

    //     } catch (\Exception $e) {
    //         return response()->json(["error" => $e->getMessage()], $e->getCode());
    //     }

    // }

    // public function delete(Request $request) {

    //     try {
    //         $result = $this->contractService->delete( $request->all());
    //         return response()->json($result);
    //     } catch (\Exception $e) {
    //         return response()->json(["error" => $e->getMessage()], $e->getCode());
    //     }

    // }

}
