<?php

namespace App\Repositories;

use App\Models\Supplyer;
use App\Repositories\Interfaces\SupplyerRepositoryInterface;

class SupplyerRepository implements SupplyerRepositoryInterface
{
  public function getAll()
  {
    $supplyers = Supplyer::where('is_activated', 1)
    ->get();

    return $supplyers;


  }

  public function store($data)
    {
      return Supplyer::create($data)->id;
    }

    public function edit($id)
    {
        $supplyer = Supplyer::where('id', $id)->get();
        $supplyer = array(
            'supplyer' => $supplyer,
        );

        return $supplyer;

    }


    public function update(array $data)
    {
        try {

            $input                  = Supplyer::find($data['id']);
            $input->name            = $data['name'];
            $input->fantasy_name    = $data['fantasy_name'];
            $input->document_number = $data['document_number'];

            $input->save();

            return $input;

        } catch (\Exception $e) {
            // dd($e);
            return response()->json(["error" => $e->getMessage()]);
        }

    }

    public function delete($id)
    {
        $return = Supplyer::destroy($id);
        return $return;
    }

}
