<?php

namespace App\Http\Requests\EquipmentPrefix;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEquipmentPrefixRequest extends FormRequest {

    // Deverá retornar um bool, que validará se o request pode ou não ser utilizado
    public function authorize()
    {
        return true;
    }

    // Regra de validação dos campos
    public function rules()
    {
        return [
            'prefix' => 'required|string|min:3|max:3|unique:equipment_prefixes,prefix,'.$this->id,
            'name' => 'required|string|min:3|max:80|unique:equipment_prefixes,name,'.$this->id,
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
