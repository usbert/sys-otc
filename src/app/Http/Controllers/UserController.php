<?php
namespace App\Http\Controllers;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getAll() {

        $result = $this->userService->getAll();
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
                $btn  = "<a href='user/edit/$idx' data-toggle='tooltip' data-id='$idx' class='edit'><span class='fas fa-pencil-alt'></a>&nbsp;";
                $btn .= "<a href='javascript:void(0)' data-toggle='tooltip' onClick='deleteReg($idx)' data-id='$idx' class='delete'><span class='fas fa-trash'></span></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

        }

        return view('backend.user.userlist');

    }


    public function getDataToCreate() {

        try {
            $result = $this->userService->getDataToCreate();
            // return response()->json($result);
            return view('backend.user.create', compact('result'));
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }

    public function store(CreateUserRequest $request) {
        try {
            $result = $this->userService->store( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

    public function edit($id) {
        try {
            $result = $this->userService->edit($id);
            return view('backend.user.edit', compact('result'));
        } catch (\Exception $e) {
            dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }

    public function update(UpdateUserRequest $request) {

        try {
            $result = $this->userService->update( $request->all());
            return response()->json($result);

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

    // public function delete(Request $request) {

    //     try {
    //         $result = $this->userService->delete( $request->all());
    //         return response()->json($result);
    //     } catch (\Exception $e) {
    //         return response()->json(["error" => $e->getMessage()], $e->getCode());
    //     }

    // }

}
