<?php
class m_carnes extends CI_Model {
    

    public function maiorCarne(){
        $this->load->database();
        $this->db->select_max('carNum');
        $carnes =  $this->db->get('alunos_carnes');
        return $carnes->result();
    }    

    public function geraParcela($parcela){
        $this->load->database();
        $insert = array(
            'carNum' => $parcela['carNum'],
            'carParcela' => $parcela['carParcela'],
            'aluId' => $parcela['aluId'],
            'curId' => $parcela['curId'],
            'carVencimento' => $parcela['carVencimento'],
            'carValor' => str_replace(',', '.', $parcela['carValor']),
            'carValorVencido' => $parcela['carValorVencido']
        );
        if($this->db->insert('alunos_carnes',$insert)){
            return true;    
        }else{
            return false;    
        }
    }

    public function listCarnes(){
        $this->load->database();
        $sql = "SELECT 
                    carNum,
                    aluNome,
                    aluMatricula,
                    curNome,
                    carInativo,
                    (select sum(carValor) from alunos_carnes where carPago = 0 and carNum = c.carNum)as aindaReceber, 
                    sum(carPago) as pagos,
                    count(CarParcela)as parcelas 
                FROM alunos_carnes as c
                    inner join alunos on c.aluId = alunos.aluid
                    inner join cursos on c.curId = cursos.curId
                group by carNum,alunos.aluid,cursos.curId,carInativo;";
        $result = $this->db->query($sql);
        return $result->result();
    }    

    public function salvarParcela($id){
        $this->load->database();
        $insert = array(
            'carValor' => number_format($this->input->post('carValor'),2,'.',','),
            'carVencimento' => implode("-", array_reverse(explode("-", str_replace("/","-",$this->input->post('carVencimento'))))),
            'carParcela' => $this->input->post('carParcela'),
            'carValorVencido' => number_format($this->input->post('carValorVencido'),2,'.',','),
        );
        
        if($this->db->update('alunos_carnes',$insert,array('carId'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }

    public function gravarParcela($carNum){
        $this->load->database();
        $query = "select max(carParcela) as parcela from alunos_carnes where carNum = ".$carNum;

        $max = $this->db->query($query);
        $max = $max->result();

        $numero = $max[0]->parcela;
        $numero +=1;
        $parcela = $this->input->post('carParcela');
        $vet = explode("/",$this->input->post('carVencimento'));
        $vencimento = new DateTime($vet[2].'-'.$vet[1].'-'.$vet[0]); 
        $total = $numero+$parcela;
        while ($numero <= $total) {
            $insert = array(
                'carNum' => $carNum,
                'carParcela' => $numero,
                'curId' => $this->input->post('curId'),
                'aluId' => $this->input->post('aluId'),
                'carVencimento' => date_format($vencimento,'Y-m-d'),
                'carValor' => str_replace(',', '.', $this->input->post('carValor')),
            );
			if (!empty($this->input->post('carValorVencido'))){
			       $insert['carValorVencido'] = str_replace(',', '.', $this->input->post('carValorVencido'));
			}
            $this->db->insert('alunos_carnes',$insert);
            $numero +=1;
            $vencimento = date_add($vencimento, date_interval_create_from_date_string('1 month'));
        }
        return true;
    }
    public function excluirParcela($id){
        $this->load->database();
        if($this->db->delete('alunos_carnes',array('carId'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }

    public function excluirParcelas(){
        $this->load->database();
        $parcelas = $this->input->post('parcelas');
        var_dump($parcelas);
        foreach ($parcelas as $key) {
            $this->excluirParcela($key);
        }
    }   
    public function excluiCarne($id){
        $this->load->database();
        if($this->db->delete('alunos_carnes',array('carNum'=>$id,'carPago'=>0))){
            return true;    
        }else{
            return false;    
        }
    }   
    public function inativarCarne($id){
        $this->load->database();
        $data = array(
            'carInativo' => True,
        );
        $this->db->where('carNum', $id);
        if($this->db->update('alunos_carnes',$data)){
            return true;    
        }else{
            return false;    
        }
    }   
    
    public function ativarCarne($id){
        $this->load->database();
        $data = array(
            'carInativo' => False,
        );
        $this->db->where('carNum', $id);
        if($this->db->update('alunos_carnes',$data)){
            return true;    
        }else{
            return false;    
        }
    }
    public function buscaCarnes($carne){
        $this->load->database();
        $sql = "SELECT 
                    *
                FROM alunos_carnes 
                    inner join alunos on alunos_carnes.aluId = alunos.aluid
                    inner join cursos on alunos_carnes.curId = cursos.curId
                where carNum = $carne;";
        $result = $this->db->query($sql);
        return $result->result();
    }    

    public function buscarParcela($carId){
        $this->load->database();
        $sql = "SELECT 
                    *
                FROM alunos_carnes 
                    inner join alunos on alunos_carnes.aluId = alunos.aluid
                    inner join cursos on alunos_carnes.curId = cursos.curId
                where carId = ".$carId;
        $result = $this->db->query($sql);
        return $result->result();
    }
    public function buscaVencidos(){
        $this->load->database();
        $sql = "SELECT 
                    *
                FROM alunos_carnes 
                    inner join alunos on alunos_carnes.aluId = alunos.aluid
                    inner join cursos on alunos_carnes.curId = cursos.curId
                where carVencimento <= CURDATE() and carPago = 0 and carInativo = 0
                order by carVencimento ASC";
        $result = $this->db->query($sql);
        return $result->result();
    }

    
    public function pagaParcela($carId,$parcelaId){
        $this->load->database();
        $sql = "UPDATE  alunos_carnes SET carPago = 1, reId = $parcelaId where carId = $carId;";
        $result = $this->db->query($sql);
        return true;
    }

    public function prospecPorMes($ano){
        $query = "SELECT 
                    date_format(carVencimento,'%m%Y') as carVencimento,
                    sum(carValor)  as carValor
                  FROM 
                    alunos_carnes 
                  WHERE date_format(carVencimento,'%Y') = '$ano'
                  GROUP BY date_format(carVencimento,'%m%Y');";
        $return = $this->db->query($query);
        return $return->result();
    }
}
?>

