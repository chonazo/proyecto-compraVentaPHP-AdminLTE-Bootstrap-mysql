<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes" name="viewport">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="SysWeb">
    <meta name="autor" content="Jorge Ibarrola">
    <title>SysWeb | Iniciar Sesión</title>

    <link rel="shortcut icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/AdminLTE.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <script>
        // Prevenimos que el navegador cachee la página
        window.onpageshow = function(event) {
            if (event.persisted) {
                window.location.reload();
            }
        };

        // Evitamos que el usuario regrese a páginas anteriores
        history.pushState(null, null, location.href);
        window.onpopstate = function() {
            history.go(1);
        };
    </script>
</head>

<body class="hold-transition login-page">

    <div class="container">
        <div class="login-box">
            <div class="login-logo">
                <img src="assets/img/favicon.ico" alt="logo SysWeb" height="50" class="mt-15px">
                <b class="fs-3 text-primary">SysWeb</b>
            </div>

            <?php
            // Mapeo de los códigos de alerta a mensajes y estilos
            $alertMessages = [
                1 => ['type' => 'danger', 'title' => 'Error al iniciar Sesión!', 'text' => 'Usuario o contraseña incorrecta, vuelva a ingresar sus datos.'],
                2 => ['type' => 'success', 'title' => 'Sesión cerrada!', 'text' => 'Su sesión se ha cerrado correctamente.'],
                3 => ['type' => 'danger', 'title' => 'Acceso no autorizado!', 'text' => 'Necesitas iniciar sesión para acceder a esta página.'],
                4 => ['type' => 'danger', 'title' => 'Acción no autorizada!', 'text' => 'Debes ingresar tus datos, las casillas no deben estar vacías.'],
            ];

            if (isset($_GET['alert']) && array_key_exists($_GET['alert'], $alertMessages)) {
                $alert = $alertMessages[$_GET['alert']];
                $alert_class = ($alert['type'] === 'success') ? 'alert-success' : 'alert-danger';
                $icon_class = ($alert['type'] === 'success') ? 'fa-exclamation-triangle' : 'fa-times-circle'; // Se cambió el ícono para éxito a `fa-exclamation-triangle` para coincidir con tu diseño original.
                ?>
                <div class='alert <?= $alert_class ?>' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h3><i class='icon fa <?= $icon_class ?>'></i> <?= $alert['title'] ?></h3>
                    <p><?= $alert['text'] ?></p>
                </div>
                <?php
            }
            ?>

            <div class="login-box-body shadow-lg p-3 mb-5 bg-body rounded">
                <p class="login-box-msg"><i class="fa fa-user icon-title"></i>Por favor inicie sesión</p>
                <hr style="height: 2px; background-color: #1A7595;">

                <form action="index.php?controller=Login&action=login" method="POST">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="username" placeholder="Usuario" autocomplete="off" required>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <br>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="password" placeholder="Contraseña" autocomplete="off" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="submit" class="btn btn-primary btn-block btn-flat" name="login" value="Iniciar Sesión">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
</body>

</html>