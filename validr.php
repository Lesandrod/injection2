<?php

// $usuario=$_POST['usuario'];
// $contra=$_POST['contra'];
// session_start();
// $_SESSION['usuario']=$usuario;

// $conexion=mysqli_connect("localhost","root","","labo00");






// $consulta="SELECT * FROM usuario where usuario='$usuario' and contra='$contra'";





// $resultado=mysqli_query($conexion,$consulta);

// $filas=mysqli_fetch_array($resultado);

// if ($resultado) {
//     if ($resultado->num_rows > 0) {
//         $_SESSION["autentificado"]="2";
//         header("location:userr/user.php");
        
//     } else {
//         header("Location:index.php?errorusuario=si");
//     }
// } else {
//     echo "Error en la consulta SQL: " . $MySQLiconn->error;
// }

// // if($filas['id_cargo']==1){ //administrador
// //     $_SESSION["autentificado"]="1";
// //     header("location:admin/admin.php");

// // }else
// // if($filas['id_cargo']==2){ //usuario
// //     $_SESSION["autentificado"]="2";
// //     header("location:userr/user.php");
// // }

// mysqli_free_result($resultado);
// mysqli_close($conexion);





//SOLUCIÓN

// Verificar la conexión
include_once 'db.php';

$usuario = $_POST['usuario'];
$contra = $_POST['contra'];
session_start();
$_SESSION['usuario']=$usuario;


// Utiliza una consulta parametrizada
$sql = "SELECT * FROM usuario WHERE usuario=? AND contra=?";
$stmt = $MySQLiconn->prepare($sql);

if ($stmt) {
    // Enlaza las variables a los parámetros de la consulta
    $stmt->bind_param("ss", $usuario, $contra);

    // Ejecuta la consulta
    $stmt->execute();

    // Obtiene el resultado
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $_SESSION["autentificado"]="2";
        header("location:userr/user.php");
    } else {
        header("Location: index.php?errorusuario=si");
    }

    $stmt->close();
} else {
    echo "Error en la consulta SQL: " . $MySQLiconn->error;
}

$MySQLiconn->close();
