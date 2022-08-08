<?php

class GruposModel extends CI_Model{

    public function GetByIdCurso($idCurso){
        $this->db->select("
                        grupo.Id 			    AS grupo_id,
                        grupo.IdCurso           AS grupo_id_curso,
                        grupo.IdHorario         AS grupo_id_horario,
                        grupo.Cupo              AS grupo_cupo,
                        grupo.Descripcion       AS grupo_descripcion,
                        grupo.IdGrupoThinkific  AS grupo_id_thinkific");

        $this->db->from("grupos AS grupo");
        $this->db->where("grupo.IdCurso", $idCurso);

        return $this->db->get()->row_array();
    }

}