<?php

namespace App\Http\Requests\Pco;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateLaborAppropriationRequest extends FormRequest {

    // Deverá retornar um bool, que validará se o request pode ou não ser utilizado
    public function authorize()
    {
        return true;
    }

// 'level_01' => [
//                 'required',
//                 Rule::unique('service_items')->where(function ($query)
//                 use ($level_01, $level_02)
//                 {
//                     return $query->where('level_01', $level_01)
//                                 ->where('level_02', $level_02);
//                 }),
//             ],


    // Regra de validação dos campos
    public function rules()
    {
        return [
            'modal_service_item_id'   => 'required',
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
