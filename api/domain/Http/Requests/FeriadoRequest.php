<?php
declare(strict_types=1);

namespace Diarias\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FeriadoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'feriado_dia' => ['required'],
            'feriado_mes' => ['required'],
            'feriado_nome' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'feriado_dia.required' => 'Campo dia do feriado é obrigatório',
            'feriado_mes.required' => 'Campo mês do feriado é obrigatório',
            'feriado_nome.required' => 'Campo nome do feriado é obrigatório',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['mensagem' => $validator->errors()->first()], 422)
        );
    }
}