<?php
declare(strict_types=1);

namespace Diarias\Http\Requests;

use Illumina\Contracts\Validation\Validator;
use Illuminate\Fundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmpresaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome_empresa' => ['required'],
            'sigla' => ['requrid'],
        ];
    }

    public function messages()
    {
        return [
            'nome_empresa.required' => 'Campo Nome da Empresa é obrigatório',
            'sigla.required' => 'Campo Sigla é obrigatório',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException
        (
            response()->json(['mensagem' => $validator->errors()->first(), 422])
        );
    }
}