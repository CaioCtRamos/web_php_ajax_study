<?php

namespace App\Controllers;

use App\Entities\Produto as Produtos;
use App\Models\ProdutosModel as ProdutosModel;

class ProdutosController extends Controller{
    private Produtos $entity;
    private ProdutosModel $model;

    public function __construct(){
        parent::__construct();
        $this->model = new \App\Models\ProdutosModel();
    }

    public function getAll(){
        $produtos = $this->model->getAll();
        if($produtos){
            return json_encode (['success' => true,
                                'data' => $produtos,
                                'message' => 'dados obtidos com sucesso.']);
        }
        return (['success' => false,
                'data' => $produtos,
                'message' => 'consulta nao retornou dados']);
    }

    public function getById($id){
        $produtos = $this->model->getById($id);
        return json_encode(['success' => $this->success,
                            'data' => $produtos,
                            'message' => 'Registro obtido com sucesso.']);
    }

    public function add(Produtos $entity){
        $this->model = new ProdutosModel();

        if($this->model->add($entity)){
            $this->success = true;
            $this->data = [];
            $this->msg = "Registro atualizado com sucesso.";
        }
        return json_encode(['success'=>$this->success,
                            'data'=>$this->data,
                            'message' => $this->msg]);
    }

    public function update(Produtos $produto){
        if($this->model->update($produto)){
            $this->success = true;
            $this->data = [];
            $this->msg = 'Registro atualizado com sucesso.';
        }

        return json_encode(['success'=>$this->success,
                            'data'=>$this->data,
                            'message'=>$this->msg]);
    }

    public function delete ($id){

        $success = $this->model->delete($id);

        if($success){
            return json_encode(['success'=> true,
            'data'=> [],
            'message'=>'registro excluido com sucesso']);

            
        }
        return json_encode(['success'=> false,
                            'data'=> [],
                            'message'=>'nao foi possivel ecluir o registro']);
    }
}