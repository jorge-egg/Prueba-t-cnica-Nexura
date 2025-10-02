
/**
 * Valida que al menos un checkbox con la clase especificada esté marcado.
 *
 * @param {string} nameClass - Nombre de la clase que agrupa los checkboxes a validar.
 * @returns {boolean} - Devuelve true si al menos uno está marcado; false si ninguno lo está (y muestra un alert).
 */
function validarCheckboxes(nameClass) {
    const checkboxes = document.querySelectorAll('.' + nameClass);
    let alMenosUnoMarcado = false;
    checkboxes.forEach(cb => {
      if (cb.checked) {
        alMenosUnoMarcado = true;
      }
    });

    if (!alMenosUnoMarcado) {
      alert("Debes seleccionar al menos un rol.");
      return false;
    }

    return true;
  }

  /**
 * Valida que el texto no tenga numeros.
 *
 * @param {string} texto - texto.
 * @returns {boolean} - Devuelve true si el texto no contiene numeros.
 */
function sinNumeros(texto) {
  return !/[0-9]/.test(texto);
}

  /**
 * Valida que el texto no tenga caracteres especiales.
 *
 * @param {string} texto - texto.
 * @returns {boolean} - Devuelve true si el texto solo contiene letras y espacios.
 */
function sinCaracteresEspeciales(texto) {
  return /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(texto);
}

  /**
 * Valida que el texto sea un correo con la estructura valida.
 *
 * @param {string} correo - texto.
 * @returns {boolean} - Devuelve true si el correo tiene una estructura valida.
 */
function correoValido(correo) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo);
}


function validarFormulario(classCheck, idCorreo, idNumero, idCaractEsp) {
  let valido = true;

  const campoNumerico = document.getElementById(idNumero);
  const campoTexto = document.getElementById(idCaractEsp);
  const campoCorreo = document.getElementById(idCorreo);
  // Validar números
  if (!sinNumeros(campoNumerico.value)) {
    campoNumerico.classList.add("is-invalid");
    valido = false;
  } else {
    campoNumerico.classList.remove("is-invalid");
  }

  // Validar texto sin caracteres especiales
  if (!sinCaracteresEspeciales(campoTexto.value)) {
    campoTexto.classList.add("is-invalid");
    valido = false;
  } else {
    campoTexto.classList.remove("is-invalid");
  }

  // Validar correo
  if (!correoValido(campoCorreo.value)) {
    campoCorreo.classList.add("is-invalid");
    valido = false;
  } else {
    campoCorreo.classList.remove("is-invalid");
  }

  if(classCheck.trim() !== ""){
    valido = validarCheckboxes(classCheck) && valido;
  }

  return valido;
}

