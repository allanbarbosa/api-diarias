<?php
declare(strict_types=1);

namespace Diarias\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ComprovanteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'caminho' => ['required'],
            'nomeArquivo' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'caminho.required' => 'Campo caminho é obrigatório',
            'nomeArquivo.required' => 'Campo nome do arquivo é obrigatório',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException
        (
            response()->json(['mensagem' => $validator->errors()->first()], 422)
        );
    }
}