<?php

/**
 * Description of c_alunos
 *
 * @author Loki
 */
class c_alunos extends CI_Controller{
    //put your code here
    function __construct() {
        parent::__construct();
        if (!isset($this->session->userdata['Ativo'])) {
            header('location: '.site_url());
        }
    }
    
    public function cadastrar(){
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('alunos/cadastraalunos');
        $this->load->view('footer/footer');        
    }
    public function editar($id){
        $this->load->model('m_alunos');
        $data['alunos'] = $this->m_alunos->buscar($id);
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('alunos/editaalunos',$data);
        $this->load->view('footer/footer');
    }
    public function listar()
    {
        $this->load->model('m_alunos');
        $data['alunos'] = $this->m_alunos->listar();
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('alunos/listaalunos',$data);
        $this->load->view('footer/footer');
    }
    
    //funcoes para gravar no banco de dados
    public function salvar($id){
        $this->load->model('m_alunos');
        $this->m_alunos->salvar($id);        
        $this->listar();
    }
    public function gravar(){
        $this->load->model('m_alunos');
        if($this->m_alunos->gravar()){        
            header("location: listar");
        }else{
            header("location: cadastrar");
        }
        
    }
    public function excluir($id){
        $this->load->model('m_alunos');
        $this->m_alunos->excluir($id);      
        $this->listar();
    }
    
}
