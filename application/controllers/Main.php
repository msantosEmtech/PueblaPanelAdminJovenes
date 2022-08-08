<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct(){
		parent::__construct();

		header('Access-Control-Allow-Origin: *');
        Header('Access-Control-Allow-Headers: *');
        Header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	}

	//inicio del dashboard
	public function index()
	{
		$idUser = $this->session->userdata('idUsuario');
		// $nombreUni = $this->session->userdata('nombreUniversidad');
		$idRol = $this->session->userdata('idRol');
		
		if(!$idUser){
			redirect(base_url("Login"));
		}else{
			if($idRol == 1){
				redirect(base_url("PanelMaestro"));
			}else{
				redirect(base_url("Maestro"));
			}
		}
	}
}