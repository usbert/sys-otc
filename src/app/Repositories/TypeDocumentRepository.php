<?php

namespace App\Repositories;

use App\Models\TypeDocument;
use App\Repositories\Interfaces\TypeDocumentRepositoryInterface;

class TypeDocumentRepository implements TypeDocumentRepositoryInterface
{
  public function getAll()
  {
    $typeDocuments = TypeDocument::withoutTrashed()
    ->get();

    return $typeDocuments;


  }

  public function find($id)
  {
    return false;
  }

  public function create(array $data)
  {
    $result = TypeDocument::create($data);
    return $result;

  }

  public function update($id, $data)
  {
    dd('CHEGOU NO UPDATE');
    return false;
  }

  public function delete($id)
  {
    dd('CHEGOU NO DELETE');
    return false;
  }
}
