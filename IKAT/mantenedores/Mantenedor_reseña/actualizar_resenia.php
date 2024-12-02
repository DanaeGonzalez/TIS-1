<?php
include '../../config/conexion.php';
session_start();


                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $id_resenia = $_POST['id_resenia'];
                        $calificacion = $_POST['calificacion'];
                        $comentario = $_POST['comentario'];

                        $sql = "UPDATE resenia SET calificacion=$calificacion, comentario='$comentario'
                                WHERE id_resenia=$id_resenia";

                        if ($conn->query($sql) === TRUE) {
                            $_SESSION['mensaje'] = "Reseña actualizada exitosamente <br>";
                        } else {
                            $_SESSION['mensaje'] = "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
                        }
                    }

                    header("Location: mostrar_resenia.php");
                    exit();
                
?>


