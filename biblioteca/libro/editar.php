<?php
include('../config.php');

if (isset($_GET['id'])) {
    $id_titulo = $_GET['id'];
    $query = "SELECT * FROM titulos WHERE id_titulo = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $id_titulo);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if (!$row) {
        echo "Libro no encontrado.";
        exit;
    }
} else {
    echo "ID de libro no especificado.";
    exit;
}

if (isset($_POST['update'])) {
    $id_titulo = $_POST['id_titulo'];
    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $notas = $_POST['notas'];

    $query = "UPDATE titulos SET titulo = ?, precio = ?, notas = ? WHERE id_titulo = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sdss', $titulo, $precio, $notas, $id_titulo);

    if ($stmt->execute()) {
        header("Location: listar.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Libro</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="icon" href="../img/icono.png" type="image/x-icon"> 
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Editar Libro</h2>
        <form method="post" action="editar.php">
            <input type="hidden" name="id_titulo" value="<?php echo $row['id_titulo']; ?>">
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo htmlspecialchars($row['titulo'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="<?php echo $row['precio']; ?>" required>
            </div>
            <div class="form-group">
                <label for="notas">Notas</label>
                <textarea class="form-control" id="notas" name="notas" required><?php echo htmlspecialchars($row['notas'], ENT_QUOTES, 'UTF-8'); ?></textarea>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" name="update" class="btn btn-primary">Actualizar</button>
                <a href="listar.php" class="btn btn-secondary">Volver atrás</a>
            </div>
        </form>
    </div>
</body>
</html>
