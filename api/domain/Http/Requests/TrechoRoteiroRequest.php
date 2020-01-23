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
            'dataHoraSaida' => ['required'],
            'dataHoraRetorno' => ['required'],
            'valorUnitario' => ['required'],
            'qtdDiarias' => ['required'],
            'idTipoTransporte' => ['required'],
            'idViagem' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'dataHoraSaida.required' => 'Campo data hora saída é obrigatório',
            'dataHoraRetorno.required' => 'Campo data hora retorno é obrigatório',
            'valorUnitario.required' => 'Campo valor unitário é obrigatório',
            'qtdDiarias.required' => 'Campo quantidade de diarias é obrigatório',
            'idTipoTransporte.required' => 'Campo tipo de transporte é obrigatório',
            'idViagem.required' => 'Campo viagem é obrigatório',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['mensagem' => $validator->errors()->first()], 422)
        );
    }
}