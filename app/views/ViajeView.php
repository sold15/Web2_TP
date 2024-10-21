<?php

class ViajeView
{

    public function showDestino($viajes, $isAdmin=false)
    {
        require_once "templates/ViajesDestinos.phtml";
    }

    public function showDetailsViaje($viaje, $usuario, $isAdmin = false)
    {
        require_once "templates/ViajeDetalles.phtml";
    }


    public function formularioActualizarViaje($viaje, $usuario, $isAdmin=false)
    {
        $viajes=$viaje;
        $usuarios=$usuario;
        require_once "templates/FormActualizarViaje.phtml";
    }
    public function formularioAgregarViaje($usuario, $isAdmin=false)
    {
        $usuarios=$usuario;
        require_once "templates/FormAgregarViaje.phtml";
    }
    public function showError($error)
    {
        $errores = $error;
        require_once "templates/Errores.phtml";
    }
}
