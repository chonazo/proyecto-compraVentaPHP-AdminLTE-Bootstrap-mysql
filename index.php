<?php

session_start();

// 1. Cargamos la conexión a la bd
require_once 'config/Conexion.php';

// 2. realizamos funcion autocarga de clases, para cargar automaticamente los controladores y modelos
spl_autoload_register(function ($className) {
    // definimos las carpetas donde buscar las clases
    $folders = ['controller', 'model'];

    foreach ($folders as $folder) {
        $path = $folder . '/' . $className . '.php';
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// 3. Obtenemos el nombre del controlador y la acción de la URL
$controllerName = $_GET['controller'] ?? 'Login';
$action = $_GET['action'] ?? 'login';

// construir el nombre completo de la clase del controlador
$controllerClass = $controllerName . 'Controller';

// 4. realizamos la logica del enrutador
if (class_exists($controllerClass) && method_exists($controllerClass, $action)) {

    // usamos el 'try-catch' para manejar si el constructor requiere la conexión o no
    try {
        $reflectionMethod = new ReflectionMethod($controllerClass, '__construct'); // Instanciamos el controlador y pasamos la conexión PDO si es necesaria
        if ($reflectionMethod->getNumberOfParameters() > 0) {
            $controller = new $controllerClass($pdo);
        } else {
            $controller = new $controllerClass();
        }
    } catch (ReflectionException $e) {
        $controller = new $controllerClass();
    }
    
    // Ejecutamos la accion del controlador
    $controller->$action();
} else {
    // Si el controlador o la acción no existen redirigir al login
    header("Location: index.php?controller=Login&action=login&error=not_found");
    exit();
}