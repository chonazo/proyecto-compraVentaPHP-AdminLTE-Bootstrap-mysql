<?php
class MainController
{
    public function __construct() {}

    public function index()
    {
        if (!isset($_SESSION['username'])) {
            header("Location: index.php?alert=3");
            exit();
        }

        // CORRECTION: The path now correctly points to the 'template' folder
        require_once __DIR__ . '/../view/template/main.php';
    }
}
