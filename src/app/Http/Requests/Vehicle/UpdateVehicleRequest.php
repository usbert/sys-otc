<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest {

    // Deverá retornar um bool, que validará se o request pode ou não ser utilizado
    public function authorize()
    {
        return true;
    }

    // Regra de validação dos campos
    public function rules()
    {

        return [

            'model_id'          => 'required|integer',
            'tank_capacity'     => 'required',
            'tag'               => 'required|string|min:8|max:20|unique:vehicles,tag',
            'renavam'           => 'required|integer|unique:vehicles,renavam',
            'vin_number'        => 'required|string|min:3|max:50|unique:vehicles,vin_number,'.$this->id,
            'manufacture_year'  => 'required',
            'model_year'        => 'required',

            'supplyer_id'       => 'required',
            'fuel_id'           => 'required',
            'unit_measure'      => 'required',
            'project_id'        => 'required',
            'client_id'         => 'required',
            'driver_id'         => 'required',
            // 'waiting_driver',
            'activity_id'       => 'required',
            'mobilization_date' => 'required',
            'unit_measure'      => 'required',
            // 'has_km',
            // 'has_hr',
            // 'km_control',
            // 'hour_control',

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
