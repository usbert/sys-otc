<?php

namespace App\Http\Requests\Rfi;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateFileRequest extends FormRequest {

    // Deverá retornar um bool, que validará se o request pode ou não ser utilizado
    public function authorize()
    {
        return true;
    }

    // Regra de validação dos campos
    public function rules()
    {
        return [
            'file_comment'  => 'required',
            'image'         => 'required', // |mimes:pdf
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
