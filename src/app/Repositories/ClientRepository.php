<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\AddressClient;
use App\Models\Project;
use App\Models\Client;
use App\Models\ProjectClient;

use App\Repositories\Interfaces\ClientRepositoryInterface;

class ClientRepository implements ClientRepositoryInterface
{
  public function getAll()
  {

    $clients = Client::select(
            'id',
            'name',
            'address',
            'city',
            'state',
            'country',
            'zip_code',
            'phone',
            'email',
            'responsible',
        )
        ->selectRaw('lpad(id, 5, 0) as code')
        ->where('is_activated', Client::ACTIVATED)
        ->orderBy('name', 'asc')
        ->get();

    return $clients;

  }

  public function find($id)
  {
    return false;
  }


  public function store($data)
  {
    return Client::create($data)->id;
  }


  public function edit($id)
  {
    $client = Client::where('id', $id)->get();

    $return = array(
        'client' => $client,
    );

    return $return;

  }

  public function update(array $data)
  {

    try {

        $input                = Client::find($data['id']);
        $input->name          = $data['name'];
        $input->address       = $data['address'];
        $input->city          = $data['city'];
        $input->state         = $data['state'];
        $input->country       = $data['country'];
        $input->zip_code      = $data['zip_code'];
        $input->phone         = $data['phone'];
        $input->email         = $data['email'];
        $input->responsible   = $data['responsible'];

        $input->save();

        return $input;

    } catch (\Exception $e) {
        return response()->json(["error" => $e->getMessage()]);
    }

  }

  public function delete($id)
  {
        $return = Client::destroy($id);
        return $return;
  }

}
