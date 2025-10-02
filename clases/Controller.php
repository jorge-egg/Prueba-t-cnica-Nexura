<?php
session_start();

require_once __DIR__."/../config/database.php";
require_once __DIR__."/validaciones.php";

class Controller {
    private $con;

    public function __construct() {
        $this->con = getConexion();
    }

    /**
     * Obtener areas.
     * @return array de areas.
     */
    public function getAreas() {
        $sql = "SELECT * FROM areas ORDER BY id ASC";
        $stmt = $this->con->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtener roles.
     * @return array de roles.
     */
    public function getRoles() {
        $sql = "SELECT * FROM roles ORDER BY id ASC";
        $stmt = $this->con->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Funcion encargada de listar los empleados en la tabla del index
     * @return array de empleados.
     */
    public function listarEmpleados() {
        $sql = "SELECT e.id, e.nombre, e.email, e.sexo, a.nombre AS 'area', e.boletin FROM empleados e INNER JOIN areas a ON e.area_id = a.id ORDER BY id DESC";
        $stmt = $this->con->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * obtener la informacion de un empleado por su id
     * @param mixed $id id del empleado
     * @return array de einformacion del empleado.
     */
    public function getDataEmpleado($id) {
        $sql = "SELECT e.nombre, e.email, e.sexo, e.area_id AS 'area', e.descripcion, e.boletin, GROUP_CONCAT(r.rol_id SEPARATOR ', ') AS roles FROM empleados e INNER JOIN empleado_rol r ON e.id = r.empleado_id WHERE e.id = :id ORDER BY id DESC";
        $stmt = $this->con->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Se encarga de realizar las validaciones de los campos
     * @param string $tipo define si es crear o actualizar.
     * @return void su retorno lo devuelve la funcion de crearEmpleado() con una redirección
     */
    public function prevalidacion($tipo, $id = 0){
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        $sexo = $_POST["sexo"];
        $area = $_POST["area"];
        $boletin = $_POST["boletin"] ? 1 : 0;
        $descripcion = $_POST["descripcion"];
        $roles = $_POST["roles"];

        if(empty($email) || empty($sexo) || empty($area) || empty($descripcion)){
            echo "Alguno de los parametros obligatorios no se envío, por favor verifique.";
            return false;
        }
        $validaciones = new validaciones();

        if(empty($nombre) || !is_string($nombre) || !$validaciones->sinCaractEsp($nombre) || !$validaciones->sinNumeros($nombre)){
            echo "El campo nombre esta vacio o no cumple con lo requerido";
            return false;
        }

        if(empty($email) || !is_string($email) || !$validaciones->email($email)){
           echo "El campo email no cumple con la estructura valida de un correo electronico.";
            return false;
        }

        $data[] = ["nombre" => $nombre, "email" => $email, "sexo" => $sexo, "area" => $area, "boletin" => $boletin, "descripcion" => $descripcion, "roles" => $roles];
        if($tipo == "crear"){
            $this->crearEmpleado($data);
        }else if($tipo == "actualizar"){
            $this->actualizar($data, $id);
        }
        

    }


    /**
     * actualización de empleados.
     * @param array $data informacion de los empleados a almacenar.
     * @param string $id identificador del empleado.
     * @return void redireccion a la tabla inicial.
     */
    public function actualizar($data, $id){
        try {
            
            $sql = "UPDATE empleados SET nombre = ?, email = ?, sexo = ?, area_id = ?, boletin = ?, descripcion = ? WHERE id = ?";
            $stmt = $this->con->prepare($sql);
            $stmt->execute([
                $data[0]["nombre"],
                $data[0]["email"],
                $data[0]["sexo"],
                $data[0]["area"],
                $data[0]["boletin"],
                $data[0]["descripcion"],
                $id
            ]);

            $sql = "DELETE FROM empleado_rol WHERE empleado_id = ?";
            $stmt = $this->con->prepare($sql);
            $stmt->execute([
                $id
            ]);
            
            foreach($data[0]["roles"] as $rol){
                $sql = "INSERT INTO empleado_rol (empleado_id, rol_id) VALUES (?, ?)";
                $stmt = $this->con->prepare($sql);
                $stmt->execute([
                    $id,
                    $rol
                ]);
            }
            $_SESSION['mensaje'] = "Empleado actualizado exitosamente.";
            $_SESSION['tipo_mensaje'] = "success";
            header("Location: /index.php");
            exit();

        } catch (PDOException $e) {
            echo "<div class='alert alert-danger'>Error al actualizar al empleado: " . htmlspecialchars($e->getMessage()) . "</div>";
        }
    }

    /**
     * Insersion de empleados.
     * @param array $data informacion de los empleados a almacenar.
     * @return void redireccion a la tabla inicial.
     */
    public function crearEmpleado(array $data) {
        try {
            $sql = "INSERT INTO empleados (nombre, email, sexo, area_id, boletin, descripcion) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->con->prepare($sql);
            $stmt->execute([
                $data[0]["nombre"],
                $data[0]["email"],
                $data[0]["sexo"],
                $data[0]["area"],
                $data[0]["boletin"],
                $data[0]["descripcion"]
            ]);
            $sql = "SELECT id FROM empleados ORDER BY id DESC LIMIT 1";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $resultId = $stmt->fetch(PDO::FETCH_ASSOC);

            foreach($data[0]["roles"] as $rol){
                $sql = "INSERT INTO empleado_rol (empleado_id, rol_id) VALUES (?, ?)";
                $stmt = $this->con->prepare($sql);
                $stmt->execute([
                    $resultId["id"],
                    $rol
                ]);
            }
            $_SESSION['mensaje'] = "Empleado creado exitosamente.";
            $_SESSION['tipo_mensaje'] = "success";
            header("Location: ../index.php");
            exit();

        } catch (PDOException $e) {
            echo "<div class='alert alert-danger'>Error al crear el empleado: " . htmlspecialchars($e->getMessage()) . "</div>";
        }
    }

    /**
     * Eliminación de empleados.
     * @param string $id identificador del empleado a eliminar.
     * @return void redireccion a la tabla inicial.
     */
    public function eliminar($id){
        try{
            $sql = "DELETE FROM empleado_rol WHERE empleado_id = ?";
            $stmt = $this->con->prepare($sql);
            $stmt->execute([
                $id
            ]);

            $sql = "DELETE FROM empleados WHERE id = ?";
            $stmt = $this->con->prepare($sql);
            $stmt->execute([
                $id
            ]);
            $_SESSION['mensaje'] = "Empleado eliminado exitosamente.";
            $_SESSION['tipo_mensaje'] = "success";
            header("Location: /index.php");
            exit();
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger'>Error al crear el empleado: " . htmlspecialchars($e->getMessage()) . "</div>";
        }
    }
}

$controller = new Controller();

if (isset($_POST['accion']) && $_POST['accion'] === 'crear') {
    $controller->prevalidacion("crear");
}else{
    $accionValue = explode("|", $_POST['accion']);

    if (isset($_POST['accion']) && $accionValue[0] === 'actualizar') {
        $controller->prevalidacion("actualizar", $accionValue[1]);
    }
    
    if (isset($_POST['accion']) && $accionValue[0] === 'eliminar') {
        $controller->eliminar($accionValue[1]);
    }
}

