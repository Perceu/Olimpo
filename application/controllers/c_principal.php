<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_principal extends CI_Controller {
    
	public function index()
	{
        if (isset($this->session->userdata['Ativo'])) {
            $this->load->model('m_carnes');
            $this->load->model('m_alunos');
            $this->load->view('head/head');
            $this->load->view('menu/principal');
            $data['carnesVencidos'] = $this->m_carnes->buscaVencidos();
            $this->load->view('principal/index',$data);
            $this->load->view('footer/footer');   
        }else{
            $this->load->view('head/head');
            $this->load->view('login/login'); 
            $this->load->view('footer/footer');
        }
	}
        
    public function form_diploma()
	{
        $this->load->model("m_instrutor");
        $this->load->model("m_curso");
        $data["instrutores"] = $this->m_instrutor->listar();
        $data["cursos"] = $this->m_curso->listar();
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $this->load->view('diploma/diploma',$data);
        $this->load->view('footer/footer');
	}
        
}