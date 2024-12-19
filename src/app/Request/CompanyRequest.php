<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\DTO\CompanyDTO;

class CompanyRequest extends FormRequest {

    // Deverá retornar um bool, que validará se o request pode ou não ser utilizado
    public function authorize()
    {
        return true;
    }

    // Regra de validação dos campos
    public function rules()
    {
        return [
            'name'              => ['required', 'min:3', 'max: 50', 'unique'],
            'email'             => ['required', 'min:3', 'max: 120', 'unique'],
            'segment'           => 'required|integer',
            'fantasy_name'      => ['required', 'min:3', 'max: 80', 'unique'],
            'document_number'   => ['required', 'min:3', 'max: 18', 'unique'],
            'logo'              =>'required|string',
        ];
    }

    // Função responsável por retornar um DTO com os dados já validado
    public function toDTO()
    {
        return new CompanyDTO($this->validated());
    }


    // Função responsável por retornar um json em caso de erro na request
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 142));
    }


}
