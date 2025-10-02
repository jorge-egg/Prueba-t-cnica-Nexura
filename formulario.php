<?php
header('Content-Type: text/html; charset=UTF-8');
require_once __DIR__."/clases/Controller.php";
$listarClass = new Controller();
$edit = false;
$request = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
if(isset($request[2])){
  $getDataEmpleado = $listarClass->getDataEmpleado($request[2]);
  $edit = true;
  $roles = explode(",", $getDataEmpleado[0]["roles"]);
}

$rolesList = $listarClass->getRoles();
$areasList = $listarClass->getAreas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $edit ? "Editar" : "Crear" ?> empleado</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-4">
    <h1><?= $edit ? "Editar" : "Crear" ?> empleado</h1>
    <div class="alert alert-info" role="alert">
      Los campos con asteriscos (*) son obligatorios
    </div>
    

    <form action="clases/Controller.php" method="POST" onsubmit="return validarFormulario('form-check-input-rol', 'email', 'nombreCompleto', 'nombreCompleto')">
      <!-- Nombre -->
      <div class="row mb-3">
        <label for="nombreCompleto" class="col-sm-2 col-form-label fw-bold">Nombre completo *</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="nombreCompleto" placeholder="Nombre completo del empleado" required name="nombre" value="<?= $edit ? $getDataEmpleado[0]["nombre"] : "" ?>">
          <div class="invalid-feedback">El nombre contiene numeros o caracteres especiales.</div>
        </div>
      </div>

      <!-- Correo -->
      <div class="row mb-3">
        <label for="email" class="col-sm-2 col-form-label fw-bold">Correo electrónico *</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" id="email" placeholder="Correo electrónico" required name="email" value="<?= $edit ? $getDataEmpleado[0]["email"] : "" ?>">
        </div>
      </div>

      <!-- Sexo -->
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label fw-bold">Sexo *</label>
        <div class="col-sm-10">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="sexo" id="masculino" value="M" <?= $edit && $getDataEmpleado[0]["sexo"] == "M"? "checked" : "" ?> <?= $edit == false ? "checked" : "" ?> name="sexo">
            <label class="form-check-label" for="masculino">Masculino</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="sexo" id="femenino" value="F" <?= $edit && $getDataEmpleado[0]["sexo"] == "F"? "checked" : "" ?> name="sexo">
            <label class="form-check-label" for="femenino">Femenino</label>
          </div>
        </div>
      </div>

      <!-- Área -->
      <div class="row mb-3">
        <label for="area" class="col-sm-2 col-form-label fw-bold">Área *</label>
        <div class="col-sm-10">
          <select class="form-select" id="area" name="area" required>
            <?php foreach($areasList as $item){ ?>
              <option value="<?= htmlspecialchars($item['id']) ?>" <?= $edit && $getDataEmpleado[0]["area"] == $item['id']? "selected" : "" ?>><?= htmlspecialchars($item['nombre']) ?></option>
            <?php } ?>
          </select>
        </div>
      </div>

      <!-- Descripción -->
      <div class="row mb-3">
        <label for="descripcion" class="col-sm-2 col-form-label fw-bold">Descripción *</label>
        <div class="col-sm-10">
          <textarea class="form-control" id="descripcion" rows="3" placeholder="Descripción de la experiencia del empleado" name="descripcion" required><?= $edit ? $getDataEmpleado[0]["descripcion"] : "" ?></textarea>
        </div>
      </div>

      <!-- Boletín -->
      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="boletin" name="boletin" <?= $edit && $getDataEmpleado[0]["boletin"] ? "checked" : "" ?>>
        <label class="form-check-label" for="boletin">
          Deseo recibir boletín informativo
        </label>
      </div>

      <!-- Roles -->
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label fw-bold">Roles *</label>
        <div class="col-sm-10">
          <?php foreach($rolesList as $item){ ?>
            <div class="form-check">
            <input class="form-check-input-rol" type="checkbox"
              id="rol<?= htmlspecialchars($item['id']) ?>"
              name="roles[]"
              value="<?= htmlspecialchars($item['id']) ?>"
              <?= $edit && in_array($item['id'], $roles) ? "checked" : "" ?>>
            <label class="form-check-label" for="rol<?= htmlspecialchars($item['id']) ?>"><?= htmlspecialchars($item['nombre']) ?></label>
          </div>
          <?php } ?>
        </div>
      </div>

      <button type="submit" name="accion" value="<?= $edit ? "actualizar|".$request[2] : "crear" ?>" class="btn btn-primary">Guardar</button>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/js/validaciones.js"></script>
</body>
</html>
