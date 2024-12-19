<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTransferHistoricRequest extends FormRequest {

    // Deverá retornar um bool, que validará se o request pode ou não ser utilizado
    public function authorize()
    {
        return true;
    }

    // Regra de validação dos campos
    public function rules()
    {
        return [
            'has_implement'     => 'required',
            'mobilization_date' => 'required',
            'implement_value'   => 'required_if:has_implement,1',
            'km_control'        => 'required_if:unit_measure,Km|required_if:has_km,on',
            'hour_control'      => 'required_if:unit_measure,H|required_if:has_h,on',
            'project_id'        => 'required',
            'client_id'         => 'required',
            'activity_id'       => 'required',
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
