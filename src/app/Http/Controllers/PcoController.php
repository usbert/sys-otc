<?php
namespace App\Http\Controllers;
use App\Http\Requests\Pco\CreatePcoRequest;
use App\Http\Requests\Pco\CreateServiceItemRequest;
use App\Http\Requests\Pco\UpdateServiceItemRequest;
use App\Http\Requests\Pco\CreateLaborAppropriationRequest;
use App\Http\Requests\Pco\UpdateLaborAppropriationRequest;
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

        try {
            $result = $this->pcoService->getDataToCreate();
            //  return response()->json($result);
            return view('backend.pco.create', compact('result'));
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


    // CARREGAR OS DADOS DO PROJETO (endereço)
    public function getAddressByProject($project_id) {

        try {
            $result = $this->pcoService->getAddressByProject($project_id);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }


    public function store(CreatePcoRequest $request) {
        try {
            $result = $this->pcoService->store( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
           return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }

    public function storeServiceItem(CreateServiceItemRequest $request) {
        try {
            $result = $this->pcoService->storeServiceItem( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
           return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }

    public function getServiceItemByUser($user_id) {
        try {
            $result = $this->pcoService->getServiceItemByUser($user_id);

            // return response()->json($result);

            if(request()->ajax()) {
                return datatables()->of($result)
                // ->addColumn('action', function($row) {
                //     $idx = $row->id;
                //     $btn  = "<a href='javascript:fcUpdateServiceItem($idx,$row)' data-toggle='tooltip' data-id='$idx' class='edit'><span class='fas fa-pencil-alt'></a>&nbsp;";
                //     $btn .= "<a href='javascript:void(0)' data-toggle='tooltip' onClick='deleteReg($idx)' data-id='$idx' class='delete'><span class='fas fa-trash'></span></a>&nbsp;";
                //     return $btn;
                // })
                // ->rawColumns(['action'])
                // ->addIndexColumn()
                ->make(true);

            }

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }



    public function edit($id) {
        try {
            $result = $this->pcoService->edit($id);
            return view('backend.pco.edit', compact('result'));
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }


    public function delete(Request $request) {

        try {
            $result = $this->pcoService->delete( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


    public function deleteServiceItemByUser(Request $request) {
        try {
            $result = $this->pcoService->deleteServiceItemByUser( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


    public function updateServiceItem(UpdateServiceItemRequest $request) {
        try {
            $result = $this->pcoService->updateServiceItem( $request->all());
            return response()->json($result);

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

    public function deleteServiceItem(Request $request) {

        try {
            $result = $this->pcoService->deleteServiceItem( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

    public function storeLaborAppropriation(CreateLaborAppropriationRequest $request) {

        try {
            $result = $this->pcoService->storeLaborAppropriation( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            dd($e);
           return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }


    public function getLaborAppropriationByUser(int $service_item_id, int $user_id) {
        try {
            $result = $this->pcoService->getLaborAppropriationByUser($service_item_id, $user_id);

            // return response()->json($result);

            if(request()->ajax()) {
                return datatables()->of($result)
                ->addColumn('action', function($row) {
                    $idx = $row->id;
                    $btn  = "<a href='javascript:fcGetLaborAppropriationRow($idx,$row)' data-toggle='tooltip' data-id='$idx' class='edit'><span class='fas fa-pencil-alt'></a>&nbsp;";
                    $btn .= "<a href='javascript:deleteLaborAppropriation($idx)' data-toggle='tooltip' data-id='$idx' class='delete'><span class='fas fa-trash'></span></a>&nbsp;";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);

            }

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }


    public function deleteLaborAppropriation(Request $request) {

        try {
            $result = $this->pcoService->deleteLaborAppropriation( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


    public function updateLaborAppropriation(UpdateLaborAppropriationRequest $request) {
        try {
            $result = $this->pcoService->updateLaborAppropriation( $request->all());

            return response()->json($result);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

}
