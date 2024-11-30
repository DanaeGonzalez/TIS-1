<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$current_page = basename($_SERVER['PHP_SELF']);

// Permitir acceso sin sesión solo al catálogo
if (
    $current_page !== 'catalogo.php' &&
    $current_page !== 'catalogo_cama.php' &&
    $current_page !== 'catalogo_mesa.php' &&
    $current_page !== 'catalogo_organizacion.php' &&
    $current_page !== 'catalogo_silla.php' &&
    $current_page !== 'catalogo_sillon.php' &&
    $current_page !== 'producto.php' && (!isset($_SESSION['identificador']) || !isset($_SESSION['tipo_usuario']))
) {
    header("Location: /xampp/TIS-1/IKAT/views/menu_registro/login.php");
    exit();
}

// Redireccionar según el tipo de usuario para las páginas específicas
if ($current_page === 'menu_adm.php' && $_SESSION['tipo_usuario'] !== 'Admin') {
    header("Location: /xampp/TIS-1/IKAT/views/menu_rol/menu_adm.php");
    exit();
}

if ($current_page === 'menu_reg.php' && $_SESSION['tipo_usuario'] !== 'Registrado') {
    header("Location: /xampp/TIS-1/IKAT/views/menu_rol/menu_reg.php");
    exit();
}

if ($current_page === 'menu_supadm.php' && $_SESSION['tipo_usuario'] !== 'Superadmin') {
    header("Location: /xampp/TIS-1/IKAT/views/menu_rol/menu_supadm.php");
    exit();
}
