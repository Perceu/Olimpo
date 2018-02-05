<?php

class m_instrutor extends CI_Model {
    
    public function salvar($id){
        $this->load->database();
        $insert = array('insNome' => $this->input->post('nome'));

        $config['upload_path'] = './public/img/assinaturas/';
        $config['allowed_types'] = 'svg';
        $this->load->library('upload', $config);
        $this->upload->set_allowed_types('*');
        if ($this->upload->do_upload('assinatura')){
            $data = array('upload_data' => $this->upload->data());
            $insert['insAssinatura'] = $data["upload_data"]["file_name"];
        }else{
            echo '<pre>';echo die(var_dump($this->upload->display_errors()));
        }

        
        if($this->db->update('instrutores',$insert,array('insId'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }
    public function excluir($id){
        $this->load->database();
        if($this->db->delete('instrutores',array('insId'=>$id))){
            return true;    
        }else{
            return false;    
        }
    }
    public function gravar(){
        $this->load->database();

        $insert = array('insNome' => $this->input->post('nome'));
        
        $config['upload_path'] = './public/img/assinaturas/';
        $config['allowed_types'] = 'png|svg|jpg';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('assinatura')){
            $data = array('upload_data' => $this->upload->data());
            $insert['insAssinatura'] = $data["upload_data"]["file_name"];
        }

        if($this->db->insert('instrutores',$insert)){
            return true;    
        }else{
            return false;    
        }
    }
    
    public function listar(){
        $this->load->database();
        $return = $this->db->get('instrutores');
        return $return->result();
    }
    
    public function buscar($id){
        $this->load->database();
        $return  = $this->db->get_where('instrutores',array('insId'=>$id));
        return $return->result();
    }
  
}
?>