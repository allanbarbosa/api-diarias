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
            'diariasUtilizadas' => ['required'],
            'dataHoraSaidaEfetiva' => ['required'],
            'dataHoraChegadaEfetiva' => ['required'],
            'atividadesDesenvolvidas' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'diariasUtilizadas.required' => 'Campo diarias utilizadas é obrigatório',
            'dataHoraSaidaEfetiva.required' => 'Campo data e hora de saida efetiva é obrigatório',
            'dataHoraChegadaEfetiva.required' => 'Campo data e hora de chegada efetiva é obrigatório',
            'atividadesDesenvolvidas.required' => 'Campo atividades desenvolvidas é obrigatório',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['mensagem' => $validator->errors()->first()], 422)
        );
    }
}