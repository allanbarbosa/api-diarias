<?php
declare(strict_types=1);

namespace Diarias\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ComprovacaoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'diarias_utilizadas' => ['required'],
            'data_hora_saida_efetiva' => ['required'],
            'data_hora_chegada_efetiva' => ['required'],
            'atividades_desenvolvidas' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'diarias_utilizadas.required' => 'Campo diarias utilizadas é obrigatório',
            'data_hora_saida_efetiva.required' => 'Campo data e hora de saida efetiva é obrigatório',
            'data_hora_chegada_efetiva.required' => 'Campo data e hora de chegada efetiva é obrigatório',
            'atividades_desenvolvidas.required' => 'Campo atividades desenvolvidas é obrigatório',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['mensagem' => $validator->errors()->first()], 422)
        );
    }
}