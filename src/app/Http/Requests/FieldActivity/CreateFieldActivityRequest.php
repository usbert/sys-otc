<?php

namespace App\Http\Requests\FieldActivity;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;


class CreateFieldActivityRequest extends FormRequest {

    // Deverá retornar um bool, que validará se o request pode ou não ser utilizado
    public function authorize()
    {
        return true;
    }

    // Regra de validação dos campos
    public function rules()
    {
        return [
            'code' => 'required|string|min:2|max:30|unique:field_activities,code',
            'name' => 'required|string|min:3|max:80|unique:field_activities,name',
        ];
    }

    // Função responsável por retornar um DTO com os dados já validado
    // public function toDTO()
    // {
    //     return new FieldActivityDTO($this->validated());
    // }


    // Função responsável por retornar um json em caso de erro na request
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 400));
    }


}
