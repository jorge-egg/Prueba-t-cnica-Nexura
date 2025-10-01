<?php header('Content-Type: text/html; charset=UTF-8'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear empleado</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-4">
    <h1>Crear empleado</h1>

    <!-- Aviso -->
    <div class="alert alert-info" role="alert">
      Los campos con asteriscos (*) son obligatorios
    </div>

    <!-- Formulario -->
    <form>
      <!-- Nombre -->
      <div class="row mb-3">
        <label for="nombreCompleto" class="col-sm-2 col-form-label fw-bold">Nombre completo *</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="nombreCompleto" placeholder="Nombre completo del empleado" required>
        </div>
      </div>

      <!-- Correo -->
      <div class="row mb-3">
        <label for="email" class="col-sm-2 col-form-label fw-bold">Correo electrónico *</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" id="email" placeholder="Correo electrónico" required>
        </div>
      </div>

      <!-- Sexo -->
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label fw-bold">Sexo *</label>
        <div class="col-sm-10">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="sexo" id="masculino" value="M">
            <label class="form-check-label" for="masculino">Masculino</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="sexo" id="femenino" value="F" checked>
            <label class="form-check-label" for="femenino">Femenino</label>
          </div>
        </div>
      </div>

      <!-- Área -->
      <div class="row mb-3">
        <label for="area" class="col-sm-2 col-form-label fw-bold">Área *</label>
        <div class="col-sm-10">
          <select class="form-select" id="area">
            <option selected>Administración</option>
            <option>Contabilidad</option>
            <option>Recursos Humanos</option>
            <option>Sistemas</option>
            <option>Comercial</option>
          </select>
        </div>
      </div>

      <!-- Descripción -->
      <div class="row mb-3">
        <label for="descripcion" class="col-sm-2 col-form-label fw-bold">Descripción *</label>
        <div class="col-sm-10">
          <textarea class="form-control" id="descripcion" rows="3" placeholder="Descripción de la experiencia del empleado"></textarea>
        </div>
      </div>

      <!-- Boletín -->
      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="boletin">
        <label class="form-check-label" for="boletin">
          Deseo recibir boletín informativo
        </label>
      </div>

      <!-- Roles -->
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label fw-bold">Roles *</label>
        <div class="col-sm-10">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="rol1">
            <label class="form-check-label" for="rol1">Profesional de proyectos - Desarrollador</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="rol2">
            <label class="form-check-label" for="rol2">Gerente estratégico</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="rol3">
            <label class="form-check-label" for="rol3">Auxiliar administrativo</label>
          </div>
        </div>
      </div>

      <!-- Botón -->
      <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
