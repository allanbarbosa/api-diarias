<?php
declare(strict_types=1);

namespace Diarias\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class GrupoInternacionalPaisRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'idPais' => ['required'],
            'idGrupoInternacional' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'idPais.required' => 'Campo id país é obrigatório',
            'idGrupoInternacional.required' => 'Campo id grupo internacional é obrigatório',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['mensagem' => $validator->errors()->first()], 422)
        );
    }
}