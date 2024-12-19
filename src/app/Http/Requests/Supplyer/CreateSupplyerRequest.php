<?php

namespace App\Http\Requests\Supplyer;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateSupplyerRequest extends FormRequest {

    // Deverá retornar um bool, que validará se o request pode ou não ser utilizado
    public function authorize()
    {
        return true;
    }

    // Regra de validação dos campos
    public function rules()
    {
        return [
            'name'            => 'required|string|min:3|max:80|unique:supplyers,name',
            'fantasy_name'    => 'required|string|min:3|max:80',
            'document_number' => 'required|string|min:1|max:18|unique:supplyers,document_number',
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
