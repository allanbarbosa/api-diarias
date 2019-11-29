<?php
declare(strict_types=1);

namespace Diarias\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ParametroRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'max_diarias_mes' => ['required'],
            'max_diarias_ano' => ['required'],
            'max_diarias_consecutivas' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'max_diarias_mes.required' => 'Campo diarias mês é obrigatório',
            'max_diarias_ano.required' => 'Campo diarias ano é obrigatório',
            'max_diarias_consecutivas.required' => 'Campo diarias consecutivas é obrigatório',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['mensagem' => $validator->errors()->first()], 422)
        );
    }
}