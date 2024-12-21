<?php

namespace App\Http\Requests\Project;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateProjectRequest extends FormRequest {

    // Deverá retornar um bool, que validará se o request pode ou não ser utilizado
    public function authorize()
    {
        return true;
    }

    // Regra de validação dos campos
    public function rules()
    {
        return [

            'code'              => 'required|min:3|max:20|unique:projects,code',
            'name'              => 'required|string|min:3|max:120|unique:projects,name',
            'contract_number'   => 'required',
            'client_id'         => 'required',
            'project_manager'   => 'required',
            'trade_id'          => 'required',
            'signature_date'    => 'required',
            'start_date'        => 'required',
            'finish_date'       => 'required',
            'contract_value'    => 'required',

            'street'           => 'required',
            'city'              => 'required',
            'state'             => 'required',
            'country'           => 'required',
            'zip_code'          => 'required',
        ];
    }

    // Função responsável por retornar um json em caso de erro na request
    protected function failedValidation(Validator $validator)
    {

        // dd($validator->errors());

        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 400));



    }


}
