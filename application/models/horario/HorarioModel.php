<?php

class HorarioModel extends CI_Model{

    public function GetListaByCurso($idCurso){
        $sqlProcedure = "CALL `sp_obtener_lista_horarios_por_grupo_curso`($idCurso)";
        $query_result = $this->db->query($sqlProcedure);
        $result = $query_result->result_array();
        $query_result->next_result();
        $query_result->free_result();

        return $result;
    }
}
