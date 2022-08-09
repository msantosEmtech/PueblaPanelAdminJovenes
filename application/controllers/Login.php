<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct(){
        header('Access-Control-Allow-Origin: *');
		parent::__construct();

		$this->load->model('usuario/UsuarioModel');
        $this->load->model('usuario/UsuarioRestaurarModel');

		//Zona horaria
		date_default_timezone_set('America/Mexico_City');
	}

	public function index(){
		$data['title'] = 'Login';

		$this->load->view('login/index', $data);
	}

	public function IniciarSesion(){
        $correo = $this->input->post('txtCorreo');
        $contrasenia = $this->input->post('txtContrasenia');

        $usuario = $this->UsuarioModel->GetCredenciales($correo, $contrasenia);

        if(isset($usuario) && $usuario != null){
            
            $variablesSesion = array(
                'idUsuario' => $usuario['usuario_id'],
                'NombreCompleto' => $usuario['usuario_nombre']." ".$usuario['usuario_apellidos'],
                'idRol' => $usuario['roles_id'],
                'nombreRol' => $usuario['roles_descripcion']
            );

            $this->session->set_userdata($variablesSesion);
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }

	public function DestroySession(){
        $this->session->sess_destroy();
		redirect(base_url(),"refresh");
    }

    public function RecuperarContrasenia(){
        $data['title'] = 'Recuperar contraseña';

		$this->load->view('login/recuperarContrasenia', $data);
    }

    public function GenerarCodigo(){
        $correo = $this->input->post("correoRecuperacion");
        $usuario = $this->UsuarioModel->GetByCorreo($correo);

        $this->UsuarioRestaurarModel->Eliminar($usuario['usuario_id']);
        
        if(isset($usuario)){
            $codigoGenerado = $this->ObtenerCodigoRamdon();
            $fechaActual = date('Y-m-d H:i:s');
            $idUsuario = $usuario['usuario_id'];
            $nombreCompleto = $usuario['usuario_nombre'].' '.$usuario['usuario_apellidos'];
            
            $dataGuardar = array(
                'IdUsuario' => $idUsuario, 
                'Codigo' => $codigoGenerado, 
                'FechaRegistro' => $fechaActual
            );
            $result = $this->UsuarioRestaurarModel->Agregar($dataGuardar);
            if($result){
                $this->EnviarCorreo($codigoGenerado,$nombreCompleto,$correo);
            }
            echo json_encode($result);
        }else{
            echo json_encode(-1);
        }

    }

    public function ObtenerCodigoRamdon(){
		$codigoAleatorio = '';

        $codigoAleatorio = sprintf("%04d", mt_rand(1, 9999));

		return $codigoAleatorio;
	}

    public function EnviarCorreo($codigoGenerado,$nombreCompleto,$correo){
		$this->load->library(['email']);

		if(EMAIL_ENABLED)
		{
			$vista = 'MENSAJE ENVIADO AUTOMATICAMENTE DESDE EL SISTEMA<br>'.
					'Estimado usuario <b><i>'.$nombreCompleto.'</i></b> usa el siguiente codigo de recuperación: <b><i>'.$codigoGenerado.'</i></b>';

			$this->email->from(EMAIL_FROM, EMAIL_FROM_NAME);
			$this->email->to($correo);
			$this->email->subject(EMAIL_SUBJECT);
			$this->email->message($vista);
			$this->email->send();
		}
	}

    public function GetUserCodigo(){
        $codigo = $this->input->post('codigo');

        $result = $this->UsuarioRestaurarModel->GetDatosByCodigo($codigo);

        echo json_encode($result);
    }

    public function UpdateContrasenia(){
        $idUsuario = $this->input->post('id');
        $contrasenia = $this->input->post('pass');

        $result = $this->UsuarioModel->ActualizarContrasenia($idUsuario, $contrasenia);

        echo json_encode($result);
    }

    public function EliminarCodigo(){
        $idUsuario = $this->input->post('id');

        $result = $this->UsuarioRestaurarModel->Eliminar($idUsuario);

        echo json_encode($result);
    }

    public function VistaCodigo(){
        $data['title'] = 'Codigo de recuperación';

		$this->load->view('login/codigoRecuperacion', $data);
    }
}