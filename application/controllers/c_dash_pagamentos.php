<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_dash_pagamentos extends CI_Controller {
    
	public function index()
	{
        if (isset($this->session->userdata['Ativo'])) {
            $this->load->model('m_carnes_empresa');
            $this->load->view('head/head');
            $this->load->view('menu/principal');
            $data['carnesVencidos'] = $this->m_carnes_empresa->buscaVencidos();
            $this->load->view('dash_pagamentos/index',$data);
            $this->load->view('footer/footer');   
        }else{
            $this->load->view('head/head');
            $this->load->view('login/login'); 
            $this->load->view('footer/footer');
        }
	} 
}