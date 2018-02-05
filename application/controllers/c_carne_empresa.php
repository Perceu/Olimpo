<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_carne_empresa extends CI_Controller {

    function __construct() {
      	parent::__construct();
      	if (!isset($this->session->userdata['Ativo'])) {
           	header('location: '.site_url());
  		}
    }

     public function cadastrarParcelas($carNum){
          $this->load->model('m_carnes_empresa');
          $this->load->view('head/head');
          $data['carnes'] = $this->m_carnes_empresa->BuscaCarnes($carNum);
          $this->load->view('menu/principal');
          $this->load->view('carne_empresa/cadastra_parcelas',$data);
          $this->load->view('footer/footer');        
     }
     public function editarParcelas($id){
          $this->load->model('m_carnes_empresa');
          $this->load->model('m_turnos');
          $data['parcela'] = $this->m_carnes_empresa->buscarParcela($id);
          $this->load->view('head/head');
          $this->load->view('menu/principal');
          $this->load->view('carne_empresa/editar_parcelas',$data);
          $this->load->view('footer/footer');
     }
     //funcoes para gravar no banco de dados
     public function salvar($id){
          $this->load->model('m_carnes_empresa');
          $this->m_carnes_empresa->salvarParcela($id);        
          header("location:".site_url('c_carne_empresa/gerenciador'));
     }
     public function gravar($id){
          $this->load->model('m_carnes_empresa');
          if($this->m_carnes_empresa->gravarParcela($id)){        
            header("location: ".site_url("c_carne_empresa/detalhes/".$id));
          }else{
            header("location: ".site_url("c_carne_empresa/detalhes/".$id));
          }
     }
     public function excluir($id){
          $this->load->model('m_carnes_empresa');
          $this->m_carnes_empresa->excluirParcela($id);      
          header("location:".site_url('c_carne_empresa/gerenciador'));
     }  
        
     public function excluir_parcelas(){
          $this->load->model('m_carnes_empresa');
          $this->m_carnes_empresa->excluirParcelas();      
          header("location:".site_url('c_carne_empresa/gerenciador'));

     }
     public function form_carnes()
     {
          $this->load->model('m_empresas');
          $this->load->view('head/head');
          $this->load->view('menu/principal');
          $data['empresas'] = $this->m_empresas->listar();
          $this->load->view('carne_empresa/form_carne',$data);
          
          $this->load->view('footer/footer');
     } 
     public function gerenciador()
     {
          $this->load->model('m_carnes_empresa');
          $this->load->view('head/head');
          $this->load->view('menu/principal');
          $data['carnes'] = $this->m_carnes_empresa->listCarnes();
          $this->load->view('carne_empresa/gerenciador_carnes',$data);
          $this->load->view('footer/footer');
     }

     public function RegistrarPagamento($id)
     {
          $this->load->model('m_carnes_empresa');
          $this->load->model('m_categorias');
          $this->load->model('m_turnos');
          $this->load->model('m_contas');
          $this->load->view('head/head');
          $this->load->view('menu/principal');
          $data['parcela'] = $this->m_carnes_empresa->buscarParcela($id);
          $data['turnos'] = $this->m_turnos->listar();
          $data['contas'] = $this->m_contas->listar();
          $data['categorias'] = $this->m_categorias->buscaSaidas();
          $this->load->view('carne_empresa/carne_pagamento',$data);
          $this->load->view('footer/footer');
     }

     public function efetuarPagamento($id)
     {
          $this->load->model('m_carnes_empresa');
          $this->load->model('m_registro_saidas');
          $entradaId = $this->m_registro_saidas->registrarSaida($id);
          $this->m_carnes_empresa->pagaParcela($id,$entradaId);
          header('location:'.site_url('c_carne_empresa/gerenciador'));

     }
     public function excluir_carne($carNum){
          $this->load->model('m_carnes_empresa');
          $this->m_carnes_empresa->ExcluiCarne($carNum);
          header('location:'.site_url('c_carne_empresa/gerenciador'));
     }
     public function detalhes($carNum)
     {
          $this->load->model('m_carnes_empresa');
          $this->load->view('head/head');
          $this->load->view('menu/principal');
          $data['carnes'] = $this->m_carnes_empresa->BuscaCarnes($carNum);
          $this->load->view('carne_empresa/detalhes_carnes',$data);
          $this->load->view('footer/footer');
     }

	public function imprimir()
     {
          $this->load->model('m_carnes_empresa');
          $this->load->library('mpdf');
          $vet= explode('/', $this->input->post('vencimento'));
          $vencimento = new DateTime($vet[2].'-'.$vet[1].'-'.$vet[0]); 
          $ultimoCarne = $this->m_carnes_empresa->maiorCarne();
          $numCarne = $ultimoCarne[0]->ecNum + 1;
          $numParcelas = $this->input->post('n_parcela');
          $valorMensalidade = $this->input->post('mensalidade');
          $valorMensalidadeVencida = $this->input->post('mensalidade_vencida');

          for($i = 1; $i <= $numParcelas; $i++){
               $parcela['ecNum'] = $numCarne;
               $parcela['ecParcela'] = $i;
               $parcela['empId'] = $this->input->post('emp_id');
               $parcela['ecVencimento'] = date_format($vencimento,'Y-m-d');
               $parcela['ecValor'] = $valorMensalidade;
               $parcela['ecDescricao'] = $this->input->post('descricao');
               $parcela['ecValorVencido'] = $valorMensalidadeVencida;
               $this->m_carnes_empresa->geraParcela($parcela);
               $vencimento = date_add($vencimento, date_interval_create_from_date_string('1 month'));
          }
          header('location:'.site_url('c_carne_empresa/gerenciador'));  
     }

     
}
