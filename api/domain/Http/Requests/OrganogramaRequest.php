<?php

declare(strict_types=1);

namespace Diarias\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrganogramaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'codigo' => ['required'],
            'dataInicio' => ['required'],
            'dataFim' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'codigo.request' => 'Campo código é obrigatório',
            'dataInicio.request' => 'Campo data início é obrigatório',
            'dataFinal.request' => 'Campo data fim é obrigatório',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->join(['mensagem' => $validator->errors()->first()], 422)
        );
    }
}