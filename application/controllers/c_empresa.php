<?php

/**
 * Description of c_empresa
 *
 * @author Loki
 */
class c_empresa extends CI_Controller{
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
        $this->load->view('empresas/cadastraempresas');
        $this->load->view('footer/footer');        
    }
    public function editar($id){
        $this->load->model('m_empresas');
        $data['empresas'] = $this->m_empresas->buscar($id);
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('empresas/editaempresas',$data);
        $this->load->view('footer/footer');
    }
    public function listar()
    {
        $this->load->model('m_empresas');
        $data['empresas'] = $this->m_empresas->listar();
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('empresas/listaempresas',$data);
        $this->load->view('footer/footer');
    }
    
    //funcoes para gravar no banco de dados
    public function salvar($id){
        $this->load->model('m_empresas');
        $this->m_empresas->salvar($id);        
        $this->listar();
    }
    public function gravar(){
        $this->load->model('m_empresas');
        if($this->m_empresas->gravar()){        
            header("location: listar");
        }else{
            header("location: cadastrar");
        }
        
    }
    public function excluir($id){
        $this->load->model('m_empresas');
        $this->m_empresas->excluir($id);      
        $this->listar();
    }
    
}
