<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_carne extends CI_Controller {

    function __construct() {
      	parent::__construct();
      	if (!isset($this->session->userdata['Ativo'])) {
           	header('location: '.site_url());
  		}
    }

     public function cadastrarParcelas($carNum){
          $this->load->model('m_carnes');
          $this->load->view('head/head');
          $data['carnes'] = $this->m_carnes->BuscaCarnes($carNum);
          $this->load->view('menu/principal');
          $this->load->view('carne/cadastra_parcelas',$data);
          $this->load->view('footer/footer');        
     }
     public function editarParcelas($id){
          $this->load->model('m_carnes');
          $this->load->model('m_turnos');
          $data['parcela'] = $this->m_carnes->buscarParcela($id);
          $this->load->view('head/head');
          $this->load->view('menu/principal');
          $this->load->view('carne/editar_parcelas',$data);
          $this->load->view('footer/footer');
     }
     //funcoes para gravar no banco de dados
     public function salvar($id){
          $this->load->model('m_carnes');
          $this->m_carnes->salvarParcela($id);        
          header("location:".site_url('c_carne/gerenciador'));
     }

     public function inativar_carne($id){
          $this->load->model('m_carnes');
          $this->m_carnes->inativarCarne($id);        
          header("location:".site_url('c_carne/gerenciador'));
     }

     public function ativar_carne($id){
          $this->load->model('m_carnes');
          $this->m_carnes->ativarCarne($id);        
          header("location:".site_url('c_carne/gerenciador'));
     }

     public function gravar($id){
          $this->load->model('m_carnes');
          if($this->m_carnes->gravarParcela($id)){        
            header("location: ".site_url("c_carne/detalhes/".$id));
          }else{
            header("location: ".site_url("c_carne/detalhes/".$id));
          }
     }

     public function excluir($id){
          $this->load->model('m_carnes');
          $this->m_carnes->excluirParcela($id);      
          header("location:".site_url('c_carne/gerenciador'));
     }  
        
     public function excluir_parcelas(){
          $this->load->model('m_carnes');
          $this->m_carnes->excluirParcelas();      
          header("location:".site_url('c_carne/gerenciador'));

     }
     public function form_carnes()
     {
          $this->load->model('m_alunos');
          $this->load->model('m_curso');
          $this->load->view('head/head');
          $this->load->view('menu/principal');
          $data['cursos'] = $this->m_curso->listar();
          $data['alunos'] = $this->m_alunos->listar();
          $this->load->view('carne/form_carne',$data);
          
          $this->load->view('footer/footer');
     } 
     public function gerenciador()
     {
          $this->load->model('m_carnes');
          $this->load->view('head/head');
          $this->load->view('menu/principal');
          $data['carnes'] = $this->m_carnes->listCarnes();
          $this->load->view('carne/gerenciador_carnes',$data);
          $this->load->view('footer/footer');
     }

     public function RegistrarPagamento($id)
     {
          $this->load->model('m_carnes');
          $this->load->model('m_contas');
          $this->load->model('m_categorias');
          $this->load->model('m_turnos');
          $this->load->view('head/head');
          $this->load->view('menu/principal');
          $data['parcela'] = $this->m_carnes->buscarParcela($id);
          $data['turnos'] = $this->m_turnos->listar();
          $data['contas'] = $this->m_contas->listar();
          $data['categorias'] = $this->m_categorias->buscaEntradas();
          $this->load->view('carne/carne_pagamento',$data);
          $this->load->view('footer/footer');
     }

     public function efetuarPagamento($id)
     {
          $this->load->model('m_carnes');
          $this->load->model('m_registro_entradas');
          $entradaId = $this->m_registro_entradas->registrarEntrada($id);
          $this->m_carnes->pagaParcela($id,$entradaId);
          header('location:'.site_url('c_carne/gerenciador'));

     }
     public function excluir_carne($carNum){
          $this->load->model('m_carnes');
          $this->m_carnes->ExcluiCarne($carNum);
          header('location:'.site_url('c_carne/gerenciador'));
     }
     public function detalhes($carNum)
     {
          $this->load->model('m_carnes');
          $this->load->view('head/head');
          $this->load->view('menu/principal');
          $data['carnes'] = $this->m_carnes->BuscaCarnes($carNum);
          $this->load->view('carne/detalhes_carnes',$data);
          $this->load->view('footer/footer');
     }

	public function imprimir()
     {
          $this->load->model('m_alunos');
          $this->load->model('m_curso');
          $this->load->model('m_carnes');
          $aluno = $this->m_alunos->buscar($this->input->post('alu_id'));
          $curso = $this->m_curso->buscar($this->input->post('cur_id'));
          $this->load->library('mpdf');
          $html= "<table style='border: 1px solid #FFF; font-family: mono; font-size: 7pt;'>";
          $vet= explode('/', $this->input->post('vencimento'));
          $vencimento = new DateTime($vet[2].'-'.$vet[1].'-'.$vet[0]); 
          $ultimoCarne = $this->m_carnes->maiorCarne();
          $numCarne = $ultimoCarne[0]->carNum + 1;
          $numParcelas = $this->input->post('n_parcela');
          $valorMensalidade = $this->input->post('mensalidade');
          $valorMensalidadeVencida = $this->input->post('mensalidade_vencida');

          for($i = 1; $i <= $numParcelas; $i++){
               $parcela['carNum'] = $numCarne;
               $parcela['carParcela'] = $i;
               $parcela['aluId'] = $this->input->post('alu_id');
               $parcela['curId'] = $this->input->post('cur_id');
               $parcela['carVencimento'] = date_format($vencimento,'Y-m-d');
               $parcela['carValor'] = $valorMensalidade;
			   if (!empty($valorMensalidadeVencida)){
			       $parcela['carValorVencido'] = $valorMensalidadeVencida;
			   }
               $this->m_carnes->geraParcela($parcela);
               if (($i%2)==0){
                    $html = $html.   "<td style='border-collapse: collapse;'>";
                    $html = $html.     "<table style='height:5cm; width:15cm; border: 0.3px solid #DDD;'>";
                    $html = $html.          "<tr style='border-collapse: collapse;'>";
                    $html = $html.              "<td style='border-right: 1px dashed #ccc;'>";
                    $html = $html.                  "<table style='margin-left: 1cm; margin-right: 0.1cm;border: 1px solid #000;'>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Nome:</b>"."<br>".$aluno[0]->aluNome."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td align='center' style='text-rotate: 90; width:0.6cm; border: 1px solid #ccc;' rowspan=5>";
                    $html = $html.                              "<br><br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Curso:</b>"."<br>". $curso[0]->curNome."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Matrícula:</b>"."<br>". $aluno[0]->aluMatricula."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Parcela:</b>" ."<br>".$i.'/'.$numParcelas."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Vencimento:</b>" ."<br>". date_format($vencimento,'d/m/Y')."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='background: #eee; border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Mensalidade: </b><br> R$ ". $valorMensalidade."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td style='background:#eee; border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Mensalidade vencida:</b> <br> R$ ". $valorMensalidadeVencida."<br>";            
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr>";
                    $html = $html.                          "<td colspan=2>";
                    $html = $html.                              "<h5>Fone: (54) 3291-2670</h5><h6>Av.Venancio Aires 1110 Salas 11-12<br>95190-000 São Marcos-RS</h6>";
                    $html = $html.                           "</td>";
                    $html = $html.                           "<td>";
                    $html = $html.                              "<img src=". base_url("public/img/logo.jpg")." height='15'>";
                    $html = $html.                           "</td>";                    
                    $html = $html.                      "</tr>";
                    $html = $html.                  "</table>";            
                    $html = $html.              "</td>";
                    $html = $html.              "<td>";
                    $html = $html.                  "<table style='margin-left: 0.2cm; border: 1px solid #000;'>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Nome:</b>"."<br>".$aluno[0]->aluNome."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Curso:</b>"."<br>". $curso[0]->curNome."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Matrícula:</b>"."<br>". $aluno[0]->aluMatricula."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Parcela:</b>" ."<br>".$i.'/'.$numParcelas."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Vencimento:</b>" ."<br>". date_format($vencimento,'d/m/Y')."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='background: #eee; border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Mensalidade: </b><br> R$ ". $valorMensalidade."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td style='background:#eee; border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Mensalidade vencida:</b> <br> R$ ". $valorMensalidadeVencida."<br>";            
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr>";
                    $html = $html.                          "<td colspan=3>";                    
                    $html = $html.                              "<h5>Fone: (54) 3291-2670</h5><h6>Av.Venancio Aires 1110 Salas 11-12<br>95190-000 São Marcos-RS</h6>";
                    $html = $html.                           "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                  "</table>"; 
                    $html = $html.              "</td>";
                    $html = $html.          "</tr>";
                    $html = $html.      "</table>";
                    $html = $html.  "</td>";
                    
               }else{
                    
                    $html = $html. "</tr>";
                    $html = $html. "<tr style='border-collapse: collapse;'>";
                    $html = $html.   "<td style='border-collapse: collapse;'>";
                    $html = $html.     "<table style='height:5cm; width:15cm; border: 0.5px solid #DDD;'>";
                    $html = $html.          "<tr style='border-collapse: collapse;'>";
                    $html = $html.              "<td style='border-right: 1px dashed #ccc;'>";
                    $html = $html.                  "<table style='border-top-left-radius: 15px; border-bottom-left-radius: 15px; margin-left: 1cm; margin-right: 0.2cm;border: 1px solid #000;'>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Nome:</b>"."<br>".$aluno[0]->aluNome."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td align='center' style='text-rotate: 90; width:1cm; border: 1px solid #ccc;' rowspan=5>";
                    $html = $html.                              "<br><br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Curso:</b>"."<br>". $curso[0]->curNome."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Matrícula:</b>"."<br>". $aluno[0]->aluMatricula."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Parcela:</b>" ."<br>".$i.'/'.$this->input->post('n_parcela')."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Vencimento:</b>" ."<br>". date_format($vencimento,'d/m/Y')."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='background: #eee; border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Mensalidade: </b><br> R$ ". $valorMensalidade."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td style='background:#eee; border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Mensalidade vencida:</b> <br> R$ ". $valorMensalidadeVencida."<br>";            
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr>";
                    $html = $html.                          "<td colspan=2>";
                    $html = $html.                              "<h5>Fone: (54) 3291-2670</h5><h6>Av.Venancio Aires 1110 Salas 11-12<br>95190-000 São Marcos-RS</h6>";
                    $html = $html.                           "</td>";
                    $html = $html.                           "<td>";
                    $html = $html.                              "<img src=". base_url("public/img/logo.jpg")." height='15'>";
                    $html = $html.                           "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                  "</table>";            
                    $html = $html.              "</td>";
                    $html = $html.              "<td>";
                    $html = $html.                  "<table style='margin-left: 0.2cm; border: 1px solid #000;'>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Nome:</b>"."<br>".$aluno[0]->aluNome."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Curso:</b>"."<br>". $curso[0]->curNome."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Matrícula:</b>"."<br>". $aluno[0]->aluMatricula."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Parcela:</b>" ."<br>".$i.'/'.$this->input->post('n_parcela')."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Vencimento:</b>" ."<br>". date_format($vencimento,'d/m/Y')."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='background: #eee; border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Mensalidade: </b><br> R$ ". $valorMensalidade."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td style='background:#eee; border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Mensalidade vencida:</b> <br> R$ ". $valorMensalidadeVencida."<br>";            
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr>";
                    $html = $html.                          "<td colspan=2>";
                    $html = $html.                              "<h5>Fone: (54) 3291-2670</h5><h6>Av.Venancio Aires 1110 Salas 11-12<br>95190-000 São Marcos-RS</h6>";
                    $html = $html.                           "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                  "</table>"; 
                    $html = $html.              "</td>";
                    $html = $html.          "</tr>";
                    $html = $html.      "</table>";
                    $html = $html.  "</td>";
               }
               $vencimento = date_add($vencimento, date_interval_create_from_date_string('1 month'));
          }
          $html = $html."</table>";
          $this->mpdf->mPDF('utf-8', 'A4-L', 0, '', 2, 2, 2, 2, 0, 0, 'L');
          $this->mpdf->WriteHTML($html);
          $this->mpdf->Output($aluno[0]->aluMatricula.' - '.$aluno[0]->aluNome.'.pdf','D');        
     }

     public function imprimir_carne($carNum)
	{
          $this->load->model('m_carnes');
          $this->load->library('mpdf');
          $html= "<table style='border: 1px solid #FFF; font-family: mono; font-size: 7pt;'>";
          $carnes = $this->m_carnes->buscaCarnes($carNum);

          $numParcelas = count($carnes);
          for($i = 0; $i <= $numParcelas; $i++){
               if (($i%2)==0){
                    $html = $html.   "<td style='border-collapse: collapse;'>";
                    $html = $html.     "<table style='height:5cm; width:15cm; border: 0.3px solid #DDD;'>";
                    $html = $html.          "<tr style='border-collapse: collapse;'>";
                    $html = $html.              "<td style='border-right: 1px dashed #ccc;'>";
                    $html = $html.                  "<table style='margin-left: 1cm; margin-right: 0.1cm;border: 1px solid #000;'>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Nome:</b>"."<br>".$carnes[$i-1]->aluNome."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td align='center' style='text-rotate: 90; width:0.6cm; border: 1px solid #ccc;' rowspan=5>";
                    $html = $html.                              "<br><br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Curso:</b>"."<br>". $carnes[$i-1]->curNome."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Matrícula:</b>"."<br>". $carnes[$i-1]->aluMatricula."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Parcela:</b>" ."<br>".($i).'/'.$numParcelas."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Vencimento:</b>" ."<br>". date('d/m/Y',strtotime($carnes[$i-1]->carVencimento))."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='background: #eee; border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Mensalidade: </b><br> R$ ". $carnes[$i-1]->carValor."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td style='background:#eee; border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Mensalidade vencida:</b> <br> R$ ". $carnes[$i-1]->carValor."<br>";            
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr>";
                    $html = $html.                          "<td colspan=2>";
                    $html = $html.                              "<h5>Fone: (54) 3291-2670</h5><h6>Av.Venancio Aires 1110 Salas 11-12<br>95190-000 São Marcos-RS</h6>";
                    $html = $html.                           "</td>";
                    $html = $html.                           "<td>";
                    $html = $html.                              "<img src=". base_url("public/img/logo.jpg")." height='15'>";
                    $html = $html.                           "</td>";                    
                    $html = $html.                      "</tr>";
                    $html = $html.                  "</table>";            
                    $html = $html.              "</td>";
                    $html = $html.              "<td>";
                    $html = $html.                  "<table style='margin-left: 0.2cm; border: 1px solid #000;'>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Nome:</b>"."<br>".$carnes[$i-1]->aluNome."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Curso:</b>"."<br>". $carnes[$i-1]->curNome."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Matrícula:</b>"."<br>". $carnes[$i-1]->aluMatricula."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Parcela:</b>" ."<br>".($i).'/'.$numParcelas."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Vencimento:</b>" ."<br>". date('d/m/Y',strtotime($carnes[$i-1]->carVencimento))."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='background: #eee; border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Mensalidade: </b><br> R$ ". $carnes[$i-1]->carValor."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td style='background:#eee; border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Mensalidade vencida:</b> <br> R$ ". $carnes[$i-1]->carValorVencido."<br>";            
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr>";
                    $html = $html.                          "<td colspan=3>";                    
                    $html = $html.                              "<h5>Fone: (54) 3291-2670</h5><h6>Av.Venancio Aires 1110 Salas 11-12<br>95190-000 São Marcos-RS</h6>";
                    $html = $html.                           "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                  "</table>"; 
                    $html = $html.              "</td>";
                    $html = $html.          "</tr>";
                    $html = $html.      "</table>";
                    $html = $html.  "</td>";
                    
               }else{
                    
                    $html = $html. "</tr>";
                    $html = $html. "<tr style='border-collapse: collapse;'>";
                    $html = $html.   "<td style='border-collapse: collapse;'>";
                    $html = $html.     "<table style='height:5cm; width:15cm; border: 0.5px solid #DDD;'>";
                    $html = $html.          "<tr style='border-collapse: collapse;'>";
                    $html = $html.              "<td style='border-right: 1px dashed #ccc;'>";
                    $html = $html.                  "<table style='border-top-left-radius: 15px; border-bottom-left-radius: 15px; margin-left: 1cm; margin-right: 0.2cm;border: 1px solid #000;'>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Nome:</b>"."<br>".$carnes[$i-1]->aluNome."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td align='center' style='text-rotate: 90; width:1cm; border: 1px solid #ccc;' rowspan=5>";
                    $html = $html.                              "<br><br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Curso:</b>"."<br>". $carnes[$i-1]->curNome."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Matrícula:</b>"."<br>". $carnes[$i-1]->aluMatricula."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Parcela:</b>" ."<br>".($i).'/'.$numParcelas."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Vencimento:</b>" ."<br>". date('d/m/Y',strtotime($carnes[$i-1]->carVencimento))."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='background: #eee; border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Mensalidade: </b><br> R$ ". $carnes[$i-1]->carValor."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td style='background:#eee; border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Mensalidade vencida:</b> <br> R$ ". $carnes[$i-1]->carValorVencido."<br>";            
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr>";
                    $html = $html.                          "<td colspan=2>";
                    $html = $html.                              "<h5>Fone: (54) 3291-2670</h5><h6>Av.Venancio Aires 1110 Salas 11-12<br>95190-000 São Marcos-RS</h6>";
                    $html = $html.                           "</td>";
                    $html = $html.                           "<td>";
                    $html = $html.                              "<img src=". base_url("public/img/logo.jpg")." height='15'>";
                    $html = $html.                           "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                  "</table>";            
                    $html = $html.              "</td>";
                    $html = $html.              "<td>";
                    $html = $html.                  "<table style='margin-left: 0.2cm; border: 1px solid #000;'>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Nome:</b>"."<br>".$carnes[$i-1]->aluNome."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Curso:</b>"."<br>". $carnes[$i-1]->curNome."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Matrícula:</b>"."<br>". $carnes[$i-1]->aluMatricula."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Parcela:</b>" ."<br>".($i).'/'.$numParcelas."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='border: 1px solid #ccc;' colspan=2>";
                    $html = $html.                              "<b>Vencimento:</b>" ."<br>". date('d/m/Y',strtotime($carnes[$i-1]->carVencimento))."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr style='border-collapse: collapse;'>";
                    $html = $html.                          "<td style='background: #eee; border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Mensalidade: </b><br> R$ ". $carnes[$i-1]->carValor."<br>";
                    $html = $html.                          "</td>";
                    $html = $html.                          "<td style='background:#eee; border: 1px solid #ccc;'>";
                    $html = $html.                              "<b>Mensalidade vencida:</b> <br> R$ ".$carnes[$i-1]->carValorVencido."<br>";            
                    $html = $html.                          "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                      "<tr>";
                    $html = $html.                          "<td colspan=2>";
                    $html = $html.                              "<h5>Fone: (54) 3291-2670</h5><h6>Av.Venancio Aires 1110 Salas 11-12<br>95190-000 São Marcos-RS</h6>";
                    $html = $html.                           "</td>";
                    $html = $html.                      "</tr>";
                    $html = $html.                  "</table>"; 
                    $html = $html.              "</td>";
                    $html = $html.          "</tr>";
                    $html = $html.      "</table>";
                    $html = $html.  "</td>";
               }
          }
          $html = $html."</table>";
          $this->mpdf->mPDF('utf-8', 'A4-L', 0, '', 2, 2, 2, 2, 0, 0, 'L');
          $this->mpdf->WriteHTML($html);
          $this->mpdf->Output($carnes[0]->aluMatricula.' - '.$carnes[0]->aluNome.'.pdf','D');        
	}
}
