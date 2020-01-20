<?php
declare(strict_types=1);

namespace Diarias\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProfissaoResquest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'profissao' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'profissao.required' => 'Campo Nome é requerido',
        ];
    }

    protected function FailedValidation(Validator $validator)
    {
        throw new HttpResponseException
        (
            response()->json(['mensagem' => $validator->errors()->first()], 422)
        );
        
    }
}