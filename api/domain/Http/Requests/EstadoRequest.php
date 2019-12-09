<?php
declare(strict_types=1);

namespace Diarias\Htpp\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EstadoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'sigla' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'sigla.required' => 'Campo Descrição é obrigatório',
        ];
    }

    protected function faileValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['mensagem' => $validator->errors()->first()], 422)
        );
    }
}