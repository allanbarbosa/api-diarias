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
      'dataInicio' => ['required'],
      'idCargo' => ['required'],
      'idUnidadeOrganograma' => ['required'],
      'idVinculoEmpregaticio' => ['required']
    ];
  }

  public function messages()
  {
    return [
      'dataInicio.required' => 'O campo data início é obrigatório',
      'idCargo.required' => 'O campo cargo é obrigatório',
      'idUnidadeOrganograma.required' => 'O campo unidade organograma é obrigatório',
      'idVinculoEmpregaticio.required' => 'O campo vínculo empregatício é obrigatório'
    ];
  }

  protected function failedValidation(Validator $validator)
  {
    throw new HttpResponseException(
      response()->json(['mensagem' => $validator->errors()->first()], 422)
    );
  }
}