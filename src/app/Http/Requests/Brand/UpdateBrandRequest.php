<?php

namespace App\Http\Requests\Brand;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest {

    // Deverá retornar um bool, que validará se o request pode ou não ser utilizado
    public function authorize()
    {
        return true;
    }

    // Regra de validação dos campos
    public function rules()
    {
        return [
            'name'          => 'required|string|min:3|max:80|unique:brands,name,'.$this->id,
        ];
    }

    // Função responsável por retornar um DTO com os dados já validado
    // public function toDTO()
    // {
    //     return new BrandDTO($this->validated());
    // }


    // Função responsável por retornar um json em caso de erro na request
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 400));
    }


}
