<?php
declare(strict_types=1);

namespace Diarias\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FuncionarioRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'func_cpf' => ['required'],
            'func_nome' => ['required'],
            'func_telefone' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'func_cpf.required' => 'O campo CPF é obrigatório',
            'func_nome.required' => 'O campo nome é obrigatório',
            'func_telefone.required' => 'O campo telefone é obrigatório',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['mensagem' => $validator->errors()->first()], 422)
        );
    }
}