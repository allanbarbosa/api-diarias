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
            'unid_nome' => ['required'],
            'unid_sigla' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'unid_nome.requerid' => 'Campo descrição é obrigatório.',
            'unid_sigla.required' => 'Campo sigla é obrigatório.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException
        (
            response()->json(['mensagem' => $validator->errors()->firts()], 422)
        );
    }
}