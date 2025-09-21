<?php

class View {
    public static function render($viewName, $data = []) {
        // Extraemos los datos para que sean accesibles como variables disponibles en la vista.
        extract($data);

        // Definimos la ruta de la vista de contenido
        $contentViewPath = __DIR__ . "/../view/{$viewName}.php";

        // Verificamos si el archivo de la vista de contenido existe
        if (!file_exists($contentViewPath)) {
            // Manejamos un error si la vista no existe            
            echo "Error: Vista '{$viewName}' no encontrada.";
            return;
        }

        // Capturamos el HTML de la vista de contenido (dashboard.php)
        ob_start();
        include $contentViewPath;
        $pageContent = ob_get_clean();

        // Usamos la captura de salida para el menú superior
        ob_start();
        include __DIR__ . '/../view/template/top_menu.php';
        $topMenu = ob_get_clean();

        // Usamos la captura de salida para el menú lateral
        ob_start();
        include __DIR__ . '/../view/template/sidebar_menu.php';
        $sidebarMenu = ob_get_clean();

        // Incluimos la plantilla principal (Main.php) que tiene el layout completo
        include __DIR__ . '/../view/template/Main.php';
    }
}