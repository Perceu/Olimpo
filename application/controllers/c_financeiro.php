<?php
class c_financeiro extends CI_Controller{

    function __construct() {
        parent::__construct();
        if (!isset($this->session->userdata['Ativo'])) {
            header('location: '.site_url());
        }
    }

    public function ralatorioMovimentosSaida($paDia = 0, $paMes = 0, $paAno = 0){
        $this->load->model('m_registro_saidas');
        $this->load->model('m_contas');
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $data['movimentosDia'] = $this->m_registro_saidas->buscaMovimentosDia($paDia,$paMes,$paAno);
        $data['movimentosMes'] = $this->m_registro_saidas->buscaMovimentosMes($paMes,$paAno);
        $data['movimentosPorCategoria'] = $this->m_registro_saidas->buscaMovimentosMesPorCategoria($paMes,$paAno);
        $conId = $this->session->userdata['Conta'];
        $data['conta'] = $this->m_contas->Buscar($conId);
        $this->load->view('financeiro/relatorioMovimentoSaidas',$data);
        $this->load->view('footer/footer');        
    }
    
    public function ralatorioMovimentos($paDia = 0, $paMes = 0, $paAno = 0){
        $this->load->model('m_registro_entradas');
        $this->load->model('m_contas');
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $data['movimentosDia'] = $this->m_registro_entradas->buscaMovimentosDia($paDia,$paMes,$paAno);
        $data['movimentosMes'] = $this->m_registro_entradas->buscaMovimentosMes($paMes,$paAno);
        $data['movimentosPorCategoria'] = $this->m_registro_entradas->buscaMovimentosMesPorCategoria($paMes,$paAno);
        $conId = $this->session->userdata['Conta'];
        $data['conta'] = $this->m_contas->Buscar($conId);

        $this->load->view('financeiro/relatorioMovimentos',$data);
        $this->load->view('footer/footer');        
    }

    public function movimentosSaida($paDia = 0, $paMes = 0, $paAno = 0){
        $this->load->model('m_registro_saidas');
        $this->load->model('m_contas');
        $this->load->view('head/head');
        $this->load->view('menu/principal');

        $data['movimentosDia'] = $this->m_registro_saidas->buscaMovimentosDia($paDia,$paMes,$paAno);
        $data['movimentosMes'] = $this->m_registro_saidas->buscaMovimentosMes($paMes,$paAno);
        
        $data['movimentosPorCategoria'] = $this->m_registro_saidas->buscaMovimentosMesPorCategoria($paMes,$paAno);
        $conId = $this->session->userdata['Conta'];
        $data['conta'] = $this->m_contas->Buscar($conId);
        $this->load->view('financeiro/MovimentoSaidas',$data);
        $this->load->view('footer/footer');        
    }
    
    public function movimentos($paDia = 0, $paMes = 0, $paAno = 0){
        $this->load->model('m_registro_entradas');
        $this->load->model('m_contas');
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $data['movimentosDia'] = $this->m_registro_entradas->buscaMovimentosDia($paDia,$paMes,$paAno,False);
        $data['movimentosMes'] = $this->m_registro_entradas->buscaMovimentosMes($paMes,$paAno,False);
        $data['movimentosPorCategoria'] = $this->m_registro_entradas->buscaMovimentosMesPorCategoria($paMes,$paAno,False);

        $this->load->view('financeiro/Movimentos',$data);
        $this->load->view('footer/footer');        
    }

    public function resumoDeMovimentos($dia = 0, $mes = 0, $ano = 0)
    {
        $this->load->model('m_registro_entradas');
        $this->load->model('m_registro_saidas');
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        if ($mes==0 and $ano==0 and $dia==0){
            $mes=date('m');
            $ano=date('Y');
            $dia=date('d');
        }
        $data['entradas'] = $this->m_registro_entradas->entradas_por_categoria($mes,$ano,$dia);
        $data['entradasPorCategoria'] = $this->m_registro_entradas->entradas_totais_por_categoria($mes,$ano,$dia);
        $data['saidas'] = $this->m_registro_saidas->saidas_por_categoria($mes,$ano,$dia);
        $data['saidasPorCategoria'] = $this->m_registro_saidas->saidas_totais_por_categoria($mes,$ano,$dia);
        
        $this->load->view('financeiro/gerenciador_financeiro_dia',$data);
        $this->load->view('footer/footer');       
    }

    public function registrarentrada(){
          $this->load->model('m_registro_entradas');
          $this->m_registro_entradas->registrarEntrada();
          header('location:'.site_url('c_financeiro/resumoDeMovimentos'));
    }    

    public function registrarsaida(){
          $this->load->model('m_registro_saidas');
          $this->m_registro_saidas->registrarSaida();
          header('location:'.site_url('c_financeiro/resumoDeMovimentos'));
    }


    public function editarSaida($id){
        $this->load->model('m_categorias');
        $this->load->model('m_turnos');
        $this->load->model('m_contas');
        $this->load->model('m_registro_saidas');
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $data['turnos'] = $this->m_turnos->listar();
        $data['contas'] = $this->m_contas->listar();
        $data['categorias'] = $this->m_categorias->buscaSaidas();
        $data['saida'] = $this->m_registro_saidas->buscaSaida($id);
        $this->load->view('financeiro/editar_saidas',$data);
        $this->load->view('footer/footer');
    }


    public function salvarsaida($id){
        $this->load->model('m_registro_saidas');
        $this->m_registro_saidas->atualizarSaida($id);
        header("location:".site_url('c_financeiro/ralatorioMovimentosSaida'));
    }    
    public function salvarentrada($id){
        $this->load->model('m_registro_entradas');
        $this->m_registro_entradas->atualizarEntrada($id);
        header("location:".site_url('c_financeiro/ralatorioMovimentos'));
    }  

    public function excluirsaida($id){
        $this->load->model('m_registro_saidas');
        $this->m_registro_saidas->excluirSaida($id);
        header("location:".site_url('c_financeiro/ralatorioMovimentosSaida'));
    } 

    public function excluirentrada($id){
        $this->load->model('m_registro_entradas');
        $this->m_registro_entradas->excluirEntrada($id);
        header("location:".site_url('c_financeiro/ralatorioMovimentos'));
    }

    public function editarEntrada($id){
        $this->load->model('m_turnos');
        $this->load->model('m_contas');
        $this->load->model('m_categorias');
        $this->load->model('m_registro_entradas');
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $data['contas'] = $this->m_contas->listar();
        $data['categorias'] = $this->m_categorias->buscaEntradas();
        $data['turnos'] = $this->m_turnos->listar();
        $data['entrada'] = $this->m_registro_entradas->buscaEntrada($id);
        $this->load->view('financeiro/editar_entradas',$data);
        $this->load->view('footer/footer');
    }

    public function visualizarEntrada($id){
        $this->load->model('m_turnos');
        $this->load->model('m_contas');
        $this->load->model('m_categorias');
        $this->load->model('m_registro_entradas');
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $data['contas'] = $this->m_contas->listar();
        $data['categorias'] = $this->m_categorias->buscaEntradas();
        $data['turnos'] = $this->m_turnos->listar();
        $data['entrada'] = $this->m_registro_entradas->buscaEntrada($id);
        $this->load->view('financeiro/visualizar_entradas',$data);
        $this->load->view('footer/footer');
    }

    public function gerenciador_financeiro($mes = 0,$ano = 0)
    {
        $this->load->model('m_financeiro');
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $data['entradas'] = $this->m_financeiro->entradas_por_categoria($mes,$ano);
        $data['entradasPorCategoria'] = $this->m_financeiro->entradas_totais_por_categoria($mes,$ano);
        $data['saidas'] = $this->m_financeiro->saidas_por_categoria($mes,$ano);
        $data['saidasPorCategoria'] = $this->m_financeiro->saidas_totais_por_categoria($mes,$ano);
        $this->load->view('financeiro/gerenciador_financeiro',$data);
        $this->load->view('footer/footer');
    } 
    

    public function gerenciador_financeiro_ano($ano = 0)
    {
        $this->load->model('m_registro_entradas');
        $this->load->model('m_registro_saidas');
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        if ($ano == 0){
            $ano = date('Y');
        }
        $data['entradas'] = $this->m_registro_entradas->entradasPorMes($ano);
        $data['saidas'] = $this->m_registro_saidas->saidasPorMes($ano);
        $data['ano'] = $ano;
        $this->load->view('financeiro/gerenciador_financeiro_ano',$data);
        $this->load->view('footer/footer');
    }    

    public function prospecao($ano = 0)
    {
        $this->load->model('m_carnes');
        $this->load->model('m_carnes_empresa');
        $this->load->model('m_registro_entradas');
        $this->load->model('m_registro_saidas');

        $this->load->view('head/head');
        $this->load->view('menu/principal');

        if ($ano == 0){
            $ano = date('Y');
        }
        
        $data['entradas_pr'] = $this->m_carnes->prospecPorMes($ano);
        $data['saidas_pr'] = $this->m_carnes_empresa->prospecPorMes($ano);

        $data['entradas_mv'] = $this->m_registro_entradas->entradasPorMes($ano);
        $data['saidas_mv'] = $this->m_registro_saidas->saidasPorMes($ano);

        $data['ano'] = $ano;
        $this->load->view('financeiro/prospeccao',$data);
        $this->load->view('footer/footer');
    } 

    public function  gerenciador_financeiro_dia($dia=0, $mes = 0,$ano = 0)
    {
        $this->load->model('m_financeiro');
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        if ($mes==0 and $ano==0 and $dia==0){
            $mes=date('m');
            $ano=date('Y');
            $dia=date('d');
        }
        $data['entradas'] = $this->m_financeiro->entradas_por_categoria($mes,$ano,$dia);
        $data['entradasPorCategoria'] = $this->m_financeiro->entradas_totais_por_categoria($mes,$ano,$dia);
        $data['saidas'] = $this->m_financeiro->saidas_por_categoria($mes,$ano,$dia);
        $data['saidasPorCategoria'] = $this->m_financeiro->saidas_totais_por_categoria($mes,$ano,$dia);
        $this->load->view('financeiro/gerenciador_financeiro_dia',$data);
        $this->load->view('footer/footer');
    } 

    public function imprimir_relatorio_dia_entradas()
    {
        $this->load->model('m_registro_entradas');
        $this->load->library('mpdf');
        $this->mpdf->mPDF();
        $dia = $this->input->post('dia');
        $this->mpdf->SetHeader('Infox|Entradas do dia - Por Categoria |{DATE d/m/Y}');

        if (!empty($dia)){
            $this->mpdf->SetFooter('Infox|Entradas dia '.$dia.'|{PAGENO}');
        }else{
            $this->mpdf->SetFooter('Infox|Entradas dia {DATE d/m/Y} |{PAGENO}');
        }   
        $this->mpdf->defaultheaderfontsize=7;
        $this->mpdf->defaultheaderfontstyle='N';
        $this->mpdf->defaultheaderline=1;
        $this->mpdf->defaultfooterfontsize=7;
        $this->mpdf->defaultfooterfontstyle='';
        $this->mpdf->defaultfooterline=1  ;

        if (!empty($dia)){
            $dia = explode('/', $dia);
            $paDia = $dia[0];
            $paMes = $dia[1];
            $paAno = $dia[2];
        }else{
            $paDia = 0;
            $paMes = 0;
            $paAno = 0;
        }
        if ($paDia==0){
            $movimentos = $this->m_registro_entradas->buscaMovimentosDiaPorCategoria();
        }else{
            $movimentos = $this->m_registro_entradas->buscaMovimentosDiaPorCategoria($paDia,$paMes,$paAno);
        }
        $html= "<table width='100%' style='border-collapse: collapse; border: 1px solid #000; font-family: mono; font-size: 7pt;'>";
        $html.= "<tr>";
        $html.= "<th style='border: 1px solid #000;' >Categoria</th>";
        $html.= "<th style='border: 1px solid #000;' >Valor</th>";
        $html.= "</tr>";
        $total = 0;
        foreach ($movimentos as $row) {
            $html.= "<tr>";
            $html.= "<td style='border: 1px solid #000;' >".$row->rcNome."</td>";
            $html.= "<td style='border: 1px solid #000;text-align:right;' >R$ ".$row->valor."</td>";
            $html.= "</tr>";
            $total += $row->valor;
        }
        $html.= "<tr>";
        $html.= "<th style='border: 1px solid #000;text-align:left;' >total:</th>";
        $html.= "<th style='border: 1px solid #000;text-align:right;' >R$ ".number_format($total, 2)."</th>";
        $html.= "</tr>";
        $html.= "</table>";

        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output();      
    }

    public function imprimir_relatorio_mes_entradas()
    {
        $this->load->model('m_registro_entradas');
        $this->load->library('mpdf');
        $this->mpdf->mPDF();
        $dia = $this->input->post('dia');
        $this->mpdf->SetHeader('Infox|Entradas do mês - Por Categoria |{DATE d/m/Y}');

        if (!empty($dia)){
            $dia = explode('/', $dia);
            $dia = $dia[2].'-'.$dia[1].'-'.$dia[0];
            $this->mpdf->SetFooter('Infox|Relatório mês '.date('m/Y',strtotime($dia)).'|{PAGENO}');
        }else{
            $this->mpdf->SetFooter('Infox|Relatório mês {DATE m/Y} |{PAGENO}');
        }   
        $this->mpdf->defaultheaderfontsize=7;
        $this->mpdf->defaultheaderfontstyle='N';
        $this->mpdf->defaultheaderline=1;
        $this->mpdf->defaultfooterfontsize=7;
        $this->mpdf->defaultfooterfontstyle='';
        $this->mpdf->defaultfooterline=1;

        $dia = $this->input->post('dia');
        if (!empty($dia)){
            $dia = explode('/', $dia);
            $paDia = $dia[0];
            $paMes = $dia[1];
            $paAno = $dia[2];
        }else{
            $paDia = 0;
            $paMes = 0;
            $paAno = 0;
        }
        if ($paDia==0){
            $movimentos = $this->m_registro_entradas->buscaMovimentosMesPorCategoria();
        }else{
            $movimentos = $this->m_registro_entradas->buscaMovimentosMesPorCategoria($paMes,$paAno);
        }
        $html= "<table width='100%' style='border-collapse: collapse; border: 1px solid #000; font-family: mono; font-size: 7pt;'>";
        $html.= "<tr>";
        $html.= "<th style='border: 1px solid #000;' >Categoria</th>";
        $html.= "<th style='border: 1px solid #000;' >Valor</th>";
        $html.= "</tr>";
        $total = 0;
        foreach ($movimentos as $row) {
            $html.= "<tr>";
            $html.= "<td style='border: 1px solid #000;' >".$row->rcNome."</td>";
            $html.= "<td style='border: 1px solid #000;text-align:right;' >R$ ".$row->valor."</td>";
            $html.= "</tr>";
            $total += $row->valor;
        }
        $html.= "<tr>";
        $html.= "<th style='border: 1px solid #000;text-align:left;' >total:</th>";
        $html.= "<th style='border: 1px solid #000;text-align:right;' >R$ ".number_format($total, 2)."</th>";
        $html.= "</tr>";
        $html.= "</table>";

        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output();      
    }

    public function imprimir_relatorio_mes_saidas()
    {
        $this->load->model('m_registro_saidas');
        $this->load->library('mpdf');
        $this->mpdf->mPDF();
        $dia = $this->input->post('dia');
        $this->mpdf->SetHeader('Infox|Saidas do mês - Por Categoria |{DATE d/m/Y}');

        if (!empty($dia)){
            $dia = explode('/', $dia);
            $dia = $dia[2].'-'.$dia[1].'-'.$dia[0];
            $this->mpdf->SetFooter('Infox|Saidas mês '.date('m/Y',strtotime($dia)).'|{PAGENO}');
        }else{
            $this->mpdf->SetFooter('Infox|Saidas mês {DATE m/Y} |{PAGENO}');
        }   
        $this->mpdf->defaultheaderfontsize=7;
        $this->mpdf->defaultheaderfontstyle='N';
        $this->mpdf->defaultheaderline=1;
        $this->mpdf->defaultfooterfontsize=7;
        $this->mpdf->defaultfooterfontstyle='';
        $this->mpdf->defaultfooterline=1;

        $dia = $this->input->post('dia');
        if (!empty($dia)){
            $dia = explode('/', $dia);
            $paDia = $dia[0];
            $paMes = $dia[1];
            $paAno = $dia[2];
        }else{
            $paDia = 0;
            $paMes = 0;
            $paAno = 0;
        }
        if ($paDia==0){
            $movimentos = $this->m_registro_saidas->buscaMovimentosMesPorCategoria();
        }else{
            $movimentos = $this->m_registro_saidas->buscaMovimentosMesPorCategoria($paMes,$paAno);
        }
        $html= "<table width='100%' style='border-collapse: collapse; border: 1px solid #000; font-family: mono; font-size: 7pt;'>";
        $html.= "<tr>";
        $html.= "<th style='border: 1px solid #000;' >Categoria</th>";
        $html.= "<th style='border: 1px solid #000;' >Valor</th>";
        $html.= "</tr>";
        $total = 0;
        foreach ($movimentos as $row) {
            $html.= "<tr>";
            $html.= "<td style='border: 1px solid #000;' >".$row->rcNome."</td>";
            $html.= "<td style='border: 1px solid #000;text-align:right;' >R$ ".$row->valor."</td>";
            $html.= "</tr>";
            $total += $row->valor;
        }
        $html.= "<tr>";
        $html.= "<th style='border: 1px solid #000;text-align:left;' >total:</th>";
        $html.= "<th style='border: 1px solid #000;text-align:right;' >R$ ".number_format($total, 2)."</th>";
        $html.= "</tr>";
        $html.= "</table>";

        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output();      
    }

    public function imprimir_relatorio_dia_saidas()
    {
        $this->load->model('m_registro_saidas');
        $this->load->library('mpdf');
        $this->mpdf->mPDF();
        $dia = $this->input->post('dia');
        $this->mpdf->SetHeader('Infox|Saidas do dia - Por Categoria |{DATE d/m/Y}');

        if (!empty($dia)){
            $this->mpdf->SetFooter('Infox|Relatório dia '.$dia.'|{PAGENO}');
        }else{
            $this->mpdf->SetFooter('Infox|Relatório dia {DATE d/m/Y} |{PAGENO}');
        }   
        $this->mpdf->defaultheaderfontsize=7;
        $this->mpdf->defaultheaderfontstyle='N';
        $this->mpdf->defaultheaderline=1;
        $this->mpdf->defaultfooterfontsize=7;
        $this->mpdf->defaultfooterfontstyle='';
        $this->mpdf->defaultfooterline=1  ;

        if (!empty($dia)){
            $dia = explode('/', $dia);
            $paDia = $dia[0];
            $paMes = $dia[1];
            $paAno = $dia[2];
        }else{
            $paDia = 0;
            $paMes = 0;
            $paAno = 0;
        }
        if ($paDia==0){
            $movimentos = $this->m_registro_saidas->buscaMovimentosDiaPorCategoria();
        }else{
            $movimentos = $this->m_registro_saidas->buscaMovimentosDiaPorCategoria($paDia,$paMes,$paAno);
        }
        $html= "<table width='100%' style='border-collapse: collapse; border: 1px solid #000; font-family: mono; font-size: 7pt;'>";
        $html.= "<tr>";
        $html.= "<th style='border: 1px solid #000;' >Categoria</th>";
        $html.= "<th style='border: 1px solid #000;' >Valor</th>";
        $html.= "</tr>";
        $total = 0;
        foreach ($movimentos as $row) {
            $html.= "<tr>";
            $html.= "<td style='border: 1px solid #000;' >".$row->rcNome."</td>";
            $html.= "<td style='border: 1px solid #000;text-align:right;' >R$ ".$row->valor."</td>";
            $html.= "</tr>";
            $total += $row->valor;
        }
        $html.= "<tr>";
        $html.= "<th style='border: 1px solid #000;text-align:left;' >total:</th>";
        $html.= "<th style='border: 1px solid #000;text-align:right;' >R$ ".number_format($total, 2)."</th>";
        $html.= "</tr>";
        $html.= "</table>";

        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output();      
    }  
    public function resumoDeContasMes($mes = 0,$ano = 0){
        $this->load->model('m_financeiro');
        $this->load->view('head/head');
        $this->load->view('menu/principal');
        $data['resumo'] = $this->m_financeiro->resumoPorConta($mes,$ano);
        $this->load->view('financeiro/MovimentosContasMes',$data);
        $this->load->view('footer/footer'); 
    }

    public function imprimir_relatorio_geral($mes = 0,$ano = 0)
    {
        $this->load->model('m_financeiro');
        $data['entradasPorCategoria'] = $this->m_financeiro->entradas_totais_por_categoria($mes,$ano);
        $data['saidasPorCategoria'] = $this->m_financeiro->saidas_totais_por_categoria($mes,$ano);
        $data['resumo'] = $this->m_financeiro->resumoPorConta($mes,$ano);
        $this->load->library('mpdf');
        $this->mpdf->mPDF();
        $this->mpdf->SetHeader('Infox|Relatorio Geral|{DATE d/m/Y}');

        if (!empty($mes)){
            $this->mpdf->SetFooter('Infox|Relatório '.$mes.'/'.$ano.'|{PAGENO}');
        }else{
            $this->mpdf->SetFooter('Infox|Relatório {DATE m/Y} |{PAGENO}');
        }   
        $this->mpdf->defaultheaderfontsize=7;
        $this->mpdf->defaultheaderfontstyle='N';
        $this->mpdf->defaultheaderline=1;
        $this->mpdf->defaultfooterfontsize=7;
        $this->mpdf->defaultfooterfontstyle='';
        $this->mpdf->defaultfooterline=1  ;

        $html='<h3>Entradas</h3>';
        $html.= "<table width='100%' style='border-collapse: collapse; border: 1px solid #000; font-family: mono; font-size: 7pt;'>";
        $html.= "<tr>";
        $html.= "<th style='border: 1px solid #000;' >Categoria</th>";
        $html.= "<th style='border: 1px solid #000;' >Valor</th>";
        $html.= "</tr>";
        $total = 0;
        foreach ($data['entradasPorCategoria'] as $row) {
            $html.= "<tr>";
            $html.= "<td style='border: 1px solid #000;' >".$row->rcNome."</td>";
            $html.= "<td style='border: 1px solid #000;text-align:right;' >R$ ".number_format($row->valor,2,',','.')."</td>";
            $html.= "</tr>";
            $total += $row->valor;
        }
        $html.= "<tr>";
        $html.= "<th style='border: 1px solid #000;text-align:left;' >total:</th>";
        $html.= "<th style='border: 1px solid #000;text-align:right;' >R$ ".number_format($total, 2)."</th>";
        $html.= "</tr>";
        $html.= "</table>"; 

        $html.='<h3>Saidas</h3>';
        $html.= "<table width='100%' style='border-collapse: collapse; border: 1px solid #000; font-family: mono; font-size: 7pt;'>";
        $html.= "<tr>";
        $html.= "<th style='border: 1px solid #000;' >Categoria</th>";
        $html.= "<th style='border: 1px solid #000;' >Valor</th>";
        $html.= "</tr>";
        $total = 0;
        foreach ($data['saidasPorCategoria'] as $row) {
            $html.= "<tr>";
            $html.= "<td style='border: 1px solid #000;' >".$row->rcNome."</td>";
            $html.= "<td style='border: 1px solid #000;text-align:right;' >R$ ".number_format($row->valor,2,',','.')."</td>";
            $html.= "</tr>";
            $total += $row->valor;
        }
        $html.= "<tr>";
        $html.= "<th style='border: 1px solid #000;text-align:left;' >total:</th>";
        $html.= "<th style='border: 1px solid #000;text-align:right;' >R$ ".number_format($total, 2)."</th>";
        $html.= "</tr>";
        $html.= "</table>";

        $html.='<h3>Resumo Por Conta</h3>';
        $html.= "<table width='100%' style='border-collapse: collapse; border: 1px solid #000; font-family: mono; font-size: 7pt;'>";
        $html.= "<tr>";
        $html.= "<th style='border: 1px solid #000;' >Conta</th>";
        $html.= "<th style='border: 1px solid #000;' >Entradas</th>";
        $html.= "<th style='border: 1px solid #000;' >Saidas</th>";
        $html.= "<th style='border: 1px solid #000;' >Diferença</th>";
        $html.= "</tr>";
        $total = 0;
        foreach ($data['resumo'] as $row) {
            $html.= "<tr>";
            $html.= "<td style='border: 1px solid #000;'>".$row->conNome."</td>";
            $html.= "<td style='border: 1px solid #000;text-align:right;'>R$ ".number_format($row->entradas,2,',','.')."</td>";
            $html.= "<td style='border: 1px solid #000;text-align:right;'>R$ ".number_format($row->saidas,2,',','.')."</td>";
            $html.= "<td style='border: 1px solid #000;text-align:right;'>R$ ".number_format($row->entradas - $row->saidas,2,',','.')."</td>";
            $html.= "</tr>";
            $total += $row->valor;
        }
        $html.= "<tr>";
        $html.= "</tr>";
        $html.= "</table>";

        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output();  
    }
}
