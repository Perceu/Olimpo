<?php

class m_financeiro extends CI_Model {
    
    public function entradas_por_categoria($mes = 0,$ano = 0, $dia = 0){
        $this->load->database();
        if ($mes==0 and $ano==0 and $dia==0){
            $sql = "SELECT rcid, rcNome, sum(reValor) as valor,conNome, turNome FROM registroentradas 
                    inner join registrocategorias on registrocategorias.rcId = registroentradas.reCategoria
                    inner join contas on registroentradas.conId = contas.conId
                    inner join turnos on registroentradas.turId = turnos.turId
                    WHERE contas.conMostraResumo <> 0 AND date_format(reData,'%Y%m') = date_format(now(),'%Y%m')
                    group by registroentradas.reCategoria,registroentradas.conId,turnos.turId";
        }else{
            $sql = "SELECT rcid, rcNome, sum(reValor) as valor,conNome,turNome FROM registroentradas 
                inner join registrocategorias on registrocategorias.rcId = registroentradas.reCategoria
                inner join contas on registroentradas.conId = contas.conId
                inner join turnos on registroentradas.turId = turnos.turId";
                if ($dia==0){
                    $sql .=" WHERE contas.conMostraResumo <> 0 AND date_format(reData,'%Y%m') = $ano$mes";
                }else{
                    $sql .=" WHERE contas.conMostraResumo <> 0 AND date_format(reData,'%Y%m%d') = $ano$mes$dia ";
                }
                $sql .=" group by registroentradas.reCategoria,registroentradas.conId,turnos.turId";
        }
        $return = $this->db->query($sql);
        return $return->result();
    }    


    public function entradas_totais_por_categoria($mes = 0,$ano = 0, $dia = 0){
        $this->load->database();
        if ($mes==0 and $ano==0 and $dia==0){
            $sql = "SELECT rcid, rcNome, sum(reValor) as valor FROM registroentradas 
                    inner join registrocategorias on registrocategorias.rcId = registroentradas.reCategoria
                    inner join contas on registroentradas.conId = contas.conId                   
                    WHERE contas.conMostraResumo <> 0 AND date_format(reData,'%Y%m') = date_format(now(),'%Y%m')
                    group by registroentradas.reCategoria";
        }else{
            $sql = "SELECT rcid, rcNome, sum(reValor) as valor FROM registroentradas 
                inner join contas on registroentradas.conId = contas.conId
                inner join registrocategorias on registrocategorias.rcId = registroentradas.reCategoria";
                if ($dia==0){
                    $sql .=" WHERE contas.conMostraResumo <> 0 AND date_format(reData,'%Y%m') = $ano$mes";
                }else{
                    $sql .=" WHERE contas.conMostraResumo <> 0 AND date_format(reData,'%Y%m%d') = $ano$mes$dia";
                }
                $sql .=" group by registroentradas.reCategoria";
        }
        $return = $this->db->query($sql);
        return $return->result();
    }    

    public function saidas_totais_por_categoria($mes = 0,$ano = 0, $dia = 0){
        if ($mes==0 and $ano==0 and $dia==0){
            $sql = "SELECT rcid, rcNome, sum(rsValor) as valor, conNome FROM registrosaidas 
                    inner join registrocategorias on registrocategorias.rcId = registrosaidas.rsCategoria
                    inner join contas on registrosaidas.conId = contas.conId                    
                    WHERE contas.conMostraResumo <> 0 AND date_format(rsData,'%Y%m') = date_format(now(),'%Y%m')
                    group by registrosaidas.rsCategoria";
        }else{
            $sql = "SELECT rcid, rcNome, sum(rsValor) as valor, conNome FROM registrosaidas 
                inner join registrocategorias on registrocategorias.rcId = registrosaidas.rsCategoria
                inner join contas on registrosaidas.conId = contas.conId";
                if ($dia==0){
                    $sql .=" WHERE contas.conMostraResumo <> 0 AND date_format(rsData,'%Y%m') = $ano$mes";
                }else{
                    $sql .=" WHERE contas.conMostraResumo <> 0 AND date_format(rsData,'%Y%m%d') = $ano$mes$dia";
                }
                $sql .=" group by registrosaidas.rsCategoria";
        }
        $return = $this->db->query($sql);
        return $return->result();
    }
    
    public function saidas_por_categoria($mes = 0,$ano = 0, $dia = 0){
        if ($mes==0 and $ano==0 and $dia==0){
            $sql = "SELECT rcid, rcNome, sum(rsValor) as valor,conNome, turNome FROM registrosaidas 
                    inner join registrocategorias on registrocategorias.rcId = registrosaidas.rsCategoria
                    inner join contas on registrosaidas.conId = contas.conId
                    inner join turnos on registrosaidas.turId = turnos.turId                    
                    WHERE contas.conMostraResumo <> 0 AND date_format(rsData,'%Y%m') = date_format(now(),'%Y%m')
                    group by registrosaidas.rsCategoria,registrosaidas.conId";
        }else{
            $sql = "SELECT rcid, rcNome, sum(rsValor) as valor,conNome, turNome FROM registrosaidas 
                inner join registrocategorias on registrocategorias.rcId = registrosaidas.rsCategoria
                inner join contas on registrosaidas.conId = contas.conId
                inner join turnos on registrosaidas.turId = turnos.turId";
                if ($dia==0){
                    $sql .=" WHERE contas.conMostraResumo != 0 AND date_format(rsData,'%Y%m') = $ano$mes";
                }else{
                    $sql .=" WHERE contas.conMostraResumo != 0 AND date_format(rsData,'%Y%m%d') = $ano$mes$dia";
                }
                $sql .=" group by registrosaidas.rsCategoria,registrosaidas.conId,turnos.turId";
        }
        $return = $this->db->query($sql);
        return $return->result();
    }

    public function resumoPorConta($mes = 0,$ano = 0){
        if ($mes==0 and $ano==0){
            $sql = "SELECT conNome,
                    (select sum(reValor) 
                     from registroentradas 
                     where 
                     conId = c.conId 
                     AND date_format(reData,'%Y%m')=date_format(now(),'%Y%m')
                     ) as entradas,
                    (select sum(rsValor) 
                     from registrosaidas 
                     where 
                     conId = c.conId 
                     AND date_format(rsData,'%Y%m')=date_format(now(),'%Y%m')
                     ) as saidas
                 FROM Infox.contas as c;";
        }else{
            $sql = "SELECT conNome,
                    (select sum(reValor) 
                     from registroentradas 
                     where 
                     conId = c.conId 
                     AND date_format(reData,'%Y%m')=$ano$mes
                     ) as entradas,
                    (select sum(rsValor) 
                     from registrosaidas 
                     where 
                     conId = c.conId 
                     AND date_format(rsData,'%Y%m')=$ano$mes
                     ) as saidas
                 FROM Infox.contas as c;";
        }
        $return = $this->db->query($sql);
        return $return->result();
    }   

}
?>