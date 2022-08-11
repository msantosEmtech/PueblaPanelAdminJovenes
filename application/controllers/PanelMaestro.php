<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PanelMaestro extends CI_Controller {
    public function __construct(){
		header('Access-Control-Allow-Origin: *');
		parent::__construct();

        if(!$this->session->userdata('idUsuario')){
			redirect(base_url());
		}

		//Zona horaria
		date_default_timezone_set('America/Mexico_City');

		$this->load->model('cursos/CursoModel');
	}
	public function index()
	{
		$nombre = $this->session->userdata('NombreCompleto');
		$idRol = $this->session->userdata('idRol');
		$nombreRol = $this->session->userdata('nombreRol');
		$cursos = $this->CursoModel->GetCursos();

		$data['title'] = 'Dashboard';
		$data['nombre'] = $nombre;
		$data['cursos'] = $cursos;
		$data['nombreRol'] = $nombreRol;
		$data['idRol'] = $idRol;

		$linkJsAlert = base_url('static/plugins/sweetalert/sweetalert2.all.min.js');
		$linkJsVista = base_url('static/principal/js/dashboard/dashboardAdmin.js');

		$footer = array(
			'scriptVista' => '<script src="'.$linkJsVista.'"></script>',
			'scriptAlert' => '<script src="'.$linkJsAlert.'"></script>'
		);

		$this->load->view('headerAdmin', $data);
		if($data['idRol'] == 1){
			$this->load->view('panel/dashboardAdmin', $data);
		}else{
			$this->load->view('panel/dashboard', $data);
		}
		$this->load->view('footerAdmin', $footer);
	}

	public function ObtenerTotalCirculoCurso(){
		$curso = $this->input->post('curso');

		$result = $this->CursoModel->GetTotalPorcentajeByIdCurso($curso);

		echo json_encode($result);
	}

	public function ObtenerAvancesAdmin(){
		$curso = $this->input->post('curso');

		$result = $this->CursoModel->GetTotalAvancesByIdCurso($curso);

		echo json_encode($result);
	}

	public function ObtenerAvanceProgressBar(){
		$result = $this->CursoModel->GetTotalProgressBar();

		return $result;
	}

	public function ObtenerAvancePorCursoAdmin(){
		$result = $this->ObtenerAvanceProgressBar();

		echo json_encode($result);
	}
}
