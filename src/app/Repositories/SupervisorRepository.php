<?php

namespace App\Repositories;

use App\Models\Supervisor;
use App\Repositories\Interfaces\SupervisorRepositoryInterface;

class SupervisorRepository implements SupervisorRepositoryInterface
{
  public function getAll()
  {
    $supervisors = Supervisor::select('id', 'name', 'is_activated')
    ->get();

    return $supervisors;


  }

    //   public function find($id)
    //   {
    //     return false;
    //   }

    //   public function create($data)
    //   {
    //     return false;
    //   }


    public function store($data)
    {
      return Supervisor::create($data)->id;
    }


    public function edit($id)
    {

        $supervisor = Supervisor::where('id', $id)->get();
        $result = array(
            'supervisor' => $supervisor,
        );

        return $result;

    }


    public function update(array $data)
    {

        try {

            $input              = Supervisor::find($data['id']);
            $input->name        = $data['name'];
            $input->save();

            return $input;

        } catch (\Exception $e) {
            // dd($e);
            return response()->json(["error" => $e->getMessage()]);
        }

    }

    public function delete($id)
    {
        $return = Supervisor::destroy($id);
        return $return;
    }


}
