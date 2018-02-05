<?php

class c_aniversariantes extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        if (!isset($this->session->userdata['Ativo'])) {
            header('location: '.site_url());
        }
    }

    public function imprimir()
	{

            $this->load->library('mpdf');
            $this->load->model("m_alunos");
            $aniversariantes = $this->m_alunos->buscaAniversariantes();
            $this->mpdf->mPDF('utf-8', 'A4-P', 0, '', 2, 2, 2, 2, 0, 0, 'P');
            $this->mpdf->AddPage('utf-8', 'A4-P', 0, '', 2, 2, 2, 2, 0, 0, 'P');
            
            $html = "<table style='border: 1px solid #fff; font-family: robo; width:100%'>";
            $html .= "<thead>";
            $html .= "<tr>";
            $html .= "<th>data</th>";
            $html .= "<th>aluno</th>";
            $html .= "</tr>";
            $html .= "</thead>";
            $html .= "<tbody>";
            $ano = date('Y');
            foreach ($aniversariantes as $alunos) {
                $html .= "<tr>";
                $html .= "<td>".date("d",strtotime($alunos->aluNascimento))."</td>";
                $html .= "<td>$alunos->aluNome</td>";
                $html .= "</tr>" ;
            }
            $html .= "</tbody>";
            $html .= "</table>";

            $this->mpdf->showImageErrors = true;
            $this->mpdf->WriteHTML($html);
            $this->mpdf->Output('aniversariantes.pdf','D');
        }
}
