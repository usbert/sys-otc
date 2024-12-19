<?php
namespace App\Http\Controllers;
use App\Http\Requests\Supervisor\CreateSupervisorRequest;
use App\Http\Requests\Supervisor\UpdateSupervisorRequest;
use App\Services\SupervisorService;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{

    protected $supervisorService;

    public function __construct(SupervisorService $supervisorService)
    {
        $this->supervisorService = $supervisorService;
    }

    public function getAll() {

        $result = $this->supervisorService->getAll();
        // return response()->json($result);

        // $return[] = [
        //     'success'    => true,
        //     'data' => $result,
        //     'message'      =>  ''
        // ];

        // return $return;

        if(request()->ajax()) {

            return datatables()->of($result)
            ->addColumn('action', function($row){
                $idx = $row->id;
                $btn  = "<a href='supervisor/edit/$idx' data-toggle='tooltip' data-id='$idx' class='edit'><span class='fas fa-pencil-alt'></a>&nbsp;";
                $btn .= "<a href='javascript:void(0)' data-toggle='tooltip' onClick='deleteReg($idx)' data-id='$idx' class='delete'><span class='fas fa-trash'></span></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('backend.supervisor.supervisorlist');

    }


    public function getDataToCreate() {

        try {
            return view('backend.supervisor.create');
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }

    public function store(CreateSupervisorRequest $request) {
        try {
            $result = $this->supervisorService->store( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

    public function edit($id) {
        try {
            $result = $this->supervisorService->edit($id);
            return view('backend.supervisor.edit', compact('result'));
        } catch (\Exception $e) {
            // dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

    public function update(UpdateSupervisorRequest $request) {

        try {
            $result = $this->supervisorService->update( $request->all());
            return response()->json($result);

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

    public function delete(Request $request) {

        try {
            $result = $this->supervisorService->delete( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

}
