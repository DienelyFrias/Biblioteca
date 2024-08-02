<?php include('../config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Autores</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="icon" href="../img/icono.png" type="image/x-icon"> 
</head>
<style>
    .btn-editar:hover, .btn-eliminar:hover {
    opacity: 0.8;
}
.table td {
    vertical-align: middle;
}
.btn-group-custom {
    display: flex;
    gap: 10px;
}
</style>
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
    <h2 class="text-center">Autores</h2>
    <a href="crear.php" class="btn btn-primary mb-4">Nuevo Autor</a>
    <div class="row">
        <?php
        $result = $conn->query("SELECT a.id_autor, a.nombre, a.apellido, a.telefono, a.direccion, a.ciudad, a.estado, a.pais, a.cod_postal FROM autores a");
        if ($result->num_rows > 0) {
            echo "<table class='table table-bordered'>";
            echo "<thead class='thead-light'><tr><th>ID</th><th>Apellido</th><th>Nombre</th><th>Teléfono</th><th>Dirección</th><th>Ciudad</th><th>Estado</th><th>País</th><th>Código Postal</th><th>Acciones</th></tr></thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['id_autor']}</td>";
                echo "<td class='apellido'>{$row['apellido']}</td>";
                echo "<td class='nombre'>{$row['nombre']}</td>";
                echo "<td>{$row['telefono']}</td>";
                echo "<td>{$row['direccion']}</td>";
                echo "<td>{$row['ciudad']}</td>";
                echo "<td>{$row['estado']}</td>";
                echo "<td>{$row['pais']}</td>";
                echo "<td>{$row['cod_postal']}</td>";
                echo "<td>
                        <div class='btn-group-custom'>
                            <a href='editar.php?id={$row['id_autor']}' class='btn btn-warning btn-sm btn-editar'>Editar</a>
                            <a href='eliminar.php?id={$row['id_autor']}' class='btn btn-danger btn-sm btn-eliminar'>Eliminar</a>
                        </div>
                      </td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p class='text-center'>No se encontraron autores.</p>";
        }
        ?>
    </div>
</div>
<script src="../Js/script.js"></script>
</body>
</html>
