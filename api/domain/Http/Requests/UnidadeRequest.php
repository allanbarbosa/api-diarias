<?php
declare(strict_types=1);

namespace Diarias\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UnidadeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => ['required'],
            'sigla' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'nome.requerid' => 'Campo descrição é obrigatório.',
            'sigla.required' => 'Campo sigla é obrigatório.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException
        (
            response()->json(['mensagem' => $validator->errors()->first()], 422)
        );
    }
}