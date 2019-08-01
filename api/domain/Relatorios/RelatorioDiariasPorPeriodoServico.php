<?php
declare(strict_types=1);

namespace Diarias\Relatorios;

use Diarias\Viagem\Models\ViagemModel;
use Maatwebsite\Excel\Concerns\FromArray;

class RelatorioDiariasPorPeriodoServico implements FromArray
{
    protected $model;

    public function __construct()
    {
        $this->model = new ViagemModel();
    }

    protected function gerarRelatorio()
    {
        $dataInicial = implode('-', array_reverse(explode('/', '01/05/2019')));
        $dataFinal = implode('-', array_reverse(explode('/', '31/07/2019')));

        $viagens = $this->model->whereBetween('data_requisicao', [$dataInicial, $dataFinal])
            ->with(
                'roteiro',
                'beneficiario',
                'beneficiario.unidade',
                'roteiro.destino',
                'roteiro.destino.estado'
            )
            ->orderBy('data_requisicao', 'DESC')
            ->get();

        $dadosViagem = [];

        foreach ($viagens as $viagem) {
            $achouPai = false;
            $unidade = $viagem->beneficiario->unidade;

            if (is_null($unidade)) {
                continue;
            }

            while(!$achouPai) {
                if ($unidade->nivel_id_nivel == 1) {
                    $achouPai = true;
                    break;
                }

                $unidade = $unidade->unidadePai;
            }

            foreach ($viagem->roteiro as $roteiro) {

                $dadosViagem[] = [
                    'Nome' => $viagem->beneficiario->nome_beneficiario,
                    'Municipio' => $roteiro->destino->estado->nome_estado . '/' . $roteiro->destino->nome_municipio,
                    'Data Saída' => date('d/m/Y', strtotime($roteiro->data_saida)),
                    'Data Retorno' => date('d/m/Y', strtotime($roteiro->data_retorno)),
                    'Diretoria' => $unidade->sigla,
                ];
            }
        }

        return $dadosViagem;
    }

    public function array(): array
    {
        return $this->gerarRelatorio();
    }
}
