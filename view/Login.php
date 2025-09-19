
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes" name="viewport">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="SysWeb">
    <meta name="autor" content="Jorge Ibarrola">
    <title>SysWeb | Iniciar Sesion</title>

    <link rel="shortcut icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/AdminLTE.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
</head>

<body class="hold-transition login-page">

    <div class="container">

        <div class="login-box">
            <div class="login-logo">
                <img src="assets/img/favicon.ico" alt="logo SysWeb" height="50" class="mt-15px">
                <b class="fs-3 text-primary">SysWeb</b>
            </div>

            <?php
            if (empty($_GET['alert'])) {
                echo "";
            } else if ($_GET['alert'] == 1) {
                echo "<div class='alert alert-danger' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h3><i class='icon fa fa-times-circle'></i>Error al iniciar Sessión!</h3>
                        <p>Usuario o contraseña incorrecta, vuelva a ingresar sus datos.</p>
                        </div>";
            } else if ($_GET['alert'] == 2) {
                echo "<div class='alert alert-success' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h3><i class='icon fa fa-check-circle'></i>Sesión cerrada!</h3>
                        <p>Su sesión se ha cerrado correctamente.</p>
                        </div>";
            } else if ($_GET['alert'] == 3) {
                echo "<div class='alert alert-warning' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h3><i class='icon fa fa-exclamation-triangle'></i>Acceso no autorizado!</h3>
                        <p>Necesitas iniciar sesión para acceder a esta página.</p>
                        </div>";
            }
            ?>

            <div class="login-box-body shadow-lg p-3 mb-5 bg-body rounded">
                <p class="login-box-msg"><i class="fa fa-user icon-title"></i>Por favor inicie sessión</p>
                <hr style="height: 2px; background-color: #1A7595;">

                <form action="index.php?controller=Login&action=login" method="POST">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="username" placeholder="Usuario" autocomplete="off" require>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <br>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="password" placeholder="Contraseña" autocomplete="off" require>
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