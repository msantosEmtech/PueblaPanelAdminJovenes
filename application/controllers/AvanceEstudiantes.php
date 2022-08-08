<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AvanceEstudiantes extends CI_Controller {
    public function __construct(){
		header('Access-Control-Allow-Origin: *');
		parent::__construct();

        if(!$this->session->userdata('idUsuario')){
			redirect(base_url());
		}

		$this->load->model('usuario/UsuarioModel');
        $this->load->model('cursos/CursoModel');
        $this->load->model('alumnos/AlumnoModel');
        $this->load->model('grupos/GruposModel');

		//Zona horaria
		date_default_timezone_set('America/Mexico_City');
	}
	public function index(){   
        $nombre = $this->session->userdata('NombreCompleto');
        $idRol = $this->session->userdata('idRol');
		$nombreRol = $this->session->userdata('nombreRol');
        $cursos = $this->CursoModel->GetCursos();

        $data['title'] = 'Avance de estudiantes';
        $data['nombre'] = $nombre;
		$data['nombreRol'] = $nombreRol;
        $data['idRol'] = $idRol;
		$linkJsVista = base_url('static/principal/js/reportes/avanceEstudiantes.js');
        $linkJsAlert = base_url('static/plugins/sweetalert/sweetalert2.all.min.js');
        $linkDatatable = base_url('static/plugins/DataTables/datatables.min.css');
        $linkJsDatatable = base_url('static/plugins/DataTables/datatables.min.js');
        $linkJsMoment = base_url('static/plugins/moment/moment.js');
        $data['linkDatatable'] = "<link rel='stylesheet' type='text/css' href='$linkDatatable'/>";
        
        $dataBody['cursos'] = $cursos;

        $footer = array(
			'scriptVista' =>
				'<script src="'.$linkJsVista.'"></script>',
            'scriptAlert' => '<script src="'.$linkJsAlert.'"></script>',
            'scriptDatatable' => '<script src="'.$linkJsDatatable.'"></script>',
            'scriptMoment' => '<script src="'.$linkJsMoment.'"></script>'
		);
		$this->load->view('headerAdmin', $data);
		$this->load->view('reportes/avanceEstudiantes', $dataBody);
		$this->load->view('footerAdmin', $footer);
	}

    public function HistorialReporteAlumnosByCurso(){

        $curso = $this->input->post('columns')[0]['search']['value'] == "" || $this->input->post('columns')[0]['search']['value'] == 0 || $this->input->post('columns')[0]['search']['value'] == null ? 1 : $this->input->post('columns')[0]['search']['value'];
        $estatus = $this->input->post('columns')[1]['search']['value'] == "" || $this->input->post('columns')[1]['search']['value'] == 0 || $this->input->post('columns')[1]['search']['value'] == null ? 1 : $this->input->post('columns')[1]['search']['value'];

        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search')['value'];
        $columna = $this->input->post('order')[0]['column'];
        $direccion = $this->input->post('order')[0]['dir'];

        $result = $this->AlumnoModel->GetHistorialReporteAvance($curso, $start, $length, $search, $columna, $direccion, $estatus);
        $resultado = $result['datos'];
        $totalDatos = $result['numDataTotal'];

        $datos = array();

        foreach ($resultado->result_array() as $fila) {
            $array = array();
            $array['id_alumno'] = $fila['id_alumno'];
			$array['nombre_alumno'] = $fila['nombre_alumno'];
            $array['apellido_paterno_alumno'] = $fila['apellido_paterno_alumno'];
			$array['apellido_materno_alumno'] = $fila['apellido_materno_alumno'];
            $array['correo'] = $fila['correo'];
            $array['telefono_alumno'] = $fila['telefono_alumno'];
            $array['ocupacion_alumno'] = $fila['ocupacion_alumno'];
			$array['curso_descripcion'] = $fila['curso_descripcion'];
			$array['avance'] = $fila['avance'];
			$array['id_curso'] = $fila['id_curso'];

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
