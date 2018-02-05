<?php
class m_carnes_empresa extends CI_Model {
    

    public function maiorCarne(){
        $this->load->database();
        $this->db->select_max('ecNum');
        $carnes =  $this->db->get('empresas_carnes');
        return $carnes->result();
    }    

    public function geraParcela($parcela){
        $this->load->database();
        $insert = array(
            'ecNum' => $parcela['ecNum'],
            'ecParcela' => $parcela['ecParcela'],
            'ecDescricao' => $parcela['ecDescricao'],
            'empId' => $parcela['empId'],
            'ecVencimento' => $parcela['ecVencimento'],
            'ecValor' => str_replace(',', '.', $parcela['ecValor']),
            'ecValorVencido' => $parcela['ecValorVencido']
        );
        if($this->db->insert('empresas_carnes',$insert)){
            return true;    
        }else{
            return false;    
        }
    }

    public function listCarnes(){
        $this->load->database();
        $sql = "SELECT 
                    ecNum,
                    empNome,
                    ecDescricao,
                    (select sum(ecValor) from empresas_carnes where ecPago = 0 and ecNum = c.ecNum)as aindaReceber, 
                    sum(ecPago) as pagos,
                    count(ecParcela)as parcelas 
                FROM empresas_carnes as c
                    inner join empresas on c.empId = empresas.empid
                group by ecNum;";
        $result = $this->db->query($sql);
        return $result->result();
    }    

    public function salvarParcela($id){
        $this->load->database();
        $insert = array(
            'ecValor' => preg_replace(',', '.', $this->input->post('ecValor')),
            'ecVencimento' => implode("-", array_reverse(explode("-", str_replace("/","-",$this->input->post('ecVencimento'))))),
            'ecParcela' => $this->input->post('ecParcela'),
            'ecValorVencido' => preg_replace(',', '.', $this->input->post('ecValorVencido')),
        );
        
        if($this->db->update('empresas_carnes',$insert,array('ecId'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }

    public function gravarParcela($ecNum){
        $this->load->database();
        $query = "select max(ecParcela) as parcela from empresas_carnes where ecNum = ".$ecNum;

        $max = $this->db->query($query);
        $max = $max->result();

        $numero = $max[0]->parcela;
        $numero +=1;
        $parcela = $this->input->post('ecParcela');
        $vet = explode("/",$this->input->post('ecVencimento'));
        $vencimento = new DateTime($vet[2].'-'.$vet[1].'-'.$vet[0]); 
        $total = $numero+$parcela;
        while ($numero <= $total) {
            $insert = array(
                'ecNum' => $carNum,
                'ecParcela' => $numero,
                'ecId' => $this->input->post('ecId'),
                'ecVencimento' => date_format($vencimento,'Y-m-d'),
                'ecValor' => str_replace(',', '.', $this->input->post('ecValor')),
                'ecValorVencido' => str_replace(',', '.', $this->input->post('ecValorVencido')),
            );
            $this->db->insert('empresas_carnes',$insert);
            $numero +=1;
            $vencimento = date_add($vencimento, date_interval_create_from_date_string('1 month'));
        }
        return true;
    }
    public function excluirParcela($id){
        $this->load->database();
        if($this->db->delete('empresas_carnes',array('carId'=>$id))){
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
        if($this->db->delete('empresas_carnes',array('ecNum'=>$id,'ecPago'=>0))){
            return true;    
        }else{
            return false;    
        }
    }
    public function buscaCarnes($carne){
        $this->load->database();
        $sql = "SELECT 
                    *
                FROM empresas_carnes 
                inner join empresas on empresas_carnes.empId = empresas.empid
                where ecNum = $carne;";
        $result = $this->db->query($sql);
        return $result->result();
    }    

    public function buscarParcela($carId){
        $this->load->database();
        $sql = "SELECT 
                    *
                FROM empresas_carnes 
                inner join empresas on empresas_carnes.empId = empresas.empid
                where ecId = ".$carId;
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function buscaVencidos(){
        $this->load->database();
        $sql = "SELECT 
                    *
                FROM empresas_carnes 
                inner join empresas on empresas_carnes.empId = empresas.empid
                where ecVencimento <= DATE_ADD(CURDATE(), INTERVAL 7 DAY) and ecPago = 0";
        $result = $this->db->query($sql);
        return $result->result();
    }

    
    public function pagaParcela($carId,$parcelaId){
        $this->load->database();
        $sql = "UPDATE  empresas_carnes SET ecPago = 1, rsId = $parcelaId where ecId = $carId;";
        $result = $this->db->query($sql);
        return true;
    }

    public function prospecPorMes($ano){
        $query = "SELECT 
                    date_format(ecVencimento,'%M') as ecVencimento,
                    sum(ecValor)  as ecValor
                  FROM 
                    empresas_carnes 
                  WHERE date_format(ecVencimento,'%Y') = '$ano'
                  GROUP BY date_format(ecVencimento,'%m%Y');";
        $return = $this->db->query($query);
        return $return->result();
    }

}
?>

