<?php

require __DIR__ . '/../../vendor/autoload.php';

header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

header('Content-Type: Application/json; charset=UTF-8');

ini_set('display_errors', TRUE);
ini_set('error_reporting', E_ALL|E_CORE_WARNING);

$method = $_SERVER['REQUEST_METHOD'];
$produtosController = new \App\Controllers\ProdutosController();
$entity = new \App\Entities\Produto;

$produtos = "";

switch($method){
    
    case 'GET':
        $produtos = $produtosController->getAll();
        echo $produtos;
    break;

    case 'POST':
        $body = $_REQUEST;

        $entity->setId($body['id']);
        $entity->setDescricao($body['descricao']);
        $entity->setValorUnitario($body['valor_unitario']);

        $saved = $produtosController->add($entity);

        echo json_encode(['success'=>$saved,
                        'data'=>[],
                        'message'=> $saved ? 'registro incluido com sucesso' :
                         'nao foi possivel inclueir o registro']);
    break;

    case 'PUT':
        parse_str(file_get_contents("php://input"),$_PUT);

        foreach ($_PUT as $key => $value){
		    unset($_PUT[$key]);
		    $_PUT[str_replace('amp;', '', $key)] = $value;
        }

        $_REQUEST = array_merge($_REQUEST, $_PUT);

        $body = $_REQUEST;

        $entity->setId($body['id']);
        $entity->setDescricao($body['descricao']);
        $entity->setValorUnitario($body['valor_unitario']);

        $updated = $produtosController->update($entity);

        echo json_encode(['success'=>$updated,
                        'data'=> [],
                        'message' => $updated ? 'registro atualizado com sucesso' :
                         'Nao foi possivel atualizar o registro']);
    
    break;

    case 'DELETE':
        parse_str(file_get_contents('php://input'),$_DELETE);
        
        foreach($_DELETE as $key => $value){
            unset($_DELETE[$key]);
                $_DELETE[str_replace('amp','',$key)] = $value;
        }
        $_REQUEST = array_merge($_REQUEST , $_DELETE);
        $id = $_REQUEST['id'] ?? '0';

        $deleted = $produtosController->delete($id);

        echo json_encode(['success'=> $deleted,
                        'data'=>[],
                        'message' => $deleted ? 'registro excluido com sucesso' :
                         'nao foi possivel excluir o registro']);

    break;
}