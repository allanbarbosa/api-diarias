<?php
declare(strict_types=1);

namespace Diarias\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class ViagemRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'objetivo' => ['required'],
            'flag_adic_desl' => ['required'],
            'flag_urgente' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'objetivo.required' => 'Campo objetivo da viagem é obrigatório',
            'flag_adic_desl.required' => 'Campo adicional de deslocamento em viagem é obrigatório',
            'flag_urgente.required' => 'Campo viagem urgente é obrigatório',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['mensagem' => $validator->errors()->first()], 422)
        );
    }
}