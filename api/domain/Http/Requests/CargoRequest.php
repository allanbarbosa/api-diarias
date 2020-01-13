<?php
declare(strict_types=1);

namespace Diarias\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CargoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => ['required'],
            'idGratificacao' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório',
            'idGratificacao.required' => 'O campo idGratificação é obrigatório'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['mensagem' => $validator->errors()->first()], 422)
        );
    }
}