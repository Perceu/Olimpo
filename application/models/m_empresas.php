<?php

class m_empresas extends CI_Model {
    
    public function salvar($id){
        $this->load->database();
        $insert = array(
            'empNome' => $this->input->post('nome'),
            'empTelefone1' => $this->input->post('telefone1'),
            'empTelefone2' => $this->input->post('telefone2'),
        );
        
        if($this->db->update('empresas',$insert,array('empid'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }
    public function gravar(){
        $this->load->database();
        $insert = array(
            'empNome' => $this->input->post('nome'),
            'empTelefone1' => $this->input->post('telefone1'),
            'empTelefone2' => $this->input->post('telefone2'),
        );
        if($this->db->insert('empresas',$insert)){
            return true;    
        }else{
            return false;    
        }
    }
    public function listar(){
        $this->load->database();
        $return =  $this->db->get('empresas');
        return $return->result();
    }
    
    public function Buscar($id){
        $this->load->database();
        $return  = $this->db->get_where('empresas',array('empid'=>$id));
        return $return->result();
    }
    
    public function excluir($id){
        $this->load->database();
        if($this->db->delete('empresas',array('empid'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }
    
}
?>