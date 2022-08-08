<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH.'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RegistroAlumnosAdmin extends CI_Controller {
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

        $data['title'] = 'Registro alumnos';
        $data['nombre'] = $nombre;
		$data['nombreRol'] = $nombreRol;
        $data['idRol'] = $idRol;
		$linkJsVista = base_url('static/principal/js/alumnos/alumnosAdmin.js');
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
		$this->load->view('alumnos/alumnosAdmin', $dataBody);
		$this->load->view('footerAdmin', $footer);
	}

    public function HistorialAlumnosByCurso(){
        $curso = $this->input->post('columns')[0]['search']['value'] == "" ?  0 : $this->input->post('columns')[0]['search']['value'];
        $resultAssesment = $this->input->post('columns')[1]['search']['value'] == "" || $this->input->post('columns')[1]['search']['value'] == null ? 1 : $this->input->post('columns')[1]['search']['value'];


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

    public function ActualizarEstatusInscripcion(){
        $ids = $this->input->post('ids');

        $result = 0;
        foreach ($ids as $id) {
            $actualizado = $this->AlumnoModel->actualizarEstatusInscripcion($id['participante_id'], $id['curso_id']);
            if($actualizado){
                if($id['curso_id'] == 1){
                    $grupo = $this->GruposModel->GetByIdCurso($id['curso_id']);
                    $this->AlumnoModel->AgregarInscripcionGrupoHorario($id['participante_id'], $grupo['grupo_id']);
                }
                                    
                $result = 1;
            }else{
                $result = 0;
            }
        }

        echo json_encode($result);
    }

    public function DescargarPlantilla(){

		$this->load->helper('download');
		$path = base_url('static/archivoPlantilla/plantillaExcel.xlsx');

		ob_clean();

		$data = file_get_contents($path);
		$name = 'plantillaExcel.xlsx';
		force_download($name, $data);
	}

    public function LecturaPreviaExcel(){
        $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        if(isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)){
            $arr_file = explode('.', $_FILES['file']['name']);
            $extension = end($arr_file);
            if('csv' == $extension){
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            }elseif('xls' == $extension){
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            }else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            $sheetCount = count($sheetData);
            if(!empty($sheetData)){
                if($sheetCount > 1){
                    for($i=1; $i<$sheetCount; $i++){
                        if($sheetData[$i][0] == ""){
                            //el archivo esta vacio
                            echo json_encode(-1);
                            exit;
                        }
                        $correo = $sheetData[$i][0];
                        $curso = $sheetData[$i][1];
                        $puntaje = $sheetData[$i][2];
                        $resultado = "Avanzado";
                        if($puntaje == "" || $puntaje == null){
                            echo json_encode(-4);
                            exit;
                        }
                        $participante = $this->AlumnoModel->GetByCorreo($correo);
                        if($participante == "" || $participante == null){
                            //el correo no existe
                            json_encode(0);
                            exit;
                        }
                        switch ($curso) {
                            case 'TECNOLOGIAS EMERGENTES':
                                $cursoEspecialidad2 = $this->CursoModel->GetIdByNombre($curso);
                                $curso = $cursoEspecialidad2['Id'];
                                break;
                            case 'METODOLOGIAS AGILES':
                                $cursoEspecialidad2 = $this->CursoModel->GetIdByNombre($curso);
                                $curso = $cursoEspecialidad2['Id'];
                                break;
                            case 'WEB':
                                $cursoEspecialidad2 = $this->CursoModel->GetIdByNombre($curso);
                                $curso = $cursoEspecialidad2['Id'];
                                break;
                            default:
                                $curso = 0;
                                break;
                        }
                        if($curso == 0 || $curso == null || $curso == ""){
                            //el curso no existe
                            json_encode(-2);
                            exit;
                        }
                        $existeResultado = $this->AlumnoModel->ValidarExisteResultado($participante['participante_id'], $curso);
                        if($existeResultado == false){
                            json_encode(-3);
                            exit;
                        }
                        $data[] = array(
                            'Fecha' => date("Y-m-d H:i:s"),
                            'EstatusInscripcion' => 1,
                            'Resultado' => $puntaje,
                            'Nivel' => $resultado
                        );
                        $result = $this->AlumnoModel->ActualizaCarga($data, $participante['participante_id'], $curso);
                        if($result == true && $curso == 1){
                            $grupo = $this->GruposModel->GetByIdCurso($curso);
                            $this->AlumnoModel->AgregarInscripcionGrupoHorario($participante['participante_id'], $grupo['grupo_id_curso']);
                        }
                    }

                    echo json_encode(1);
                }else{
                    echo json_encode(-1);
                }

            }
        }
    }

    public function DescargarReporte($curso, $estatus){
        // $curso = $this->input->get('curso');
        // $estatus = $this->input->get('estatus');

        $file_name = 'reporte_participantes_'.date('Ymd').'.csv';
        header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Content-Type: application/csv;");
    
        

        $totales_data = $this->AlumnoModel->ExportReporteParticipantes($curso, $estatus);
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

}
