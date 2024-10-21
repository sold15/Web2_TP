<?php
require_once "./app/models/Model.php";
class ViajeModel extends Model
{


    function getDestino()
    {
        $query = $this->db->prepare("SELECT * FROM viajes");
        $query->execute();
        $viajes = $query->fetchAll(PDO::FETCH_OBJ);
        return $viajes;
    }
    function getDestinoById($id)
    {
        $query = $this->db->prepare("SELECT * FROM viajes WHERE ID_viajes=?");
        $query->execute([$id]);
        $viajes = $query->fetch(PDO::FETCH_OBJ);
        return $viajes;
    }


   

    function getDetails($id)
    {
        $query = $this->db->prepare("SELECT * FROM viajes WHERE ID_viajes = ?");
        $query->execute([$id]);
        $viajes = $query->fetch(PDO::FETCH_OBJ);
        return $viajes;
    }

    function addViaje($destino, $salida, $regreso, $usuario)
    {
        $query = $this->db->prepare('INSERT INTO viajes (destino, salida, regreso, id_usuario) VALUES (?, ?, ?, ?)');
        $query->execute([$destino, $salida, $regreso, $usuario]);
        return $this->db->lastInsertId();
    }

    function getViajesByUsuarioId($id)
    {
        $query = $this->db->prepare("SELECT * FROM viajes WHERE id_usuario = ?");
        $query->execute([$id]);
        $viajes = $query->fetchAll(PDO::FETCH_OBJ);
        return $viajes;
    }

    function deleteViaje($id)
    {
        $query = $this->db->prepare('DELETE FROM viajes WHERE ID_viajes = ?');
        $query->execute([$id]);
    }



    function updateViaje($destino, $salida, $regreso, $usuario, $id)
    {
        $query = $this->db->prepare('UPDATE viajes SET destino = ?, salida = ?, regreso = ?, id_usuario = ? WHERE ID_viajes = ?');
        $query->execute([$destino, $salida, $regreso, $usuario, $id]);
    }
}
