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
            'dataTramitacao' => ['required'],
            'idMovimentacao' => ['required'],
            'idViagem' => ['required'],
            'idLotacao' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'dataTramitacao.required' => 'Campo data tramitação é obrigatório',
            'idMovimentacao.required' => 'Campo movimentação é obrigatório',
            'idViagem.required' => 'Campo viagem é obrigatório',
            'idLotacao.required' => 'Campo lotação é obrigatório',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['mensagem' => $validator->errors()->first()], 422)
        );
    }
}