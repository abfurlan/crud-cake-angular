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
    public function all(){
        $this->RequestHandler->renderAs($this, 'json');
        $this->response->type('application/json');
        $this->set('_serialize', true);
        $this->set('produtos', $this->Produtos->find('all'));
    }
    public function form(){
        $this->viewBuilder()->layout('ajax');
    }
}