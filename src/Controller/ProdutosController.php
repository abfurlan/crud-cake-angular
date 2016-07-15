<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
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
        $this->request->is('post');
        //print_r($this->request->data);exit;
        $this->RequestHandler->renderAs($this, 'json');
        $this->response->type('application/json');
        $this->set('_serialize', true);
        $count = $this->Produtos->find('all')->count();
        $produtos = $this->Produtos->find()
                                   ->limit($this->request->data['limit'])
                                   ->page($this->request->data['page'])
                                   ->order($this->request->data['order']);
        $this->set('count', $count);
        $this->set('produtos', $produtos);
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
    public function status($id,$status){
        $this->RequestHandler->renderAs($this, 'json');
        $this->response->type('application/json');  
        $this->set('_serialize', true);
        $produtosTable = TableRegistry::get('Produtos');
        $produto = $produtosTable->get($id); // Return article with id 12

        $produto->id_status = $status === 'true' ? false : true;
        if ($this->Produtos->save($produto)) {
            $this->set('result',array('success'=>true,'msg'=>'Produto salvo com sucesso!'));
        } else {
            $this->set('result',array('success'=>false,'msg'=>'Erro ao salvar produto'));
        }
    }
}