<?php include('../config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear Libro</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="icon" href="../img/icono.png" type="image/x-icon"> 
</head>
<body>
<div class="container mt-4">
    <h2 class="text-center">Crear Libro</h2>
    <form action="crear.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
        <div class="form-group">
            <label for="autor_id">Autor</label>
            <select class="form-control" id="autor_id" name="autor_id" required>
                <?php
                $result = $conn->query("SELECT id_autor, nombre FROM autores");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['id_autor']}'>{$row['nombre']}</option>";
                    }
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="listar.php" class="btn btn-secondary">Volver atrás</a>
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $conn->real_escape_string($_POST['titulo']);
    $autor_id = $conn->real_escape_string($_POST['autor_id']);
    $imagen = $_FILES['imagen']['name'];
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($imagen);

    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    if($check !== false) {
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {

            $sql_libro = "INSERT INTO libros (titulo, autor_id, imagen) VALUES ('$titulo', '$autor_id', '$imagen')";
            
            if ($conn->query($sql_libro) === TRUE) {
                echo "<div class='alert alert-success text-center'>Nuevo libro creado correctamente</div>";
            } else {
                echo "<div class='alert alert-danger text-center'>Error: " . $conn->error . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger text-center'>Error al subir la imagen.</div>";
        }
    } else {
        echo "<div class='alert alert-danger text-center'>El archivo no es una imagen válida.</div>";
    }
}
?>

</body>
</html>
