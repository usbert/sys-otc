<?php

namespace App\Http\Controllers;

use App\Services\TypeDocumentService;
use App\Http\Requests\TypeDocument\CreateTypeDocumentRequest;
use App\Http\Requests\TypeDocument\UpdateTypeDocumentRequest;
use App\Models\TypeDocument;
use Illuminate\Http\Request;

class TypeDocumentController extends Controller
{

    protected $typeDocumentService;

    public function __construct(TypeDocumentService $typeDocumentService)
    {
        $this->typeDocumentService = $typeDocumentService;
    }


    public function getAll() {

        $result = $this->typeDocumentService->getAll();
        // return response()->json($result);

        if(request()->ajax()) {

            return datatables()->of($result)
            ->addColumn('action', function($row){
                $idx = $row->id;
                $btn = "<a href='javascript:void($idx)' data-toggle='tooltip' onClick='showModalEdit($idx)' data-id='$idx' class='edit'><span class='fas fa-pencil-alt'></a>&nbsp; <a href='javascript:void(0)' data-toggle='tooltip' onClick='deleteReg($idx)' data-id='$idx' class='delete'><span class='fas fa-trash'></span></a>";

                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('backend.type-document.type-document-list');

    }


    public function store(CreateTypeDocumentRequest $request) {

        // $input = $request->all();
        // dd($input);

        try {
            $dto = $request->toDTO();
            $result = $this->typeDocumentService->create( $dto);
            return response()->json($result);

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

    public function delete(Request $request) {

        $return = TypeDocument::destroy($request->id);
        return $return;

    }

    public function edit(Request $request) {

        $id = $request->id;

        $result = TypeDocument::get()->where('id', $id);
        return response()->json($result);

    }


    // public function update(UpdateTypeDocumentRequest $request) {

    //     $result = $this->typeDocumentService->getAll();
    //     // return response()->json($result);

    // }





}

