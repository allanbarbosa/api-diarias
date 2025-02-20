<?php
declare(strict_types=1);

namespace Diarias\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PaisRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
          'nome' => ['required']
        ];
    }

    public function messages()
    {
        return [
          'nome.required' => 'Campo país é obrigatório'
        ];
    }

    protected function faileValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['mensagem' => $validator->errors()->first()], 422)
        );
    }
}