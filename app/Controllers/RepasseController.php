<?php

namespace App\Controllers;

use App\Models\Repasse;

class RepasseController
{
    /**
     * Atualizando situção da mensalidade
     *
     * @param $container
     * @param $request
     */
    public function updateStatus($container, $request)
    {
        $id = $request->request->get('id');
        $status = $request->request->get('status');
        $status  = ($status === 'on') ? 'realizado' : 'aguardando';

        $record = Repasse::find($id);
        $result = $record->update(['status' => $status]);

        if (!$result) {
            $json = [
                'error' => true,
                'msg' => 'Ocorreu um erro interno ao tentar atualizar situação do repasse'
            ];
            echo json_encode($json);
            die();
        }

        $json = [
            'error' => false,
            'msg' => "Repasse nº {$record['numero_parcela']} ({$record['data_vencimento']}) atualizada para: " . strtoupper($status)
        ];

        echo json_encode($json);
        die();
    }
}