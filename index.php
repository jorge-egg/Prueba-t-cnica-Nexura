<?php
header('Content-Type: text/html; charset=UTF-8');
require_once __DIR__."/clases/Listar.php";


$listarClass = new Listar();
$empleadosList = $listarClass->listarEmpleados();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de empleados</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Lista de empleados</h1>
        <a class="btn btn-primary" href="crear.php">
            <i class="fa-solid fa-user-plus"></i> Crear
        </a>
    </div>

    <table class="table table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th scope="col"><i class="fa-solid fa-user"></i> Nombre</th>
                <th scope="col"><i class="fa-solid fa-at"></i> Email</th>
                <th scope="col"><i class="fa-solid fa-venus-mars"></i> Sexo</th>
                <th scope="col"><i class="fa-solid fa-briefcase"></i> Área</th>
                <th scope="col"><i class="fa-solid fa-envelope"></i> Boletín</th>
                <th scope="col">Modificar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(!empty($empleadosList)){
                    foreach($empleadosList as $item){
            ?>
            <tr>
                <td><?= htmlspecialchars($emp['nombre']) ?></td>
                <td><?= htmlspecialchars($emp['email']) ?></td>
                <td><?= htmlspecialchars($emp['sexo']) ?></td>
                <td><?= htmlspecialchars($emp['area_id']) ?></td>
                <td><?= htmlspecialchars($emp['boletin']) ?></td>
                <td><a href="#" class="text-primary"><i class="fa-solid fa-pen-to-square"></i></a></td>
                <td><a href="#" class="text-danger"><i class="fa-solid fa-trash"></i></a></td>
            </tr>
            <?php
                    }
                }else{
            ?>
            <tr>
                <td colspan="7" class="text-center text-muted">
                    No hay registros disponibles
                </td>
            </tr>
            <?php
                    }
            ?>
            
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
