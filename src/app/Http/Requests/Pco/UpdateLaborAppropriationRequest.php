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
        $service_item_labor   = $this->service_item_labor;
        $employee_role_id = $this->employee_role_id;

        return [

            'employee_role_id' => [
                'required',
                Rule::unique('labor_appropriations')
                ->where(function ($query)
                use ($service_item_labor, $employee_role_id)
                {
                    return $query->where('service_item_id', $service_item_labor)
                                ->where('employee_role_id', $employee_role_id)
                                ->where('service_item_id', '<>', $service_item_labor)
                                ;
                })
            ],
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
