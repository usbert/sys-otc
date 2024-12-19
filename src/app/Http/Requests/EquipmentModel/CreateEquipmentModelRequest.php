<?php

namespace App\Http\Requests\EquipmentModel;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateEquipmentModelRequest extends FormRequest {

    // Deverá retornar um bool, que validará se o request pode ou não ser utilizado
    public function authorize()
    {
        return true;
    }

    // Regra de validação dos campos
    public function rules()
    {
        return [

            'equipment_prefix_id'   => 'required',
            'prefix'                => 'required',
            'equipment_brand_id'    => 'required',
            'equipment_family_id'   => 'required',
            // 'name'                  => 'required|string|min:3|max:80|unique:equipment_models,name',
            'name'                  => 'required|string|min:3|max:80',

            'weight_measurment'     => 'required',
            'unit1'                 => 'required',
            'capacity_measurment'   => 'required',
            'unit2'                 => 'required',
            'power_measurment'      => 'required',
            'unit3'                 => 'required',

            'tank_capacity'         => 'required',

        ];
    }

    // Função responsável por retornar um json em caso de erro na request
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 400));

    }


}
