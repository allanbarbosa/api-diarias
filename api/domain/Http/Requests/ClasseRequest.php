<?php
declare(string_types=1);

namespace Diarias\https\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\http\Exceptions\HttpResponseExceptions;
use Symfony\Component\HttpFoundation\Response;

class ClasseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return[
            'clas_nome' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Campo nome é obrigatório',
        ];
    }    

    protected function faileValidation(validator $validator)
    {
        throw new httpReponseExeception(
            response()->json(['mensagem' => $validator->erros()->first()], 422)
        );
    }
}
