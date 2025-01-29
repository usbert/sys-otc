<?php
namespace App\Http\Controllers;
use App\Http\Requests\Rfi\CreateRfiOverviewtRequest;
use App\Http\Requests\Rfi\UpdateRfiOverviewtRequest;
use App\Http\Requests\Rfi\CreateRfiRequest;
use App\Http\Requests\Rfi\CreateFileRequest;
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


    public function getRfiOverviewByUser(int $user_id) {
        try {

            $result = $this->rfiService->getRfiOverviewByUser($user_id);

            // return response()->json($result);

            if(request()->ajax()) {
                return datatables()->of($result)
                ->addColumn('action', function($row) {
                    $idx = $row->id;
                    $btn  = "<a href='javascript:fcGetRfiOverviewRow($idx)' data-toggle='tooltip' data-id='$idx' class='edit'><span class='fas fa-pencil-alt'></a>&nbsp;";
                    $btn .= "<a href='javascript:deleteRfiOverview($idx)' data-toggle='tooltip' data-id='$idx' class='delete'><span class='fas fa-trash'></span></a>&nbsp;";
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


    public function storeRfiOverviewByUser(CreateRfiOverviewtRequest $request) {
        try {
            $result = $this->rfiService->storeRfiOverviewByUser( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
           return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }

    public function updateRfiOverviewByUser(UpdateRfiOverviewtRequest $request) {
        try {
            $result = $this->rfiService->updateRfiOverviewByUser( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
           return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }

    // Clear all temporary RFI Overviews records
    public function deleteRfiOverview(Request $request) {
        try {
            $result = $this->rfiService->deleteRfiOverview( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }


    public function getRfiOverview($rfi_overview_id) {

        try {
            $result = $this->rfiService->getRfiOverview($rfi_overview_id);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }



    public function store(CreateRfiRequest $request) {
        try {
            $result = $this->rfiService->store( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            dd($e);
           return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }


    public function storeFile(CreateFileRequest $request) {
        try {
            $result = $this->rfiService->storeFile( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }



    // Clear all temporary RFI Overviews records
    public function deleteRfiOverviewByUser(Request $request) {
        try {
            $result = $this->rfiService->deleteRfiOverviewByUser( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }



}
