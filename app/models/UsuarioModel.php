<?php
require_once './app/models/Model.php';
class UsuarioModel extends Model
{
    
    
    function getAllUsuarios()
    {
        $query = $this->db->prepare('SELECT * FROM usuarios');
        $query->execute();
        $usuario = $query->fetchAll(PDO::FETCH_OBJ);
        return $usuario;
    }

    function getUsuarioById($id)
    {
        $query = $this->db->prepare("SELECT * FROM usuarios WHERE id_usuario = ?");
        $query->execute([$id]);
        $usuario = $query->fetch(PDO::FETCH_OBJ);
        return $usuario;
    }



    function addUsuario($nombre, $apellido, $gmail)
    {
        $query = $this->db->prepare('INSERT INTO usuarios (nombre, apellido, gmail) VALUES (?, ?, ?)');
        $query->execute([$nombre, $apellido, $gmail]);
        return $this->db->lastInsertId();
    }
    function updateUsuario($id, $nombre, $apellido, $gmail)
    {

        $query = $this->db->prepare('UPDATE usuarios SET nombre = ?, apellido = ?, gmail = ? WHERE id_usuario = ?');
        $query->execute([$nombre, $apellido, $gmail, $id]);
    }

    function deleteUsuario($id)
    {
        $query = $this->db->prepare('DELETE FROM usuarios WHERE id_usuario = ?');
        $query->execute([$id]);
    }
}
