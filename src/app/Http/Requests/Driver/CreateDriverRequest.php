<?php

namespace App\Http\Requests\Driver;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateDriverRequest extends FormRequest {

    // Deverá retornar um bool, que validará se o request pode ou não ser utilizado
    public function authorize()
    {
        return true;
    }

    // Regra de validação dos campos
    public function rules()
    {
        return [
            'name'          => 'required|string|min:3|max:80|unique:drivers,name',
            'registration'  => 'required|string|min:3|max:10|unique:drivers,function',
            'function'      => 'required|string|min:3|max:80',
            'project_id'    => 'required',

        ];
    }

    // Função responsável por retornar um DTO com os dados já validado
    // public function toDTO()
    // {
    //     return new DriverDTO($this->validated());
    // }


    // Função responsável por retornar um json em caso de erro na request
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 400));
    }


}
