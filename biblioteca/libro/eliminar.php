<?php
include('../config.php');

if (isset($_GET['id'])) {
    $id_titulo = $_GET['id'];
    $query = "DELETE FROM titulos WHERE id_titulo = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $id_titulo);

    if ($stmt->execute()) {
        header("Location: listar.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
