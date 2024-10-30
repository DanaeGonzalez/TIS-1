<?php
session_start();
session_destroy();
header("Location: login.php");
exit(); // Es buena práctica agregar exit después de header()
?>