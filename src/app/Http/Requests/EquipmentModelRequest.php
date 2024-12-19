<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\DTO\EquipmentModelDTO;

class EquipmentModelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'equipment_prefix_id'   => 'required|integer',
            'equipment_brand_id'    => 'required|integer',
            'equipment_family_id'   => 'required|integer',
            'prefix'                => 'required|string',
            'name'                  => 'required|min:3|max:100',
            'weight_measurment'     => 'required',
            'unit1'                 => 'required',
            'capacity_measurment'   => 'required',
            'unit2'                 => 'required',
            'power_measurment'      => 'required',
            'unit3'                 => 'required',
            'tank_capacity'         => 'required',
        ];
    }

    // Função responsável por retornar um DTO com os dados já validados
    public function toDTO() {
        return new EquipmentModelDTO($this->validated());
    }

    // Função responsável por retornar um json em caso de erro na request
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 422));
    }

}
