<?php
require_once './app/models/Model.php';

class RegistroModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function getByNombre($nombre)
    {
        $query = $this->db->prepare('SELECT * FROM registro WHERE nombre_usuario = ?');
        $query->execute([$nombre]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
}