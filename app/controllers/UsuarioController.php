<?php
require_once './app/models/UsuarioModel.php';
require_once './app/views/RegistroView.php';
require_once './auth/AuthHelper.php';


class UsuarioController
{
    private $model;
    private $modelViaje;
    private $view;

    public function __construct()
    {
        $this->model = new UsuarioModel();
        $this->modelViaje=new ViajeModel();
        $this->view = new UsuarioView();
    }

    public function showAllUsuarios()
    {
        $isAdmin = AuthHelper::isAdmin();
        $usuarios = $this->model->getAllUsuarios();
        $this->view->showUsuarios($usuarios, $isAdmin);
    }

    public function showDetailsUsuario($id)
    {
        $isAdmin = AuthHelper::isAdmin();
        $usuario = $this->model->getUsuarioById($id);
       
        $this->view->showDetailsUsuario($usuario, $isAdmin);
    }
    public function formAgregarUsuario()
    {
        AuthHelper::verify();
        $isAdmin = AuthHelper::isAdmin(); //para verificacion del header
        $usuarios = $this->model->getAllUsuarios();
        $this->view->formAgregarUsuario($usuarios,$isAdmin);
    }

    public function addUsuario()
    {
        AuthHelper::verify();
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $gmail = $_POST['gmail'];

        if (empty($nombre) || empty($apellido) || empty($gmail) ) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }
        $id = $this->model->addUsuario($nombre, $apellido, $gmail);
        if ($id) {
            header('Location: ' . BASE_URL . 'Usuarios');
        } else {
            $this->view->showError("Error al insertar la tarea");
        }
    }
    public function formActualizarUsuario($id)
    {
        $isAdmin = AuthHelper::isAdmin(); //para verificacion del header
        AuthHelper::verify();
        $usuarios = $this->model->getUsuarioById($id);
        $this->view->formActualizarUsuario($usuarios, $isAdmin);
    }
    public function updateUsuario($id)
    {
        AuthHelper::verify();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $gmail = $_POST['gmail'];
            try {
                if (empty($nombre) || empty($apellido) || empty($gmail) ) {
                    $this->view->showError("Debe completar todos los campos");
                    return;
                }
                $this->model->updateUsuario($id, $nombre, $apellido, $gmail);
                if ($id) {
                    header('Location: ' . BASE_URL . 'Usuarios');
                }
            } catch (PDOException $e) {
                $this->view->showError("No se puede actualizar: " . $e->getMessage());
            }
        } else {
            $this->view->showError("Error al actualizar la tarea");
        }
        
    }
    


    function deleteUsuario($id)
    {
        AuthHelper::verify();
        try {
            $this->model->deleteUsuario($id);
            header('Location: ' . BASE_URL . 'Usuarios');
        } catch (PDOException $e) {
            $this->view->showError("No se puede eliminar, el usuario tiene un viaje asociado");
        }
    }
}
