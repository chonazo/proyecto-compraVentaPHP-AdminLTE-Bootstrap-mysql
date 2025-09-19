<?php

require_once __DIR__ . '/../model/UserModel.php';

class LoginController
{
    private $userModel;

    public function __construct(PDO $conn)
    {
        $this->userModel = new UserModel($conn);
    }

    public function login()
    {

        // Evitamos el cacheo de la página de login
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0");

        // Si la sesión está activa, redirigimos al enrutador principal
        if (isset($_SESSION['username'])) {
            header("Location: index.php?controller=Dashboard&action=index");
            exit();
        }

        // Si es una petición POST, procesamos el formulario de login
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($username) || empty($password)) {
                // CORRECCIÓN 2: Usar variables de sesión para los mensajes de alerta
                $_SESSION['alert'] = 1; // '1' para error de login
                header("Location: index.php");
                exit();
            }

            $md5Password = md5($password);
            $data = $this->userModel->authenticate($username, $md5Password);

            if ($data) {
                // ... tu código de sesión ...
                $_SESSION['id_user'] = $data['id_user'];
                $_SESSION['username'] = $data['username'];
                $_SESSION['name_user'] = $data['name_user'];
                $_SESSION['permisos_acceso'] = $data['permisos_acceso'];

                header("Location: index.php?controller=Dashboard&action=index");
                exit();
            } else {
                $_SESSION['alert'] = 1; // '1' para error de login
                header("Location: index.php");
                exit();
            }
        }

        // Si no es una petición POST, mostramos el formulario de login y las alertas
        require_once __DIR__ . '/../view/Login.php';
    }

    public function logout()
    {

        session_start();
        session_unset();
        // Destruimos la sesión por completo.
        session_destroy();

        // Redirigimos al login con el mensaje de éxito.
        header("Location: index.php?controller=Login&action=login&alert=2");
        exit();
    }
}
