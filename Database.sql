-- Es importante resaltar que indicar el ancho de los enteros es una funcionalidad obsoleta en las ultimas versiones de MySQL.

CREATE DATABASE PRUEBATECNICA;
USE PRUEBATECNICA;

-- Tabla: areas
CREATE TABLE areas (
    id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del área',
    nombre VARCHAR(255) NOT NULL COMMENT 'Nombre del área de la empresa',
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla: roles
CREATE TABLE roles (
    id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del rol',
    nombre VARCHAR(255) NOT NULL COMMENT 'Nombre del rol',
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla: empleados
CREATE TABLE empleados (
    id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del empleado',
    nombre VARCHAR(255) NOT NULL COMMENT 'Nombre completo del empleado. Solo letras con o sin acentos. No se admiten números ni símbolos.',
    email VARCHAR(255) NOT NULL COMMENT 'Correo electrónico del empleado. Solo una dirección válida, sin espacios ni caracteres especiales.',
    sexo CHAR(1) NOT NULL COMMENT 'M para Masculino. F para Femenino.',
    area_id INT(11) NOT NULL COMMENT 'Área a la que pertenece el empleado. Campo tipo Select.',
    boletin TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'Recibe boletín informativo. Campo tipo Checkbox.',
    descripcion TEXT NOT NULL COMMENT 'Descripción de la experiencia del empleado. Campo tipo Textarea.',
    PRIMARY KEY (id),
    FOREIGN KEY (area_id) REFERENCES areas(id)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla: empleado_rol (relación muchos a muchos)
CREATE TABLE empleado_rol (
    empleado_id INT(11) NOT NULL COMMENT 'Identificador del empleado',
    rol_id INT(11) NOT NULL COMMENT 'Identificador del rol',
    PRIMARY KEY (empleado_id, rol_id),
    FOREIGN KEY (empleado_id) REFERENCES empleados(id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (rol_id) REFERENCES roles(id)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;