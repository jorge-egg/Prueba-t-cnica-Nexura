<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <h1>Lista de empleados</h1>

    <a type="button" class="btn btn-primary" href="crear.php">Cear</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col"><i class="fa-solid fa-user"></i> Nombre</th>
                <th scope="col">@ Email</th>
                <th scope="col"><i class="fa-solid fa-venus-mars"></i> Sexo</th>
                <th scope="col"><i class="fa-solid fa-briefcase"></i> Area</th>
                <th scope="col"><i class="fa-solid fa-envelope"></i> Boletin</th>
                <th scope="col">Modificar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>@mdo</td>
                <td>@mdo</td>
                <td><i class="fa-solid fa-pen-to-square"></i></td>
                <td><i class="fa-solid fa-trash"></i></td>
            </tr>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>