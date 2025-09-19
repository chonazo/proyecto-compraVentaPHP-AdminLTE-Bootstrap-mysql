<?php
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

        if (!isset($_SESSION['id_user'])) {
            header("Location: index.php?controller=Login&action=login&alert=3");
            exit();
        }

        // Obtener la información del usuario
        $user = $this->userModel->getUserInfo($_SESSION['id_user']);
        
        // 1. Capturar el HTML para el menú superior
        ob_start();
        include __DIR__ . '/../view/template/top_menu.php';
        $topMenu = ob_get_clean();

        // 2. Capturar el HTML para el menú lateral
        ob_start();
        include __DIR__ . '/../view/template/sidebar_menu.php';
        $sidebarMenu = ob_get_clean();
        
        // 3. Capturar el HTML para el contenido del dashboard
        ob_start();
        include __DIR__ . '/../view/dashboard.php';
        $pageContent = ob_get_clean();

        // 4. Cargar la plantilla principal (main.php)
        include __DIR__ . '/../view/template/main.php';
    }
}