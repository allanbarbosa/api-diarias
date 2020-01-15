<?php
declare(strict_types=1);

namespace Diarias\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TrechoRoteiroRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'data_hora_saida' => ['required'],
            'data_hora_retorno' => ['required'],
            'valor_unitario' => ['required'],
            'qtd_diarias' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'data_hora_saida.required' => 'Campo data hora saída é obrigatório',
            'data_hora_retorno.required' => 'Campo data hora retorno é obrigatório',
            'valor_unitario.required' => 'Campo valor unitário é obrigatório',
            'qtd_diarias.required' => 'Campo quantidade de diarias é obrigatório',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['mensagem' => $validator->errors()->first()], 422)
        );
    }
}