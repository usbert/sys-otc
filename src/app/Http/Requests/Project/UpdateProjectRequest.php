<?php

namespace App\Http\Requests\Project;

use App\Models\Project;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest {

    // Deverá retornar um bool, que validará se o request pode ou não ser utilizado
    public function authorize()
    {
        return true;
    }

    // Regra de validação dos campos
    public function rules()
    {
        return [
            'short_name' => 'required|string|min:3|max:80|unique:projects,short_name,'.$this->id,
            'name'        => 'required|string|min:3|max:120|unique:projects,name,'.$this->id,
            'prefix_code' => 'required|string|min:1|max:5|unique:projects,prefix_code,'.$this->id,
            'cost_center' => 'required|string|min:3|max:15',

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
