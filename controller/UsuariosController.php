<?php
require_once __DIR__ . '/../core/View.php';
require_once __DIR__ . '/../model/UsuariosModel.php';


class UsuariosController {
    private $usuariosModel;

    public function __construct(PDO $conn)  {
        $this->usuariosModel = new UsuariosModel($conn);
    }

    // Mostrar formulario de cambio de contraseña
    public function indexPass() {
        if (!isset($_SESSION['id_user'])) {
            header("Location: index.php?alert=3");
            exit();
        }

        $data = ['Title'  => 'Menú general'];

        View::render('usuarios/changePass', $data);
    }

    // Mostrar view usuarios
    public function indexUser() {

        if (!isset($_SESSION['id_user'])) {
            header("Location: index.php?alert=3");
            exit();
        }

        // Obtener la lista de usuarios del modelo
        $users = $this->usuariosModel->getAllUsers();

        $data = [
            'Title' => 'Administrar Usuarios',
            'users' => $users
        ];

        View::render('usuarios/user', $data);
    }

    // Mostrar formulario agregar usuario
    public function indexFormAdd() {

        if (!isset($_SESSION['id_user'])) {
            header("Location: index.php?alert=3");
            exit();
        }

        $data = [
            'Title'   => 'Agregar Usuarios',
            'usuario' => null // no hay datos aún
        ];

        View::render('usuarios/user_form', $data);
    }

    // formulario de editar usuario
    public function indexFormEdit() {
    if (!isset($_SESSION['id_user'])) {
        header("Location: index.php?alert=3");
        exit();
    }

    if (!isset($_GET['id'])) {
        header("Location: index.php?controller=Usuarios&action=indexUser&alert=9");
        exit();
    }

    $id_user = intval($_GET['id']);
    $usuario = $this->usuariosModel->getById($id_user);

    $data = [
        'Title'   => 'Editar Usuario',
        'usuario' => $usuario
    ];

    View::render('usuarios/user_form', $data);
}

    public function updatePass() {

        if (!isset($_SESSION['id_user'])) {
            header("Location: index.php?alert=3");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Guardar'])) {
            $id_user     = $_SESSION['id_user'];
            $old_pass    = md5(trim($_POST['old_pass']));
            $new_pass    = md5(trim($_POST['new_pass']));
            $retype_pass = md5(trim($_POST['retype_pass']));

            //obtenemos la contraseña actual
            $data = $this->usuariosModel->getPassById($id_user);

            // verificamos la contraseña vieja
            if (!$data || $old_pass !== $data['password']) {
                header("Location: index.php?controller=Usuarios&action=indexPass&alert=1");
                exit();
            }

            // verificamos si coinsiden las contraseñas nuevas y no queden vacíos
            if (empty($_POST['new_pass']) || $new_pass !== $retype_pass) {
                header("Location: index.php?controller=Usuarios&action=indexPass&alert=2");
                exit();
            }

            // si todo esta bien actualizamos la contraseña
            if ($this->usuariosModel->updatePassword($id_user, $new_pass)) {
                header("Location: index.php?controller=Usuarios&action=indexPass&alert=3");
                exit();
            } else {
                header("Location: index.php?controller=Usuarios&action=indexPass&alert=4");
                exit();
            }
        }
    }

    public function toggleUserStatus()
    {
        if (!isset($_SESSION['id_user'])) {
            header("Location: index.php?alert=3");
            exit();
        }

        if (isset($_GET['id']) && isset($_GET['act'])) {
            $id_user = $_GET['id'];
            $new_status = $_GET['act'] == 'on' ? 'activo' : 'bloqueado';

            if ($this->usuariosModel->updateUserStatus($id_user, $new_status)) {
                // Éxito: Redirige con el código de alerta 3 (activar) o 4 (bloquear)
                $alert_code = ($new_status == 'activo') ? 3 : 4;
                header("Location: index.php?controller=Usuarios&action=indexUser&alert=$alert_code");
            } else {
                // Error: Redirige con un código de alerta para error inesperado
                header("Location: index.php?controller=Usuarios&action=indexUser&alert=8");
            }
        }
        exit;
    }

    // Método para manejar la inserción de nuevos usuarios
    public function insert() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recogemos los datos del formulario y los saneamos
            $username = trim($_POST['username']);
            $name_user = trim($_POST['name_user']);
            // Hashing del password con MD5
            $password = md5(trim($_POST['password']));
            $permisos_acceso = $_POST['permisos_acceso'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];

            // Lógica para subir la foto si existe
            $foto = 'user-default.png'; // Valor por defecto
            if (!empty($_FILES['foto']['name'])) {
                $foto_name = $_FILES['foto']['name'];
                $foto_temp = $_FILES['foto']['tmp_name'];
                $path = 'images/user/' . $foto_name;
                move_uploaded_file($foto_temp, $path);
                $foto = $foto_name;
            }

            // Llamamos al método del modelo para insertar al usuario
            $result = $this->usuariosModel->insertUser($username, $password, $name_user, $permisos_acceso, $email, $telefono, $foto);

            if ($result) {
                header("Location: index.php?controller=Usuarios&action=indexUser&alert=1"); // Éxito
            } else {
                header("Location: index.php?controller=Usuarios&action=add&alert=5"); // Error
            }
        }
        exit();
    }

    // Método para manejar la actualización de usuarios existentes
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Guardar'])) {
            $id_user = trim($_POST['id_user']);
            $username = trim($_POST['username']);
            $name_user = trim($_POST['name_user']);
            $email = trim($_POST['email']);
            $telefono = trim($_POST['telefono']);
            $permisos_acceso = trim($_POST['permisos_acceso']);

            // Asignamos null a la nueva foto y contraseña por defecto
            $new_foto = null;
            $new_password = null;

            // Verificar si se subió una nueva foto
            if (!empty($_FILES['foto']['name'])) {
                $foto_temp = $_FILES['foto']['tmp_name'];
                $foto_name = $_FILES['foto']['name'];
                $allowed_extensions = array('jpg', 'jpeg', 'png');
                $extension = strtolower(pathinfo($foto_name, PATHINFO_EXTENSION));
                $file_size = $_FILES['foto']['size'];

                if (in_array($extension, $allowed_extensions)) {
                    if ($file_size <= 1000000) {
                        $path = 'images/user/' . $foto_name;
                        if (move_uploaded_file($foto_temp, $path)) {
                            $new_foto = $foto_name;
                        } else {
                            // Error al subir archivo
                            header("Location: index.php?controller=Usuarios&action=indexUser&alert=5");
                            exit;
                        }
                    } else {
                        // Tamaño del archivo excedido
                        header("Location: index.php?controller=Usuarios&action=indexUser&alert=6");
                        exit;
                    }
                } else {
                    // Extensión no permitida
                    header("Location: index.php?controller=Usuarios&action=indexUser&alert=7");
                    exit;
                }
            }

            // Verificar si se proporcionó una nueva contraseña y hashearla
            if (!empty($_POST['password'])) {
                $new_password = md5(trim($_POST['password']));
            }

            // Lógica para actualizar el usuario en el modelo
            $result = $this->usuariosModel->updateUser($id_user, $username, $name_user, $email, $telefono, $permisos_acceso, $new_foto, $new_password);

            if ($result) {
                header("Location: index.php?controller=Usuarios&action=indexUser&alert=2"); // Éxito
            } else {
                header("Location: index.php?controller=Usuarios&action=edit&id=$id_user&alert=8"); // Error
            }
        }
        exit();
    }
}
