<?php

namespace App\Services;

use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Repositories\Interfaces\ProjectClientRepositoryInterface;

class ClientService
{


    public function __construct(
        ClientRepositoryInterface $clientRepository,
        ProjectClientRepositoryInterface $projectClientRepository
    ) {
        $this->clientRepository = $clientRepository;
        $this->projectClientRepository = $projectClientRepository;

    }

    public function getAll()
    {
        return $this->clientRepository->getAll();
    }

    public function store(array $data)
    {
        // MAIN TABLE
        $client = array(
            'name'          => $data['name'],
            'address'       => $data['address'],
            'city'          => $data['city'],
            'state'         => $data['state'],
            'country'       => $data['country'],
            'zip_code'      => $data['zip_code'],
            'phone'         => $data['phone'],
            'email'         => strtolower($data['email']),
            'responsible'   => $data['responsible'],

        );
        $client_id = $this->clientRepository->store($client);
        // end MAIN TABLE


    }

    public function edit($id) {
        return $this->clientRepository->edit($id);
    }

    public function update(array $data)
    {

        $client = array(
            'id'            => $data['id'],
            'name'          => $data['name'],
            'address'       => $data['address'],
            'city'          => $data['city'],
            'state'         => $data['state'],
            'country'       => $data['country'],
            'zip_code'      => $data['zip_code'],
            'phone'         => $data['phone'],
            'email'         => strtolower($data['email']),
            'responsible'   => $data['responsible'],

        );
        $updateClient = $this->clientRepository->update($client);


    }


    public function delete(array $data)
    {
        $project = $this->clientRepository->delete($data['id']);

    }

}
