<?php

namespace App\Repositories;

use App\Models\Address;
use App\Repositories\Interfaces\AddressRepositoryInterface;

class AddressRepository implements AddressRepositoryInterface
{
  public function getAll()
  {
    $addresses = Address::where('is_activated', 1)
    ->where('is_activated', 1)
    ->orderby('street')
    ->get();

    return $addresses;

  }

  public function store($data)
  {
    return Address::create($data)->id;
  }

  public function update($id, $data)
  {
    return false;
  }

  public function delete($id)
  {
    return false;
  }
}
