<?php
header('Content-Type: text/html; charset=UTF-8');
require_once __DIR__."/clases/Controller.php";


$listarClass = new Controller();
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
    <?php
        session_start();
        if (isset($_SESSION['mensaje'])) {
            echo "<div class='alert alert-{$_SESSION['tipo_mensaje']} alert-dismissible fade show' role='alert'>
                    {$_SESSION['mensaje']}
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            unset($_SESSION['mensaje']);
            unset($_SESSION['tipo_mensaje']);
        }
    ?>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Lista de empleados</h1>
        <a class="btn btn-primary" href="formulario.php">
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
                <td><?= htmlspecialchars($item['nombre']) ?></td>
                <td><?= htmlspecialchars($item['email']) ?></td>
                <td><?= htmlspecialchars($item['sexo']) ?></td>
                <td><?= htmlspecialchars($item['area']) ?></td>
                <td><?= htmlspecialchars($item['boletin']?"Si":"No") ?></td>
                <td><a href="/formulario.php/<?= htmlspecialchars($item['id']) ?>" class="text-primary"><i class="fa-solid fa-pen-to-square"></i></a></td>
                <td><button type="button"
                        class="btn text-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#modalEliminar">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
            <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="modalEliminarLabel">¿Estás seguro?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        Esta acción eliminará el registro permanentemente.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form id="formEliminar" method="POST" action="/clases/Controller.php">
                        <input type="hidden" name="accion" value="eliminar">
                        <input type="hidden" name="id" id="idEliminar">
                        <button type="submit" class="btn btn-danger" name="accion" value="eliminar|<?= htmlspecialchars($item['id']) ?>">Eliminar</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
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
