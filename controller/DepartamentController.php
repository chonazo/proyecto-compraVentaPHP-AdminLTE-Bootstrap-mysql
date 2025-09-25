<?php

require_once __DIR__ . '/../core/View.php';
require_once __DIR__ . '/../model/DepartamentModel.php';


class DepartamentController {
    private $departamentModel;

    public function __construct(PDO $conn) {
        $this->departamentModel = new DepartamentModel($conn);
    }

    public function indexDepartament() {
        if (!isset($_SESSION['id_user'])) {
            header("Location: index.php?alert=3");
            exit();
        }

        $departamentos = $this->departamentModel->getAll();

        $data = [
            'Title'  => 'Gestion de Departamentos',
            'departamentos'  => $departamentos
        ];

        View::render('departamento/viewDepartament', $data);
    }
}


