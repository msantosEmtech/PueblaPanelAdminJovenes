<?php

class CursoModel extends CI_Model{

    public function GetCursos(){
        $condicional = array('Estatus' => '1');
        $this->db->select('Id, Descripcion, Estatus, IdThinkific');
        $this->db->from('cursos');
        $this->db->where($condicional);
        return $this->db->get()->result_array();
    }
    
    public function GetIdByNombre($curso){
        $condicional = array('Descripcion' => $curso);
        $this->db->select('Id');
        $this->db->from('cursos');
        $this->db->where($condicional);
        return $this->db->get()->row_array();
    }
}
