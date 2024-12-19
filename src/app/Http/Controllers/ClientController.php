<?php
namespace App\Http\Controllers;
use App\Http\Requests\Client\CreateClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function getAll() {

        $result = $this->clientService->getAll();
        // return response()->json($result);

        if(request()->ajax()) {

            return datatables()->of($result)
            ->addColumn('action', function($row){
                $idx = $row->id;
                $btn  = "<a href='client/edit/$idx' data-toggle='tooltip' data-id='$idx' class='edit'><span class='fas fa-pencil-alt'></a>&nbsp;";
                $btn .= "<a href='javascript:void(0)' data-toggle='tooltip' onClick='deleteReg($idx)' data-id='$idx' class='delete'><span class='fas fa-trash'></span></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('backend.client.clientlist');

    }


     public function getDataToCreate() {

        return view('backend.client.create');

        // try {
        //     $result = $this->clientService->getDataToCreate();
        //     //  return response()->json($result);
        //     return view('backend.client.create', compact('result'));
        // } catch (\Exception $e) {
        //     return response()->json(["error" => $e->getMessage()], $e->getCode());
        // }
    }

    public function store(CreateClientRequest $request) {

        try {
            $result = $this->clientService->store( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            // dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

    public function edit($id) {
        try {
            $result = $this->clientService->edit($id);
            return view('backend.client.edit', compact('result'));
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

    public function update(UpdateClientRequest $request) {

        try {
            $result = $this->clientService->update( $request->all());
            return response()->json($result);

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

    public function delete(Request $request) {

        try {
            $result = $this->clientService->delete( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

}
