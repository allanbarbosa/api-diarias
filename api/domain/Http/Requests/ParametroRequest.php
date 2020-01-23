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
            'maxDiariasMes' => ['required'],
            'maxDiariasAno' => ['required'],
            'maxDiariasConsecutivas' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'maxDiariasMes.required' => 'Campo diarias mês é obrigatório',
            'maxDiariasAno.required' => 'Campo diarias ano é obrigatório',
            'maxDiariasConsecutivas.required' => 'Campo diarias consecutivas é obrigatório'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['mensagem' => $validator->errors()->first()], 422)
        );
    }
}