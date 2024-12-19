<?php

namespace App\Services;

use App\Repositories\Interfaces\ContactRepositoryInterface;
use App\DTO\ContactDTO;

class ContactService
{

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function getAll()
    {
        return $this->contactRepository->getAll();
    }

    public function getDataToCreate()
    {
        return $this->contactRepository->getDataToCreate();
    }


    public function store(array $data)
    {

        if(empty($data['client_id'])) {
            $client_id = null;
        } else {
            $client_id = $data['client_id'];
        }
        if(empty($data['employee_role_id'])) {
            $employee_role_id = null;
        } else {
            $employee_role_id = $data['employee_role_id'];
        }


        $contact = array(
            'name'              => $data['name'],
            'client_id'         => $client_id,
            'employee_role_id'  => $employee_role_id,
            'phone'             => $data['phone'],
            'email'             => $data['email'],
        );

        $this->contactRepository->store($contact);

    }



    public function edit($id) {
        return $this->contactRepository->edit($id);
    }

    public function update(array $data)
    {
        if(empty($data['client_id'])) {
            $client_id = null;
        } else {
            $client_id = $data['client_id'];
        }
        if(empty($data['employee_role_id'])) {
            $employee_role_id = null;
        } else {
            $employee_role_id = $data['employee_role_id'];
        }

        $contacts = array(
            'id'                => $data['id'],
            'name'              => $data['name'],
            'client_id'         => $client_id,
            'employee_role_id'  => $employee_role_id,
            'phone'             => $data['phone'],
            'email'             => strtolower($data['email']),
        );

        $updateContact = $this->contactRepository->update($contacts);

    }


    public function delete(array $data)
    {
        $project = $this->contactRepository->delete($data['id']);

    }



}
