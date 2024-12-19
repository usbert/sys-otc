<?php

namespace App\Repositories;

use App\Models\FieldActivity;

use App\Repositories\Interfaces\FieldActivityRepositoryInterface;

class FieldActivityRepository implements FieldActivityRepositoryInterface
{
  public function getAll()
  {
    $fieldActivity = FieldActivity::where('is_activated', 1)->get();
    return $fieldActivity;

  }


  public function store($data)
  {
    // CRIA UM ID E ENVIA PARA USAR COMO FK
    return FieldActivity::create($data)->id;
  }


  public function getById($id) {
    return FieldActivity::findOrFail($id);
  }

  public function update(array $data)
  {

    try {

        $input                       = FieldActivity::find($data['id']);
        $input->code                 = $data['code'];
        $input->name                 = $data['name'];
        $input->save();

        return $input;

    } catch (\Exception $e) {
        return response()->json(["error" => $e->getMessage()]);
    }

  }


  public function edit($id)
  {

     $fieldActivity = FieldActivity::where('id', $id)->get();

     $result = array(
        // TABELA PRINCIPAL
         'fieldActivity'      => $fieldActivity,
    );

    return $result;

  }

  public function delete($id)
  {

    $return = FieldActivity::destroy($id);
        return $return;

  }

}
