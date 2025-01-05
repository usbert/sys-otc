<?php

namespace App\Repositories;

use App\Models\Client;
use App\Models\Contact;
use App\Models\EmployeeRole;
use App\Models\Pco;
use App\Repositories\Interfaces\ContactRepositoryInterface;

class ContactRepository implements ContactRepositoryInterface
{
  public function getAll()
  {
    $contacts = Contact::select(
        'contacts.id',
        'contacts.name',
        'employee_roles.name as function_name',
        'clients.name as client_name',
        'contacts.email',
        'contacts.phone'
    )
    ->where('contacts.is_activated', Contact::ACTIVATED)
    ->leftJoin('clients', 'clients.id', '=', 'contacts.client_id')
    ->leftJoin('employee_roles', 'employee_roles.id', '=', 'contacts.employee_role_id')
    ->get();

    return $contacts;


  }

  public function getDataToCreate()
  {
      $clientCombo   = Client::select('id','name')->where('is_activated', Client::ACTIVATED)->orderBy('name', 'asc')->get();
      $employeeRoleCombo = EmployeeRole::select('id','name')->where('is_activated', Client::ACTIVATED)->orderBy('name', 'asc')->get();

      $return = array(
          'clientCombo'  => $clientCombo,
          'employeeRoleCombo'  => $employeeRoleCombo,
      );

      return $return;

  }



    public function store($data)
    {
      return Contact::create($data)->id;
    }


    public function edit($id)
    {

        $contact = Contact::where('id', $id)->get();

        $clientCombo   = Client::select('id','name')->where('is_activated', Client::ACTIVATED)->orderBy('name', 'asc')->get();
        $employeeRoleCombo = EmployeeRole::select('id','name')->where('is_activated', Client::ACTIVATED)->orderBy('name', 'asc')->get();

        $result = array(
            'contact' => $contact,

            'clientCombo'       => $clientCombo,
            'employeeRoleCombo' => $employeeRoleCombo,
        );

        return $result;

    }


    public function update(array $data)
    {
        try {

            $input                      = Contact::find($data['id']);
            $input->name                = $data['name'];
            $input->client_id           = $data['client_id'];
            $input->employee_role_id    = $data['employee_role_id'];
            $input->phone               = $data['phone'];
            $input->email               = $data['email'];

            $input->save();

            return $input;

        } catch (\Exception $e) {
            // dd($e);
            return response()->json(["error" => $e->getMessage()]);
        }

    }

    public function delete($id)
    {
        $return = Pco::destroy($id);
        return $return;
    }


}
