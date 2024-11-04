<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['identificador']) || !isset($_SESSION['tipo_usuario'])) {
header("Location: /xampp/IKAT/views/menu_registro/login.php");
exit();
}

$current_page = basename($_SERVER['PHP_SELF']);

if ($current_page === 'menu_adm.php' && $_SESSION['tipo_usuario'] !== 'Admin') {
    header("Location: /xampp/IKAT/views/menu_rol/menu_adm.php");
    exit();
}

if ($current_page === 'menu_reg.php' && $_SESSION['tipo_usuario'] !== 'Registrado') {
    header("Location: /xampp/IKAT/views/menu_rol/menu_reg.php");
    exit();
}

if ($current_page === 'menu_supadm.php' && $_SESSION['tipo_usuario'] !== 'Superadmin') {
    header("Location: /xampp/IKAT/views/menu_rol/menu_supadm.php");
    exit();
}