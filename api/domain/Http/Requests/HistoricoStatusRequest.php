<?php
declare(strict_types=1);

namespace Diarias\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class HistoricoStatusRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'data_tramitacao' => ['required'],
            'viagem' => ['required'],
            'status' => ['required'],
            'lotacao' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'data_tramitacao.required' => 'Campo data da tramitação é obrigatório',
            'viagem.required' => 'Campo viagem é obrigatório',
            'status.required' => 'Campo status é obrigatório',
            'lotacao.required' => 'Campo lotação é obrigatório',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['mensagem' => $validator->errors()->first()], 422)
        );
    }
}