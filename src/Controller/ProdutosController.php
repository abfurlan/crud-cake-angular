<?php
namespace App\Controller;
use App\Controller\AppController;

class ProdutosController extends AppController {
    
    
    public function index(){
        $this->set('produtos', $this->Produtos->find('all'));
    }
    public function initialize(){
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }
    /*
     * Seleciona todos os produtos e retorna em formato json
     */
    public function all(){
        $this->RequestHandler->renderAs($this, 'json');
        $this->response->type('application/json');
        $this->set('_serialize', true);
        $this->set('produtos', $this->Produtos->find('all'));
    }
    /*
     * Seleciona um produto pelo seu id
     */
    public function view($id){
        $this->RequestHandler->renderAs($this, 'json');
        $this->response->type('application/json');
        $this->set('_serialize', true);
        $this->set('produto', $this->Produtos->get($id));
    }
    /*
     * Exclui um ou mais produtos
     */
    public function delete(){
        $this->request->is('post');
        $this->RequestHandler->renderAs($this, 'json');
        $this->response->type('application/json');  
        foreach ($this->request->data as $id){
            $produto = $this->Produtos->get($id);
            if($this->Produtos->delete($produto)){
                $this->set('result',array('success'=>true,'msg'=>'Produto excluído com sucesso!'));
            } else {
                $this->set('result',array('success'=>false,'msg'=>'Erro ao excluir produto!'));
            }    
        }
        
    }
    /*
     * Template do formulário de cadastro e edição de produtos
     */
    public function form(){
        $this->viewBuilder()->layout('ajax');
    }
    /*
     * Adiciona um novo produto
     */
    public function add(){
        $produto = $this->Produtos->newEntity();
        $this->RequestHandler->renderAs($this, 'json');
        $this->response->type('application/json');  
        $this->set('_serialize', true);
        
        if ($this->request->is('post')) {
            $produto = $this->Produtos->patchEntity($produto, $this->request->data);
            if ($this->Produtos->save($produto)) {
                $this->set('result',array('success'=>true,'msg'=>'Produto salvo com sucesso!'));
            } else {
                $this->set('result',array('success'=>false,'msg'=>'Erro ao salvar produto'));
            }
        }
    }
    /*
     * Edita um produto existente
     */
    public function edit($id = null){
        
        $produto = $this->Produtos->get($id);
        $this->RequestHandler->renderAs($this, 'json');
        $this->response->type('application/json');  
        $this->set('_serialize', true);

        if ($this->request->is(['post', 'put'])) {
            $this->Produtos->patchEntity($produto, $this->request->data);
            if ($this->Produtos->save($produto)) {
                $this->set('result',array('success'=>true,'msg'=>'Produto salvo com sucesso!'));
            } else {
                $this->set('result',array('success'=>false,'msg'=>'Erro ao salvar produto'));
            }
        }

    }
}