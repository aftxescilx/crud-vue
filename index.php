<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos  con usuario, contraseña y nombre de la BD
$servidor = "localhost"; $usuario = "root"; $contrasenia = ""; $nombreBaseDatos = "institucion";
$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);


// Consulta datos y recepciona una clave para consultar dichos datos con dicha clave
if (isset($_GET["consultar"])){
    $sqlEmpleado = mysqli_query($conexionBD,"SELECT * FROM empleado WHERE idEmpleado=".$_GET["consultar"]);
    if(mysqli_num_rows($sqlEmpleado) > 0){
        $empleados = mysqli_fetch_all($sqlEmpleado,MYSQLI_ASSOC);
        echo json_encode($empleados);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//borrar pero se le debe de enviar una clave ( para borrado )
if (isset($_GET["borrar"])){
    $sqlEmpleado = mysqli_query($conexionBD,"UPDATE empleado SET estatus=0 WHERE idEmpleado=".$_GET["borrar"]);
    if($sqlEmpleado){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//Inserta un nuevo registro y recepciona en método post los datos de nombre y correo
if(isset($_GET["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    $nombre=$data->nombre;
    $correo=$data->correo;
        if(($correo!="")&&($nombre!="")){
            
    $sqlEmpleado = mysqli_query($conexionBD,"INSERT INTO empleado(nombre,correo) VALUES('$nombre','$correo') ");
    echo json_encode(["success"=>1]);
        }
    exit();
}
// Actualiza datos pero recepciona datos de nombre, correo y una clave para realizar la actualización
if(isset($_GET["actualizar"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["actualizar"];
    $nombre=$data->nombre;
    $correo=$data->correo;
    
    $sqlEmpleado = mysqli_query($conexionBD,"UPDATE empleado SET nombre='$nombre',correo='$correo' WHERE idEmpleado='$id'");
    echo json_encode(["success"=>1]);
    exit();
}
// Consulta todos los registros de la tabla empleados
$sqlEmpleado = mysqli_query($conexionBD,"SELECT * FROM empleado WHERE estatus=1");
if(mysqli_num_rows($sqlEmpleado) > 0){
    $empleados = mysqli_fetch_all($sqlEmpleado,MYSQLI_ASSOC);
    echo json_encode($empleados);
}
else{ echo json_encode([["success"=>0]]); }


?>