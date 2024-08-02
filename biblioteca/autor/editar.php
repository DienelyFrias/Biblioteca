

<?php 
include('../config.php'); 

if (isset($_GET['id'])) {
    $id_autor = $conn->real_escape_string($_GET['id']);
    $result = $conn->query("SELECT a.*, b.biografia 
                            FROM autores a
                            LEFT JOIN biografias b ON a.id_autor = b.id_autor
                            WHERE a.id_autor = '$id_autor'");
    if ($result->num_rows > 0) {
        $autor = $result->fetch_assoc();
    } else {
        echo "Autor no encontrado.";
        exit;
    }
} else {
    echo "ID de autor no especificado.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_autor = $conn->real_escape_string($_POST['id_autor']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellido = $conn->real_escape_string($_POST['apellido']);
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $direccion = $conn->real_escape_string($_POST['direccion']);
    $ciudad = $conn->real_escape_string($_POST['ciudad']);
    $estado = $conn->real_escape_string($_POST['estado']);
    $pais = $conn->real_escape_string($_POST['pais']);
    $cod_postal = intval($_POST['cod_postal']);
    $biografia = $conn->real_escape_string($_POST['biografia']);

    $sql_autor = "UPDATE autores SET nombre='$nombre', apellido='$apellido', telefono='$telefono', direccion='$direccion', ciudad='$ciudad', estado='$estado', pais='$pais', cod_postal='$cod_postal' WHERE id_autor='$id_autor'";
    $sql_biografia = "UPDATE biografias SET biografia='$biografia' WHERE id_autor='$id_autor'";
    
    if ($conn->query($sql_autor) === TRUE && $conn->query($sql_biografia) === TRUE) {
        echo "<div class='alert alert-success text-center'>Autor actualizado correctamente</div>";
        header("Location: listar.php");
    } else {
        echo "<div class='alert alert-danger text-center'>Error: " . $conn->error . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Autor</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="icon" href="./img/icono.png" type="image/x-icon"> 
</head>
<body>
<div class="container mt-4">
    <h2 class="text-center">Editar Autor</h2>
    <form action="editar.php?id=<?php echo $autor['id_autor']; ?>" method="post">
        <div class="form-group">
            <label for="id_autor">ID Autor</label>
            <input type="text" class="form-control" id="id_autor" name="id_autor" value="<?php echo $autor['id_autor']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $autor['nombre']; ?>" required>
        </div>
        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $autor['apellido']; ?>" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $autor['telefono']; ?>" required>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $autor['direccion']; ?>" required>
        </div>
        <div class="form-group">
            <label for="ciudad">Ciudad</label>
            <input type="text" class="form-control" id="ciudad" name="ciudad" value="<?php echo $autor['ciudad']; ?>" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" class="form-control" id="estado" name="estado" value="<?php echo $autor['estado']; ?>" required>
        </div>
        <div class="form-group">
            <label for="pais">País</label>
            <input type="text" class="form-control" id="pais" name="pais" value="<?php echo $autor['pais']; ?>" required>
        </div>
        <div class="form-group">
            <label for="cod_postal">Código Postal</label>
            <input type="number" class="form-control" id="cod_postal" name="cod_postal" value="<?php echo $autor['cod_postal']; ?>" required>
        </div>
        <div class="form-group">
            <label for="biografia">Biografía</label>
            <textarea class="form-control" id="biografia" name="biografia" rows="3" required><?php echo $autor['biografia']; ?></textarea>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="listar.php" class="btn btn-secondary mt-2">Volver atrás</a>
        </div>
    </form>
</div>
</body>
</html>
