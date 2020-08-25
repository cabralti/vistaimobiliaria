<?php

namespace App\Controllers;

use App\Models\Imovel;
use App\Models\Proprietario;
use Source\Exceptions\HttpException;

class ImovelController
{

    /**
     * @param $container
     * @param $request
     * @return mixed
     */
    public function index($container)
    {
        $records = Imovel::all();

        return $container['view']->render('imoveis/index.php', [
            'title' => 'Imóveis',
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

        return $container['view']->render('imoveis/create.php', [
            'title' => 'Criar Imóvel',
            'owners' => $owners
        ]);
    }

    /**
     * @param $container
     * @param $request
     * @return mixed
     */
    public function store($container, $request)
    {
        $entity = new Imovel();
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
                'redirect' => url('imoveis'),
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

        //$record = Imovel::find($id)->proprietario()->get()->toArray();;
        $record = Imovel::with('proprietario')->where('id', $id)->first();

        if (!$record) {
            throw new HttpException('Registro não encontrado', 404);
        }

        return $container['view']->render('imoveis/edit.php', [
            'title' => 'Editar Imóvel',
            'record' => $record,
            'owners' => $owners
        ]);
    }

    /**
     * @param $container
     * @param $request
     */
    public function update($container, $request)
    {
        $id = $request->attributes->get(1);
        $record = Imovel::find($id);

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
                'redirect' => url('imoveis'),
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
        $record = Imovel::find($id);

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
                'redirect' => url('imoveis'),
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