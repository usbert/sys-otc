<?php

namespace App\Http\Requests\EquipmentFamily;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\DTO\EquipmentFamilyDTO;

class CreateEquipmentFamilyRequest extends FormRequest {

    // Deverá retornar um bool, que validará se o request pode ou não ser utilizado
    public function authorize()
    {
        return true;
    }

    // Regra de validação dos campos
    public function rules()
    {
        return [
            'name'                  => 'required|string|min:3|max:50|unique:equipment_families,name',
            'equipment_group_id'    => 'required|string',
            'type'                  => 'required|integer',
            'conversion_factor'     => ['required'],
            'maximum_hour'          => ['required'],
            'weight_units'          => 'required',
            'capacity_units'        => 'required',
            'power_supply'          => 'required',

        ];
    }

    // Função responsável por retornar um DTO com os dados já validado
    public function toDTO()
    {
        return new EquipmentFamilyDTO($this->validated());
    }


    // Função responsável por retornar um json em caso de erro na request
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 400));
    }


}
