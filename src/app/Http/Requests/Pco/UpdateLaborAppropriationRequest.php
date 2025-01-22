<?php

namespace App\Http\Requests\Pco;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLaborAppropriationRequest extends FormRequest {

    // Deverá retornar um bool, que validará se o request pode ou não ser utilizado
    public function authorize()
    {
        return true;
    }

    // Regra de validação dos campos
    public function rules()
    {
        $service_item_id   = $this->service_item_id;
        $employee_role_id = $this->employee_role_id;
        return [

            'level_01' => [
                'required',
                Rule::unique('service_items')
                ->where(function ($query)
                use ($service_item_id, $employee_role_id)
                {
                    return $query->where('service_item_id', $service_item_id)
                                ->where('employee_role_id', $employee_role_id)
                                ->where('service_item_id', '<>', $service_item_id)
                                ;
                })
            ],
            'employee_role_id'  => 'required',
            'hours'             => 'required',
            'rate'              => 'required',
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
