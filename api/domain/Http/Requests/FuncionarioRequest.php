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
            'cpf' => ['required'],
            'nome' => ['required'],
            'telefone' => ['required'],
            'empresa' => ['required'],
            'profissao' => ['required'],
            'escolaridade' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'cpf.required' => 'O campo CPF é obrigatório',
            'nome.required' => 'O campo nome é obrigatório',
            'telefone.required' => 'O campo telefone é obrigatório',
            'empresa.required' => 'O campo empresa é obrigatório',
            'profissao.required' => 'O campo profissao é obrigatório',
            'escolaridade.required' => 'O campo escolaridade é obrigatório',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['mensagem' => $validator->errors()->first()], 422)
        );
    }
}