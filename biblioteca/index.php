<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="/biblioteca/css/style.css" rel="stylesheet">
    <link rel="icon" href="./img/icono.png" type="image/x-icon"> 

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
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar libro" id="search-input" aria-label="Buscar">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>
    </div>
</nav>
<div class="container mt-4">
    <h1 class="text-center">Bienvenido a la Biblioteca</h1>
    <div class="row" id="books-container">
        <?php
        $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
        $query = "SELECT titulos.id_titulo, titulos.titulo, autores.nombre AS autor
                  FROM titulos 
                  LEFT JOIN titulo_autor ON titulos.id_titulo = titulo_autor.id_titulo
                  LEFT JOIN autores ON titulo_autor.id_autor = autores.id_autor
                  WHERE titulos.titulo LIKE '%$search%' OR autores.nombre LIKE '%$search%' 
                  ORDER BY titulos.id_titulo DESC";

        $result = $conn->query($query);

        if ($result) {
            if ($result->num_rows > 0) {
                echo "<table class='table table-bordered'>";
                echo "<thead class='thead-light'><tr><th>Título</th><th>Autor</th><th>Acciones</th></tr></thead>";
                echo "<tbody>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='titulo'>{$row['titulo']}</td>";
                    echo "<td class='autor'>{$row['autor']}</td>";
                    echo "<td>
                            <a href='/biblioteca/libro/editar.php?id={$row['id_titulo']}' class='btn btn-warning btn-sm mr-2'>Editar</a>
                            <a href='/biblioteca/libro/eliminar.php?id={$row['id_titulo']}' class='btn btn-danger btn-sm'>Eliminar</a>
                          </td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p class='text-center'>No se encontraron libros.</p>";
            }
        } else {
            echo "<p class='text-center'>Error en la consulta: " . $conn->error . "</p>";
        }
        ?>
    </div>
</div>
<script src="./Js/script.js"></script>
</body>
</html>
