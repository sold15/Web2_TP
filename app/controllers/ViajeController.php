<?php
require_once './app/models/ViajeModel.php';
require_once './app/models/UsuarioModel.php';
require_once './app/views/ViajeView.php';
require_once './auth/AuthHelper.php';
require_once 'app/controllers/ViajeController.php';
require_once 'app/controllers/UsuarioController.php';


class ViajeController
{
    private $model;
    private $view;
    private $usuarioModel;

    public function __construct()
    {
        $this->model = new ViajeModel();
        $this->view = new ViajeView();
        $this->usuarioModel = new UsuarioModel();
    }

    public function showDestino()
    {
        $isAdmin = AuthHelper::isAdmin();
        $viajes = $this->model->getDestino();
        $this->view->showDestino($viajes, $isAdmin);
    }


    public function showDetailsViaje($id)
    {
        $isAdmin = AuthHelper::isAdmin();
        $viaje = $this->model->getDetails($id);
        $usuario = $this->usuarioModel->getUsuarioById($viaje->id_usuario);
        $this->view->showDetailsViaje($viaje, $usuario, $isAdmin);
    }


    public function formAgregarViajes()
    {
        AuthHelper::verify();
        $isAdmin = AuthHelper::isAdmin(); //para validar header
        $usuarios = $this->usuarioModel->getAllUsuarios();
        $this->view->formularioAgregarViaje($usuarios, $isAdmin);
    }

    public function addViaje()
    {
        AuthHelper::verify();
        $destino = $_POST['destino'];
        $salida = $_POST['salida'];
        $regreso = $_POST['regreso'];
        $usuario = $_POST['usuario'];

        if (empty($destino) || empty($salida) || empty($regreso) || empty($usuario)) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }
        $id = $this->model->addViaje($destino, $salida, $regreso, $usuario);
        if ($id) {
            header('Location: ' . BASE_URL . 'Viajes');
        } else {
            $this->view->showError("Error al insertar la tarea");
        }
        
    }

    function deleteViaje($id)
    {
        AuthHelper::verify();
        try {
            $this->model->deleteViaje($id);
            header('Location: ' . BASE_URL . 'Viajes');
        } catch (PDOException $e) {
            $this->view->showError("No se puede eliminar, elimine otro elemento" .  $e->getMessage());
        }
    }


    public function formActualizarViajes($id)
    {
        AuthHelper::verify();
        $isAdmin = AuthHelper::isAdmin(); //para validar el header
        $viaje = $this->model->getDestinoById($id);
        $usuarios = $this->usuarioModel->getAllUsuarios();
        $this->view->formularioActualizarViaje($viaje, $usuarios, $isAdmin);
    }


    public function updateViaje($id)
    {
        AuthHelper::verify();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $destino = $_POST['destino'];
            $salida = $_POST['salida'];
            $regreso = $_POST['regreso'];
            $usuario = $_POST['usuario'];

            try {
                if (empty($destino) || empty($salida) || empty($regreso) ||  empty($usuario)) {
                    $this->view->showError("Debe completar todos los campos");
                    return;
                }

                $this->model->updateViaje($destino, $salida, $regreso, $usuario, $id);
                if ($id) {
                    header('Location: ' . BASE_URL . 'Viajes');
                }
            } catch (PDOException $e) {
                $this->view->showError("No se puede actualizar: " . $e->getMessage());
            }
        } else {
            $this->view->showError("Error al actualizar la tarea");
        }
    }

    public function showError($error){ //para el router
    $this->view->showError($error);
    }
}
