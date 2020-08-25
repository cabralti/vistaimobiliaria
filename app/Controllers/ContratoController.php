<?php

namespace App\Controllers;

use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Proprietario;
use Source\Exceptions\HttpException;

class ContratoController
{

    /**
     * @param $container
     * @param $request
     * @return mixed
     */
    public function index($container)
    {
        $records = Contrato::all();

        return $container['view']->render('contratos/index.php', [
            'title' => 'Contratos',
            'records' => $records
        ]);
    }

    /**
     * @param $container
     * @return mixed
     */
    public function create($container)
    {
        $owners = Proprietario::all();
        $clients = Cliente::all();

        return $container['view']->render('contratos/create.php', [
            'title' => 'Criar Contrato',
            'owners' => $owners,
            'clients' => $clients,
        ]);
    }

    /**
     * @param $container
     * @param $request
     * @return mixed
     */
    public function store($container, $request)
    {
        $entity = new Contrato();
        $data = $request->request->all();

        try {
            $record = $entity->create($data);

            if (!$record) {
                throw new \Exception('Ocorreu um erro interno na aplicação');
            }

            $json = [
                'error' => false,
                'title' => 'Tudo certo',
                'msg' => 'Registro criado com sucesso!',
                'type' => 'success',
                'redirect' => url('contratos'),
                'data' => $record
            ];
            echo json_encode($json);

        } catch (\Exception $e) {
            $json = [
                'error' => true,
                'title' => 'Erro',
                'msg' => $e->getMessage(),
                'type' => 'error'
            ];
            echo json_encode($json);
        }

        return;
    }

    /**
     * @param $container
     * @return mixed
     */
    public function edit($container, $request)
    {
        $id = $request->attributes->get(1);
        $owners = Proprietario::all();
        $clients = Cliente::all();

        $record = Contrato::with(['proprietario', 'cliente'])->where('id', $id)->first();

        if (!$record) {
            throw new HttpException('Registro não encontrado', 404);
        }

        return $container['view']->render('contratos/edit.php', [
            'title' => 'Editar Contrato',
            'record' => $record,
            'owners' => $owners,
            'clients' => $clients
        ]);
    }

    /**
     * @param $container
     * @param $request
     */
    public function update($container, $request)
    {
        $id = $request->attributes->get(1);
        $record = Contrato::find($id);

        try {

            if (!$record) {
                throw new HttpException('Registro não encontrado', 404);
            }

            $data = $request->request->all();
            $record->update($data);

            $json = [
                'error' => false,
                'title' => 'Tudo certo',
                'msg' => 'Registro atualizado com sucesso!',
                'type' => 'success',
                'redirect' => url('contratos'),
                'data' => $record
            ];

            echo json_encode($json);

        } catch (\Exception $e) {
            $json = [
                'error' => true,
                'title' => 'Erro',
                'msg' => $e->getMessage(),
                'type' => 'error'
            ];
            echo json_encode($json);
        }

        return;
    }

    /**
     * @param $container
     * @param $request
     */
    public function destroy($container, $request)
    {
        $id = $request->attributes->get(1);
        $record = Contrato::find($id);

        try {

            if (!$record) {
                throw new HttpException('Registro não encontrado', 404);
            }

            $record->delete();

            $json = [
                'error' => false,
                'title' => 'Tudo certo',
                'msg' => 'Registro excluído com sucesso!',
                'type' => 'success',
                'redirect' => url('contratos'),
            ];

            echo json_encode($json);

        } catch (\Exception $e) {
            $json = [
                'error' => true,
                'title' => 'Erro',
                'msg' => $e->getMessage(),
                'type' => 'error'
            ];
            echo json_encode($json);
        }

        return;
    }

    /**
     * @param $container
     * @return mixed
     */
    public function show($container, $request)
    {
        $id = $request->attributes->get(1);
        $owners = Proprietario::all();
        $clients = Cliente::all();

        $record = Contrato::with(['proprietario', 'cliente'])->where('id', $id)->first();

        if (!$record) {
            throw new HttpException('Registro não encontrado', 404);
        }

        return $container['view']->render('contratos/show.php', [
            'title' => 'Visualizar Contrato',
            'record' => $record,
            'owners' => $owners,
            'clients' => $clients
        ]);
    }

    /**
     * Retorna os dados de um proprietário
     *
     * @param $container
     * @param $request ]
     */
    public function getDataOwner($container, $request)
    {
        $id = $request->request->get('record');
        $owner = Proprietario::find($id);

        if (!$owner) {
            $properties = null;
        } else {
            $getProperties = $owner->imoveis()->get();

            foreach ($getProperties as $property) {
                $properties[] = [
                    'id' => $property->id,
                    'description' => "Código: {$property->id}, {$property->logradouro} Nº {$property->numero}, {$property->bairro}, {$property->cidade}/{$property->uf} "
                ];
            }
        }

        $json = [
            'properties' => $properties
        ];

        echo json_encode($json);
        die();
    }
}