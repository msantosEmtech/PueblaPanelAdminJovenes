<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seleccionados extends CI_Controller {
    public function __construct(){
		header('Access-Control-Allow-Origin: *');
		parent::__construct();

        $this->load->model('alumnos/AlumnoModel');
        $this->load->model('horario/HorarioModel');
        $this->load->model('cursos/CursoModel');
		//Zona horaria
		date_default_timezone_set('America/Mexico_City');
	}
	public function index(){
        $cursos = $this->CursoModel->GetCursos();
        $data['title'] = 'Seleccionados';
        $data['listaCursos'] = $cursos;
        $this->load->view('Seleccionados/index', $data);
	}

    public function DescargarReporte($curso){

        $file_name = 'reporte_participantes_seleccionados'.date('Ymd').'.csv';
        header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Content-Type: application/csv;");
    
        

        $totales_data = $this->AlumnoModel->ExportReporteParticipantes($curso, 1);
        $file = fopen('php://output', 'w');
        //con esta line se resuelve problemas de acento y caracteres especiales
        fputs($file, chr(0xEF).chr(0xBB).chr(0xBF));
        $header = array("identificador",
        "Nombre",
        "Apellido paterno",
        "Apellido materno",
        "Lugar de nacimiento",
        "Lugar de residencia",
        "Código postal",
        "Correo",
        "Telefono",
        "Edad",
        "Genero",
        "Ocupación",
        "Resultado",
        "Puntos",
        "Curso",
        "Estatus Inscripción"
        );
        
        fputcsv($file, $header);

        foreach ($totales_data as $key => $value) {
            fputcsv($file, $value);
        }
        fclose($file);
        exit;
    }

    public function HistorialAlumnosByCurso(){
        $curso = $this->input->post('columns')[0]['search']['value'] == "" || $this->input->post('columns')[0]['search']['value'] == null || $this->input->post('columns')[0]['search']['value'] == 0  ?  1 : $this->input->post('columns')[0]['search']['value'];
        $resultAssesment = 1;


        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search')['value'];
        $columna = $this->input->post('order')[0]['column'];
        $direccion = $this->input->post('order')[0]['dir'];

        $result = $this->AlumnoModel->GetHistorialByCurso($curso, $start, $length, $search, $columna, $direccion, $resultAssesment);
        $resultado = $result['datos'];
        $totalDatos = $result['numDataTotal'];

        $datos = array();

        foreach ($resultado->result_array() as $fila) {
            $array = array();
            $array['participante_id'] = $fila['participante_id'];
            $array['participante_nombre'] = $fila['participante_nombre'];
            $array['participante_apellido_paterno'] = $fila['participante_apellido_paterno'];
            $array['participante_apellido_materno'] = $fila['participante_apellido_materno'];
            $array['participante_lugar_nacimiento'] = $fila['participante_lugar_nacimiento'];
            $array['participante_lugar_residencia'] = $fila['participante_lugar_residencia'];
            $array['participante_correo'] = $fila['participante_correo'];
            $array['participante_telefono'] = $fila['participante_telefono'];
            $array['participante_edad'] = $fila['participante_edad'];
            $array['participante_genero'] = $fila['participante_genero'];
            $array['participante_ocupacion'] = $fila['participante_ocupacion'];
            $array['tipo_participante_descripcion'] = $fila['tipo_participante_descripcion'];
            $array['resultado_resultado'] = $fila['resultado_resultado'];
            $array['resultado_fecha'] = $fila['resultado_fecha'];
            $array['curso_descripcion'] = $fila['curso_descripcion'];
            $array['curso_id'] = $fila['curso_id'];
            $array['resultado_estatus_inscripcion'] = $fila['resultado_estatus_inscripcion'];
            $array['resultado_puntos'] = $fila['resultado_puntos'];

            $datos[] = $array;
        }

        $totalDatoObtenido = $resultado->num_rows();

        $json_data = array(
            'draw' => intval($this->input->post('draw')), 
            'recordsTotal' => intval($totalDatoObtenido),
            'recordsFiltered' => intval($totalDatos),
            'data' => $datos
            );

        echo json_encode($json_data);
    }

}
