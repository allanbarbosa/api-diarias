<?php
declare(strict_types=1);

namespace Diarias\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LotacaoRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'dataInicio' => ['required']
    ];
  }

  public function messages()
  {
    return [
      'dataInicio.required' => 'O campo data início é obrigatório'
    ];
  }

  protected function failedValidation(Validator $validator)
  {
    throw new HttpResponseException(
      response()->json(['mensagem' => $validator->errors()->first()], 422)
    );
  }
}