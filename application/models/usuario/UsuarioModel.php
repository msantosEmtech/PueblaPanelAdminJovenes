<?php

class UsuarioModel extends CI_Model{

    public function GetCredenciales($correo, $contrasenia){
        $query = $this->db->query("CALL `sp_usuarios_get_by_credenciales`('$correo', '$contrasenia')");
        return $query->row_array();
    }
    
    public function GetById($id){
        $this->db->select("
                        usu.Id 			 AS usuario_id,
                        usu.Nombre 		 AS usuario_nombre,
                        usu.Apellidos 	 AS usuario_apellidos,
                        usu.Correo 		 AS usuario_correo,
                        usu.Contrasenia  AS usuario_contrasenia,
                        usu.IdRol        AS usuario_idRol,
                        rol.Descripcion  AS rol_descripcion");

        $this->db->from("usuarios AS usu");
        $this->db->join("roles AS rol","rol.Id = usu.IdRol","inner");
        $this->db->where("usuarios.Id", $id);

        return $this->db->get()->row_array();
    }

    public function GetByCorreo($correo){
        $this->db->select("
                        usu.Id 			 AS usuario_id,
                        usu.Nombre 		 AS usuario_nombre,
                        usu.Apellidos 	 AS usuario_apellidos,
                        usu.Correo 		 AS usuario_correo,
                        usu.Contrasenia  AS usuario_contrasenia,
                        usu.IdRol        AS usuario_idRol,
                        rol.Descripcion  AS rol_descripcion");

        $this->db->from("usuarios AS usu");
        $this->db->join("roles AS rol","rol.Id = usu.IdRol","inner");
        $this->db->where("usu.Correo", $correo);

        return $this->db->get()->row_array();
    }

    public function ActualizarContrasenia($idUsuario, $contrasenia){
        $where = array('Id' => $idUsuario);
		
        $data = [
            'Contrasenia' => $contrasenia
        ];
        
        return $this->db->update("usuarios", $data, $where);
    }
}