<?php

class UsuarioRestaurarModel extends CI_Model{

    public function Agregar($datos){
        
        return $this->db->insert("usuarios_restaurar_contrasenia", $datos);
    }

    public function Eliminar($idUsuario){
        $sp_delete_code = "CALL sp_usuarios_restaurar_delete(?) ";
        $data = array('idUsuario' => $idUsuario);
        $this->db->query($sp_delete_code, $data);
        
        if($this->db->affected_rows() == '1'){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function GetDatosByCodigo($codigo){
        
        $this->db->select("usu_contra.IdUsuario as IdUsuario");
        $this->db->from("usuarios_restaurar_contrasenia AS usu_contra");
        $this->db->join("usuarios AS usuario","usuario.Id = usu_contra.IdUsuario","inner");
        $this->db->where("usu_contra.Codigo", $codigo);
        
        return $this->db->get()->row_array();
    }

}