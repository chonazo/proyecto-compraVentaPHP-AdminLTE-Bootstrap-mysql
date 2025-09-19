<section class="content-header">
    <h1>
        <i class="fa fa-home icon-title"></i> Inicio
    </h1>
    <ol class="breadcrumb">
        <li><a href="?controller=Dashboard&action=index"><i class="fa fa-home"></i> Inicio</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-body">
                    <p>
                        Hola, **<?php echo htmlspecialchars($_SESSION['name_user'] ?? ''); ?>**. Bienvenido a la aplicación web.
                    </p>
                    <p>
                        A través del menú lateral, puedes acceder a las diferentes funcionalidades de la aplicación.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>