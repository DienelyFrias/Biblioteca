<?php
include('../config.php');

if (isset($_GET['id'])) {
    $id_autor = $conn->real_escape_string($_GET['id']);

    $sql_biografia = "DELETE FROM biografias WHERE id_autor='$id_autor'";
    $sql_imagen = "DELETE FROM fotografias WHERE id_autor='$id_autor'";
    $sql_autor = "DELETE FROM autores WHERE id_autor='$id_autor'";

    if ($conn->query($sql_biografia) === TRUE && $conn->query($sql_imagen) === TRUE && $conn->query($sql_autor) === TRUE) {
        echo "<div class='alert alert-success text-center'>Autor eliminado correctamente</div>";
        header("Location: listar.php");
    } else {
        echo "<div class='alert alert-danger text-center'>Error: " . $conn->error . "</div>";
    }
} else {
    echo "ID de autor no especificado.";
}
?>
