<?php

namespace App\Services;

use App\Repositories\Interfaces\FileRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FileService
{

    public function __construct(FileRepositoryInterface $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    public function store(array $data)
    {

        $file = $data['image'];
        $filename = $file->getClientOriginalName(); // Retrieve the original filename

        $uuid = Str::uuid();

        // Get extension name to concat in file name
        $EXT = explode('.', $filename);
        $name = $uuid.'.'.$EXT[1];
        $type_document_id = $data['type_document_id'];

        // break uuid to formate path (type_document_id/aa/bb/cc/dd) four part at one
        // example: 1/90/d8/12/84/
        $path = $type_document_id.'/'.substr($uuid,0,2).'/'.substr($uuid,2,2).'/'.substr($uuid,4,2).'/'.substr($uuid,6,2).'/';

        Storage::disk('local')->put($path.'/'.$name, file_get_contents($file));

        $file = array(
            'uuid'              => $uuid,
            'name'              => $name,
            'type_document_id'  => $type_document_id,
            'vehicle_id'        => $data['vehicle_id'],
            'project_id'        => $data['project_id'],
            'original_name'     => $data['original_name'],
            'comment'           => $data['comment'],
            'user_id'           => Auth::user()->id,
        );

        $file_id = $this->fileRepository->store($file);
        // end MAIN TABLE

    }

    public function deleteFile(array $data)
    {
        $del = $this->fileRepository->deleteFile($data['id']);
    }


}
