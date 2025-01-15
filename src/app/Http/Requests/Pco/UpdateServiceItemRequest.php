<?php

namespace App\Http\Requests\Pco;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateServiceItemRequest extends FormRequest {

    // Deverá retornar um bool, que validará se o request pode ou não ser utilizado
    public function authorize()
    {
        return true;
    }

    // Regra de validação dos campos
    public function rules()
    {


        $service_item_id = $this->service_item_id;

        $level_01 = $this->input('level_01');
        $level_02 = $this->input('level_02');

        return [

            'level_01' => [
                'required',
                Rule::unique('service_items')
                ->where(function ($query)
                use ($service_item_id, $level_01, $level_02)
                {
                    return $query->where('level_01', $level_01)
                                ->where('level_02', $level_02)
                                ->where('id', '<>', $service_item_id)
                                ;
                })
            ],
            'item_description'  => 'required',



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
