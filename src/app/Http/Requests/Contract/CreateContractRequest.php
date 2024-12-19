<?php

namespace App\Http\Requests\Contract;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateContractRequest extends FormRequest {

    // Deverá retornar um bool, que validará se o request pode ou não ser utilizado
    public function authorize()
    {
        return true;
    }

    // Regra de validação dos campos
    public function rules()
    {
        return [
            'supplyer_id'           => 'required',
            'project_id'            => 'required',
            'contract_number'       => 'required_if:type,1',
            'order_number'          => 'required_if:type,2',
            'contract_start_date'   => 'required',
            'contract_end_date'     => 'required',

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
