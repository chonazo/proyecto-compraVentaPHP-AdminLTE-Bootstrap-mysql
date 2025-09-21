<?php
require_once __DIR__ . '/../model/UserModel.php';
require_once __DIR__ . '/../core/View.php';

class DashboardController {

    private $userModel;

    public function __construct(PDO $conn) {
        $this->userModel = new UserModel($conn);
    }

    public function index() {
        // Evitamos el caché del navegador
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0");

        // Verificamos si el usuario ha iniciado sesión
        $user = $this->userModel->getUserInfo($_SESSION['id_user']);

        // Creamos un array con los datos que la vista necesita.
        $data = [
            'user' => $user
        ];
        
        
        View::render('dashboard', $data);
    }
}