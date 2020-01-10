<?php
declare(strict_types=1);

namespace Diarias\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class HistoricoMovimentacaoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'data_tramitacao' => ['required'],
            'mov_observacao' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'data_tramitacao.required' => 'Campo data tramitação é obrigatório',
            'mov_observacao.required' => 'Campo observação é obrigatório',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['mensagem' => $validator->errors()->first()], 422)
        );
    }
}