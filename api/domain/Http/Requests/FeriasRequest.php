<?php
declare(strict_types=1);

namespace Diarias\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FeriasRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'dataInicio' => ['required'],
            'dataFim' => ['required'],
            'idFuncionario' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'dataInicio.required' => 'Campo data inicio é obrigatório',
            'dataFim.required' => 'Campo data fim é obrigatório',
            'idFuncionario.required' => 'Campo id funcionário é obrigatório',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['mensagem' => $validator->errors()->first()], 422)
        );
    }
}