<?php
declare(strict_types=1);

namespace Diarias\Http\Requests;

use Illuminate\Contracts\Validation;
use Illuminate\Fundation\Http\FormRequest;
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
            'prof_nome' => ['required'],
        ];
    }

    public function menssages()
    {
        return [
            'prof_nome.required' => 'Campo Nome é requerido',
        ];
    }

    protected function FailedValidation(Validation $validation)
    {
        throw new HttpResponseException
        (
            response()->json(['mensagem' => $validation->errors()->first()], 422)
        );
        
    }
}