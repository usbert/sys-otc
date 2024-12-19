<?php
namespace App\Http\Controllers;
use App\Services\PermissionService;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{

    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function getAll() {

        $result = $this->permissionService->getAll();
        return response()->json($result);
    }

    public function getPermissionByUser($user_id) {
        try {
            $user_id = Auth::user()->id;    
            $result = $this->permissionService->getPermissionByUser($user_id);
            // return view('backend.includes.dinamic-sidebar', compact('result'));
            return  $result;
            // return response()->json($result);

        } catch (\Exception $e) {
            dd($e);
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }

}
