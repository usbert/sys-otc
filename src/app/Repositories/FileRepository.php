<?php

namespace App\Repositories;

use App\Models\File;
use App\Repositories\Interfaces\FileRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class FileRepository implements FileRepositoryInterface
{

    public function store($data)
    {
      return File::create($data)->id;
    }


    public function deleteFile($id)
    {
        $file = File::select(
            'files.type_document_id',
            'name',
        )
        ->where('files.id', $id)
        ->get();
        $data = json_decode($file);


        // main folder
        $type_document_id = $data[0]->type_document_id;
        // others folders and file name
        $name = $data[0]->name;

        // Restore folders path
        $path = $type_document_id.'/'.substr($name,0,2).'/'.substr($name,2,2).'/'.substr($name,4,2).'/'.substr($name,6,2).'/';
        // remove file
        Storage::disk('local')->delete($path.'/'.$name);

        // delete register
        $return = File::destroy($id);
        return $return;
    }


}
