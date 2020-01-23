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
            'feriadoDia' => ['required'],
            'feriadoMes' => ['required'],
            'feriadoNome' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'feriadoDia.required' => 'Campo dia do feriado é obrigatório',
            'feriadoMes.required' => 'Campo mês do feriado é obrigatório',
            'feriadoNome.required' => 'Campo nome do feriado é obrigatório',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['mensagem' => $validator->errors()->first()], 422)
        );
    }
}