<?php

namespace App\Services;

use App\Repositories\Interfaces\AddressRepositoryInterface;

class AddressService
{

    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function getAll()
    {
        return $this->addressRepository->getAll();
    }

    public function store(array $data)
    {
        // MAIN TABLE
        $address = array(
            'name'          => $data['name'],
            'segment'       => $data['segment'],
            'fantasy_name'  => $data['fantasy_name'],
        );
        $address_id = $this->addressRepository->store($address);
        // end MAIN TABLE

    }

    public function update(array $data, $id)
    {
        return false;
    }

    public function delete($id)
    {
        return false;
    }




}
