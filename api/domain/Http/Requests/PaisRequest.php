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
          'codigo' => ['required'],
          'nome' => ['required'],
        ];
    }

    public function messages()
    {
        return [
          'codigo.required' => 'Campo codigo é obrigatório',
          'nome.required' => 'Campo nome é obrigatório',
        ];
    }

    protected function faileValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['mensagem' => $validator->errors()->first()], 422)
        );
    }
}