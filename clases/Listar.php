<?php
// empleadoDAO.php
require_once __DIR__."/../config/database.php";

class Listar {
    private $con;

    public function __construct() {
        $this->con = getConexion();
    }

    // Listar empleados
    public function listarEmpleados() {
        $sql = "SELECT * FROM empleados";
        $stmt = $this->con->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear empleado
    public function crearEmpleado($nombre, $email, $sexo, $area, $boletin) {
        $sql = "INSERT INTO empleados (nombre, email, sexo, area, boletin) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([$nombre, $email, $sexo, $area, $boletin]);
    }
}
