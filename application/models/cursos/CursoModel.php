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

    public function GetTotalPorcentajeByIdCurso($curso){
        $sqlProcedure = "CALL `sp_obtener_total_by_curso`($curso)";
        $query_result = $this->db->query($sqlProcedure);
        $result = $query_result->row_array();
        $query_result->next_result();
        $query_result->free_result();

        return $result;
    }

    public function GetTotalAvancesByIdCurso($curso){
        $sqlProcedure = "CALL `sp_obtener_avances_by_curso`($curso)";
        $query_result = $this->db->query($sqlProcedure);
        $result = $query_result->row_array();
        $query_result->next_result();
        $query_result->free_result();

        return $result;
    }

    public function GetTotalProgressBar(){
        $sqlProcedure = "CALL `sp_avance_todos_cursos`()";
        $query_result = $this->db->query($sqlProcedure);
        $result = $query_result->result_array();
        $query_result->next_result();
        $query_result->free_result();

        return $result;
    }
}
