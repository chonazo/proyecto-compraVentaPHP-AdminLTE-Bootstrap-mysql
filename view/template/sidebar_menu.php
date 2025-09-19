<?php
// Usamos la variable $user que viene del controlador
$permisos = htmlspecialchars($user['permisos_acceso'] ?? '');
?>
<ul class="sidebar-menu">
    <li class="header">Menu</li>
    
    <li class="<?php echo ($_GET['controller'] ?? '') == 'Dashboard' && ($_GET['action'] ?? '') == 'index' ? 'active' : ''; ?>">
        <a href="index.php?controller=Dashboard&action=index"><i class="fa fa-home"></i>Inicio</a>
    </li>

    <?php if ($permisos == "super_admin"): ?>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-file-text"></i> <span>Referenciales generales</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="index.php?controller=Ciudad&action=index"><i class="fa fa-circle-o"></i> Ciudad</a></li>
                <li><a href="index.php?controller=Deposito&action=index"><i class="fa fa-circle-o"></i> Depósito</a></li>
            </ul>
        </li>
    <?php endif; ?>
    
    <?php if ($permisos == "otro_rol"): ?>
        <?php endif; ?>
</ul>