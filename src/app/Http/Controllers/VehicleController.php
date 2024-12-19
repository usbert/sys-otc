<?php

namespace App\Http\Controllers;
use App\Services\VehicleService;
use App\Http\Requests\Vehicle\CreateVehicleRequest;
use App\Http\Requests\Vehicle\UpdateVehicleRequest;
use App\Http\Requests\Vehicle\UpdateMobilizationHistoricRequest;
use App\Http\Requests\Vehicle\UpdateTransferHistoricRequest;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Type\Integer;

class VehicleController extends Controller
{

    protected $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    public function getAll() {

        $result = $this->vehicleService->getAll();
        // return response()->json($result);

        if(request()->ajax()) {

            return datatables()->of($result)
            ->addColumn('action', function($row){
                $idx = $row->id;
                $btn  = "<a href='vehicle/edit/$idx' data-toggle='tooltip' data-id='$idx' class='edit'><span class='fas fa-pencil-alt'></a>&nbsp;";
                // $btn .= "<a href='javascript:void(0)' data-toggle='tooltip' onClick='deleteReg($idx)' data-id='$idx' class='delete'><span class='fas fa-trash'></span></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('backend.vehicle.vehiclelist');

    }

    public function getDataToCreate() {

        try {
            $result = $this->vehicleService->getDataToCreate();
            return view('backend.vehicle.create', compact('result'));

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }

    // CARREGAR OS MODELOS DO DATATABLE PARA O FORM
    public function getModel($id) {
        try {
            $result = $this->vehicleService->getModel($id);
            return response()->json($result);

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }

    // MONTAR O COMBOBOX DOS MOTORISTAS DO PROJETO SELECIONADO
    public function getClient($id) {
        try {
            $result = $this->vehicleService->getClient($id);
            return response()->json($result);

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }

    // MONTAR O COMBOBOX DOS MOTORISTAS DO PROJETO SELECIONADO
    public function getDriver($id) {
        try {
            $result = $this->vehicleService->getDriver($id);
            return response()->json($result);

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }

    // MONTAR O COMBOBOX DAS ATIVIDADES DO PROJETO SELECIONADO
    public function getActivity($id) {
        try {
            $result = $this->vehicleService->getActivity($id);
            return response()->json($result);

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }

    public function store(CreateVehicleRequest $request) {
        try {
            $result = $this->vehicleService->store( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
           return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }

    public function edit($id) {
        try {
            $result = $this->vehicleService->edit($id);
            if(sizeof($result['vehicle']) == 0) {
                // usuário não permitido ou equipamento não localizado
                return view('backend.vehicle.vehiclelist');
            }
            return view('backend.vehicle.edit', compact('result'));
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }

    public function update(UpdateVehicleRequest $request) {
        try {
            $result = $this->vehicleService->update( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


    public function getDataToDemob() {

        try {
            $result = $this->vehicleService->getDataToDemob();
            return view('backend.vehicle.demobilization', compact('result'));
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


    public function getDataToTransfer() {
        try {
            $result = $this->vehicleService->getDataToDemob();
            return view('backend.vehicle.transfer', compact('result'));
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }



    // CARREGAR OS DADOS DO EQUIPAMENTO NO FORM
    public function getEquipment(string $statuses, string $prefix, string $vin_number) {

        try {
            $result = $this->vehicleService->getEquipment($statuses, $prefix, $vin_number);
            return response()->json($result);

        } catch (\Exception $e) {
            dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }


    public function getMobilization($vehicle_id) {
        try {
            $result = $this->vehicleService->getMobilization($vehicle_id);
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


    public function getFile($id) {
        try {
            $result = $this->vehicleService->getFile($id);

            if(request()->ajax()) {
                return datatables()->of($result)
                ->addColumn('action', function($row) {
                    $idx = $row->id;
                    $uuidx = $row->uuid;

                    $path = $row->type_document_id.'/'.substr($uuidx,0,2).'/'.substr($uuidx,2,2).'/'.substr($uuidx,4,2).'/'.substr($uuidx,6,2);
                    $fileUrl = Storage::disk('local')->url($path.'/'.$row->file_name);


                    $btn  = "<a href='$fileUrl' data-toggle='tooltip' data-id='$idx' class='edit'><span class='fas fa-download'></a>&nbsp;";
                    $btn .= "<a href='javascript:void(0)' data-toggle='tooltip' onClick='deleteReg($idx)' data-id='$idx' class='delete'><span class='fas fa-trash'></span></a>";
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


    // DESMOBILIZAR EQUIPAMENTO
    public function updateDemobilization(UpdateMobilizationHistoricRequest $request) {
        // dd( $request);
        try {
            $result = $this->vehicleService->updateDemobilization( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

    // TRANSFERÊNCIA DE EQUIPAMENTO
    public function updateTransfer(UpdateTransferHistoricRequest $request) {
        // dd( $request);
        try {
            $result = $this->vehicleService->updateTransfer( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

}
