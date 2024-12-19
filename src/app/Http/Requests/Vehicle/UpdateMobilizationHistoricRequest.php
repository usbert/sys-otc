<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMobilizationHistoricRequest extends FormRequest {

    // Deverá retornar um bool, que validará se o request pode ou não ser utilizado
    public function authorize()
    {
        return true;
    }

    // Regra de validação dos campos
    public function rules()
    {
        return [
            // 'prefix'          => 'required_widthout:vin_number|string',
            // 'vin_number'      => 'required_widthout:prefix|string',
            'demobilization_date'   => 'required',
            'km_return'             => 'required_if:has_km,1',
            'hour_control_return'   => 'required_if:has_h,1',

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
