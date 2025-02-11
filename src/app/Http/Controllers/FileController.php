<?php

namespace App\Http\Controllers;
use App\Services\FileService;
use App\Http\Requests\File\CreateFileProjectRequest;
use Illuminate\Http\Request;

class FileController extends Controller
{

    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }


    public function store(CreateFileProjectRequest $request) {
        try {
            $result = $this->fileService->store( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }
    }

    public function deleteFile(Request $request) {
        try {
            $result = $this->fileService->deleteFile( $request->all());
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], $e->getCode());
        }

    }

}
