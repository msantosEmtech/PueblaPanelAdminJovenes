<?php

class AlumnoModel extends CI_Model{

    public function GetHistorialByCurso($curso, $start, $length, $search, $columna, $direccion, $estatusInscritos){
        $srch = "";
        $ord = "";
        $curs = "";

        if($curso == "" || $curso == 0 || $curso == null){
            $curs = "";
        }else{
            $curs = "curso_id = ".$curso;
        }
        
        if($search){
            if($curso == "" || $curso == 0 || $curso == null){
                if($estatusInscritos == -1){
                    $srch = " WHERE (participante_nombre LIKE '%".$search."%' OR 
                    participante_apellido_paterno LIKE '%".$search."%' OR 
                    participante_apellido_materno LIKE '%".$search."%') AND resultado_estatus_inscripcion IS NULL ";
                }else{
                    $srch = " WHERE (participante_nombre LIKE '%".$search."%' OR 
                    participante_apellido_paterno LIKE '%".$search."%' OR 
                    participante_apellido_materno LIKE '%".$search."%') AND resultado_estatus_inscripcion = ".$estatusInscritos. " ";
                }
                
            }else{
                if($estatusInscritos == -1){
                    $srch = " WHERE (participante_nombre LIKE '%".$search."%' OR 
                    participante_apellido_paterno LIKE '%".$search."%' OR 
                    participante_apellido_materno LIKE '%".$search."%') AND resultado_estatus_inscripcion IS NULL AND ".$curs;
                }else{
                    $srch = " WHERE (participante_nombre LIKE '%".$search."%' OR 
                    participante_apellido_paterno LIKE '%".$search."%' OR 
                    participante_apellido_materno LIKE '%".$search."%') AND resultado_estatus_inscripcion = ".$estatusInscritos." AND ".$curs;
                }
                
            }
            
        }else{
            if($curso == "" || $curso == 0 || $curso == null){
                if($estatusInscritos == -1){
                    $srch = "WHERE resultado_estatus_inscripcion IS NULL";
                }else{
                    $srch = "WHERE resultado_estatus_inscripcion = ".$estatusInscritos;
                }
                
            }else{
                if($estatusInscritos == -1){
                    $srch = "WHERE ".$curs. " AND resultado_estatus_inscripcion IS NULL";
                }else{
                    $srch = "WHERE ".$curs. " AND resultado_estatus_inscripcion = ".$estatusInscritos;
                }
            }
        }

        if($columna){
            $columnaNombre = "";
            switch ($columna) {
                case 1:
                    $columnaNombre = "participante_nombre";
                    break;
                case 12:
                    $columnaNombre = "resultado_resultado";
                    break;
                case 14:
                    $columnaNombre = "curso_descripcion";
                    break;
                default:
                    $columnaNombre = "participante_id";
                    break;
            }

            $ord = " ORDER BY ".$columnaNombre." ".$direccion;
        }

        $queryNumFilas = "SELECT COUNT(1) cant FROM vista_historial_participantes ".$srch;
        $queryNumFilas = $this->db->query($queryNumFilas);
        $queryNumFilas = $queryNumFilas->row();
        $queryNumFilas = $queryNumFilas->cant;

        $query = "SELECT
                    participante_id,
                    participante_nombre,
                    participante_apellido_paterno,
                    participante_apellido_materno,
                    participante_lugar_nacimiento,
                    participante_lugar_residencia,
                    participante_correo,
                    participante_telefono,
                    participante_edad,
                    participante_genero,
                    participante_ocupacion,
                    tipo_participante_descripcion,
                    resultado_resultado,
                    resultado_fecha,
                    curso_descripcion,
                    curso_id,
                    resultado_estatus_inscripcion,
                    resultado_puntos
                FROM vista_historial_participantes
                ".$srch.$ord." LIMIT $start, $length ";

                $result = $this->db->query($query);

                $retornar = array(
                    'numDataTotal' => $queryNumFilas,
                    'datos' => $result);

                return $retornar;
    }
    
    public function actualizarEstatusInscripcion($id, $curso){
        $data = array('EstatusInscripcion' => 1);
        $where = array("IdParticipante" => $id, 'IdCurso' => $curso);
        
        return $this->db->update('resultados_ac', $data, $where);
    }

    public function GetByCorreo($correo){
        $this->db->select("
            participante.Id                 AS participante_id,
            participante.Nombre             AS participante_nombre,
            participante.ApellidoPaterno    AS participante_apellido_paterno,
            participante.ApellidoMaterno    AS participante_apellido_materno,
            participante.LugarNacimiento    AS participante_lugar_nacimiento,
            participante.LugarResidencia    AS participante_lugar_residencia,
            participante.CodigoPostal       AS participante_codigo_postal,
            participante.Correo             AS participante_correo,
            participante.Telefono           AS participante_telefono,
            participante.Edad               AS participante_edad,
            participante.Genero             AS participante_genero,
            participante.Ocupacion          AS participante_ocupacion,
            participante.EstatusInscripcion AS participante_estatus_inscripcion,
            ");

        $this->db->from("participantes as participante");
        $this->db->where("participante.Correo", $correo);

        return $this->db->get()->row_array();
    }

    public function ValidarExisteResultado($idParticipante, $idCurso){
        $existe = $this->db->query("SELECT Idparticipante FROM resultados_ac WHERE IdParticipante = $idParticipante AND IdCurso = $idCurso");
        $result = $existe->num_rows();

        if($result > 0){
            return true;
        }else{
            return false;
        }
    
    }

    public function ActualizaCarga($data, $id, $curso){
        
        foreach ($data as $dato) {
            $where = array('IdParticipante' => $id, 'IdCurso' => $curso);
            
            return $this->db->update('resultados_ac', $dato, $where);
        }
    }

    public function GetParticipantesActivosInscripcion(){
        $sqlProcedure = "CALL `sp_lista_participantes`()";
        $query_result = $this->db->query($sqlProcedure);
        $result = $query_result->result_array();
        $query_result->next_result();
        $query_result->free_result();

        return $result;
    }

    public function AgregarInscripcionGrupoHorario($idAlumno, $idGrupo){
        $sqlProcedure = "CALL `sp_alumnos_agregar_inscripcion`($idAlumno, $idGrupo)";
        $query_result = $this->db->query($sqlProcedure);
        $result = $query_result->row_array();
        $query_result->next_result();
        $query_result->free_result();

        return $result;
    }

    public function ExportReporteParticipantes($idCurso, $estatus){
        $sqlProcedure = "CALL `sp_reporte_participantes`($idCurso, $estatus)";
        $query_result = $this->db->query($sqlProcedure);
        $result = $query_result->result_array();
        $query_result->next_result();
        $query_result->free_result();

        return $result;
    }

    public function GetHistorialReporteAvance($curso, $start, $length, $search, $columna, $direccion, $estatus){
        $srch = "";
        $ord = "";
        $curs = "";

        if($curso == "" || $curso == 0 || $curso == null){
            $curs = "";
        }else{
            $curs = "id_curso = ".$curso;
        }
        
        if($search){
            if($curso == "" || $curso == 0 || $curso == null){
                $srch = " WHERE (nombre_alumno LIKE '%".$search."%' OR 
                apellido_paterno_alumno LIKE '%".$search."%' OR 
                apellido_materno_alumno LIKE '%".$search."%') AND estatus_avance = ".$estatus." ";
            }else{
                $srch = " WHERE (nombre_alumno LIKE '%".$search."%' OR 
                apellido_paterno_alumno LIKE '%".$search."%' OR 
                apellido_materno_alumno LIKE '%".$search."%') AND estatus_avance = ".$estatus." AND ".$curs;
            }
            
        }else{
            if($curso == "" || $curso == 0 || $curso == null){
                $srch = "WHERE estatus_avance = ".$estatus;
            }else{
                $srch = "WHERE ".$curs. " AND estatus_avance = ".$estatus;
            }
        }

        if($columna){
            $columnaNombre = "";
            switch ($columna) {
                case 2:
                    $columnaNombre = "nombre_alumno";
                    break;
                case 7:
                    $columnaNombre = "ocupacion_alumno";
                    break;
                case 8:
                    $columnaNombre = "curso_descripcion";
                    break;
                default:
                    $columnaNombre = "id_alumno";
                    break;
            }

            $ord = " ORDER BY ".$columnaNombre." ".$direccion;
        }

        $queryNumFilas = "SELECT COUNT(1) cant FROM vista_historial_avance_alumnos ".$srch;
        $queryNumFilas = $this->db->query($queryNumFilas);
        $queryNumFilas = $queryNumFilas->row();
        $queryNumFilas = $queryNumFilas->cant;

        $query = "SELECT
                    id_alumno,
                    nombre_alumno,
                    apellido_paterno_alumno,
                    apellido_materno_alumno,
                    correo,
                    telefono_alumno,
                    ocupacion_alumno,
                    curso_descripcion,
                    avance,
                    id_curso
                FROM vista_historial_avance_alumnos
                ".$srch.$ord." LIMIT $start, $length ";

                $result = $this->db->query($query);

                $retornar = array(
                    'numDataTotal' => $queryNumFilas,
                    'datos' => $result);

                return $retornar;
    }
}
