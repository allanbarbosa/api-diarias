<?php
declare(strict_types=1);

namespace Diarias\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MunicipioRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => ['required'],
            'slug' => ['required'],
            'porcentagemDiaria' => ['required'],
            'codigoIbge' => ['required'],
            'idEstado' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório',
            'slug.required' => 'O campo slug é obrigatório',
            'porcentagemDiaria.required' => 'O campo porcentagemDiaria é obrigatório',
            'codigoIbge.required' => 'O campo código IBGE é obrigatório',
            'idEstado.required' => 'O campo estado é obrigatório'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['mensagem' => $validator->errors()->first()], 422)
        );
    }
}