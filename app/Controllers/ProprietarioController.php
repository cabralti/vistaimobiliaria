<?php

namespace App\Controllers;

use App\Models\Proprietario;
use Source\Exceptions\HttpException;

class ProprietarioController
{

    /**
     * @param $container
     * @param $request
     * @return mixed
     */
    public function index($container)
    {
        $records = Proprietario::all();

        return $container['view']->render('proprietarios/index.php', [
            'title' => 'Proprietários',
            'records' => $records
        ]);
    }

    /**
     * @param $container
     * @return mixed
     */
    public function create($container)
    {
        return $container['view']->render('proprietarios/create.php', [
            'title' => 'Criar Proprietário',
        ]);
    }

    /**
     * @param $container
     * @param $request
     * @return mixed
     */
    public function store($container, $request)
    {
        $entity = new Proprietario();
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
                'redirect' => url('proprietarios'),
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

        $record = Proprietario::find($id);
        if (!$record) {
            throw new HttpException('Registro não encontrado', 404);
        }

        return $container['view']->render('proprietarios/edit.php', [
            'title' => 'Editar Proprietário',
            'record' => $record
        ]);
    }

    /**
     * @param $container
     * @param $request
     */
    public function update($container, $request)
    {
        $id = $request->attributes->get(1);
        $record = Proprietario::find($id);

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
                'redirect' => url('proprietarios'),
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
        $record = Proprietario::find($id);

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
                'redirect' => url('proprietarios'),
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
}