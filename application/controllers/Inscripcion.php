<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inscripcion extends CI_Controller {
    public function __construct(){
		header('Access-Control-Allow-Origin: *');
		parent::__construct();

        $this->load->model('alumnos/AlumnoModel');
        $this->load->model('horario/HorarioModel');
		//Zona horaria
		date_default_timezone_set('America/Mexico_City');
	}
	public function index(){
        $participantes = $this->AlumnoModel->GetParticipantesActivosInscripcion();
        $data['title'] = 'Inscripción';
        $data['listaParticipantes'] = $participantes;
        $this->load->view('inscripcion/index', $data);
	}

    public function ObtenerListaHorariosPorCurso(){
        $idCurso = $this->input->post('idCurso');

        $result = $this->HorarioModel->GetListaByCurso($idCurso);

        echo json_encode($result);
    }

    public function AgregarInscripcion(){
        $idAlumno = $this->input->post('idAlumno');
        $idGrupo = $this->input->post('idGrupo');

        $result = $this->AlumnoModel->AgregarInscripcionGrupoHorario($idAlumno, $idGrupo);

        echo json_encode($result);
    }

}
