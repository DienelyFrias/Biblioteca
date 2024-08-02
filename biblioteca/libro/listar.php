<?php include('../config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Libros</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="icon" href="../img/icono.png" type="image/x-icon"> 
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/biblioteca/index.php">Biblioteca</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/biblioteca/autor/listar.php">Autores</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/biblioteca/libro/listar.php">Libros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/biblioteca/contacto.php">Contacto</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" id="search-form">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar" id="search-input" aria-label="Buscar">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>
    </div>
</nav>
<div class="container mt-4">
    <h2 class="text-center">Libros</h2>
    <a href="crear.php" class="btn btn-primary mb-4">Nuevo Libro</a>
    <div class="row">
        <?php
        $result = $conn->query("SELECT titulos.id_titulo, titulos.titulo, autores.nombre AS autor
                                FROM titulos
                                LEFT JOIN titulo_autor ON titulos.id_titulo = titulo_autor.id_titulo
                                LEFT JOIN autores ON titulo_autor.id_autor = autores.id_autor");
        if ($result->num_rows > 0) {
            echo "<table class='table table-bordered'>";
            echo "<thead class='thead-light'><tr><th>ID</th><th>Título</th><th>Autor</th><th>Acciones</th></tr></thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['id_titulo']}</td>";
                echo "<td class='titulo'>{$row['titulo']}</td>";
                echo "<td class='autor'>{$row['autor']}</td>";
                echo "<td>
                        <div class='btn-group-custom'>
                            <a href='editar.php?id={$row['id_titulo']}' class='btn btn-warning btn-sm btn-editar'>Editar</a>
                            <a href='eliminar.php?id={$row['id_titulo']}' class='btn btn-danger btn-sm btn-eliminar'>Eliminar</a>
                        </div>
                      </td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p class='text-center'>No se encontraron libros.</p>";
        }
        ?>
    </div>
</div>
<script src="../Js/script.js"></script>
</body>
</html>
