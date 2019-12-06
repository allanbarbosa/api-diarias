<?php
declare(strict_types=1);

namespace Diarias\Https\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PapelFluxogramaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return[
            'descricao' => ['required'],  
        ];
    }

    public function messages()
    {
        return [
            'descricao.required' => 'Campo Descrição é obrigatório ',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
           response()->json(['mensagem' => $validator->errors()->first()], 422) 
        );
    }
}