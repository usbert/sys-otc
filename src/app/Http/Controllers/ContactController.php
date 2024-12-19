<?php
namespace App\Http\Controllers;
use App\Http\Requests\Contact\CreateContactRequest;
use App\Http\Requests\Contact\UpdateContactRequest;
use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }


    public function getAll() {

        $result = $this->contactService->getAll();
        // return response()->json($result);

        if(request()->ajax()) {

            return datatables()->of($result)
            ->addColumn('action', function($row){
                $idx = $row->id;
                $btn  = "<a href='contact/edit/$idx' data-toggle='tooltip' data-id='$idx' class='edit'><span class='fas fa-pencil-alt'></a>&nbsp;";
                $btn .= "<a href='javascript:void(0)' data-toggle='tooltip' onClick='deleteReg($idx)' data-id='$idx' class='delete'><span class='fas fa-trash'></span></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('backend.contact.contactlist');

    }

    public function getDataToCreate() {

        try {
            $result = $this->contactService->getDataToCreate();
            return view('backend.contact.create', compact('result'));

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }

    public function store(CreateContactRequest $request) {
        try {
            $result = $this->contactService->store( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
           return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }


     public function edit($id) {
        try {
            $result = $this->contactService->edit($id);
            return view('backend.contact.edit', compact('result'));
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }

    public function update(UpdateContactRequest $request) {
        try {
            $result = $this->contactService->update( $request->all());
            return response()->json($result);

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

    public function delete(Request $request) {

        try {
            $result = $this->contactService->delete( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }


}

