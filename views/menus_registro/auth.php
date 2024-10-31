<?php
session_start();

if (!isset($_SESSION['identificador']) || !isset($_SESSION['tipo_usuario'])) {
    header("Location: login.php");
    exit();
}

$current_page = basename($_SERVER['PHP_SELF']);

if ($current_page === 'menu_adm.php' && $_SESSION['tipo_usuario'] !== 'Administrador') {
    header("Location: ../menus_registro/menu_adm.php");
    exit();
}

if ($current_page === 'menu_reg.php' && $_SESSION['tipo_usuario'] !== 'Registrado') {
    header("Location: ../menus_registro/menu_reg.php");
    exit();
}