<?php
require_once __DIR__ . '/../core/View.php';

class ChangeUserController {

    public function __construct() {
        
    }

    public function indexPass() {   
        // Verificamos si el usuario ha iniciado sesión
        if (!isset($_SESSION['id_user'])) {
            header("Location: index.php?alert=3");
            exit();
        }

        // Pasamos user a la vista, junto con el título
        $data = [            
            
             'Title'  => 'Menú general'
        ];

        View::render('Usuarios/CambiarContrasena', $data);
    }
}
