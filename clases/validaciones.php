<?php

class validaciones{

    /**
     * Verifica que una cadena de textos no contiene numeros
     * @param mixed $cadena
     * @return bool si no tiene numeros retorna TRUE, de lo contrario FALSO.
     */
    public function sinNumeros($cadena): bool{
        return !preg_match('/\d/', $cadena);
    }

    /**
     * Verifica que la cadena de texto no tenga tildes.
     * @param mixed $cadena cadena de texto.
     * @return bool Si no encuentra tildes en el texto, devuelve true.
     */
    public function sinTilde($cadena): bool{
        return !preg_match('/[áéíóúÁÉÍÓÚ]/u', $cadena);
    }

    /**
     * Verifica que la cadena de texto no tenga espacios.
     * @param mixed $cadena cadena de texto.
     * @return bool Si no encuentra espacios en el texto, devuelve true.
     */
    public function sinEspacios($cadena): bool{
        return strpos($cadena, ' ') === false;
    }

    /**
     * Verifica que el correo cumpla con la estructura adecuada.
     * @param mixed $cadena correo a verificar.
     * @return bool Si el correo es valido devuelve TRUE, de lo contrario devuelve FALSE.
     */
    public function email($cadena): bool{
        return filter_var($cadena, FILTER_VALIDATE_EMAIL) !== false;

    }

    /**
     * Verifica que el texto no tenga caracteres especiales.
     * @param mixed $cadena texto a verificar.
     * @return bool Si el texto no tiene caracteres especiales devulve true..
     */
    public function sinCaractEsp($cadena){
        return preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 ]+$/', $cadena);
    }

}