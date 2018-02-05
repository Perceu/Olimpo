<?php

class m_alunos extends CI_Model {
    
    public function salvar($id){
        $this->load->database();
        $insert = array(
            'aluNome' => $this->input->post('nome'),
            'aluMatricula' => $this->input->post('matricula'),
            'aluNascimento' => implode("-", array_reverse(explode("-", str_replace("/","-",$this->input->post('nascimento'))))),
            'aluTelefone1' => $this->input->post('telefone1'),
            'aluTelefone2' => $this->input->post('telefone2'),
        );
        
        if($this->db->update('alunos',$insert,array('aluid'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }
    public function gravar(){
        $this->load->database();
        $insert = array(
            'aluNome' => $this->input->post('nome'),
            'aluMatricula' => $this->input->post('matricula'),
            'aluNascimento' => implode("-", array_reverse(explode("-", str_replace("/","-",$this->input->post('nascimento'))))),
            'aluTelefone1' => $this->input->post('telefone1'),
            'aluTelefone2' => $this->input->post('telefone2'),
        );
        if($this->db->insert('alunos',$insert)){
            return true;    
        }else{
            return false;    
        }
    }
    public function listar(){
        $this->load->database();
        $return =  $this->db->get('alunos');
        return $return->result();
    }
    
    public function Buscar($id){
        $this->load->database();
        $return  = $this->db->get_where('alunos',array('aluid'=>$id));
        return $return->result();
    }

    public function buscaAniversariantes(){
        $this->load->database();
        $sql = "SELECT * FROM alunos WHERE date_format(aluNascimento,'%c') = date_format(now(),'%c')";
        $return = $this->db->query($sql);
        return $return->result();
    }
    
    public function excluir($id){
        $this->load->database();
        if($this->db->delete('alunos',array('aluid'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }
    
}
?>