<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Repositories\Interfaces\BrandRepositoryInterface;
// use Illuminate\Support\Facades\Auth;

class BrandRepository implements BrandRepositoryInterface
{
  public function getAll()
  {
    $brands = Brand::Select(
        'id',
        'name'
    )->where('is_activated', 1)
    ->get();

    return $brands;

  }

  public function store($data)
  {
    return Brand::create($data)->id;
  }

  public function edit($id)
  {

    $brand = Brand::where('id', $id)->get();
    $result = array(
        'brand' => $brand,
    );

    return $result;

  }


  public function update(array $data)
    {
        try {
            $input              = Brand::find($data['id']);
            $input->name        = $data['name'];
            $input->save();

            return $input;

        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()]);
        }

    }

    public function delete($id)
    {
        $return = Brand::destroy($id);
        return $return;
    }



}
