<?php
$usuario=$_POST['usuario'];
$contra=$_POST['contra'];
session_start();
$_SESSION['usuario']=$usuario;

$conexion=mysqli_connect("localhost","root","","labo00");

$consulta="SELECT * FROM usuario where usuario='$usuario' and contra='$contra'";
$resultado=mysqli_query($conexion,$consulta);

$filas=mysqli_fetch_array($resultado);

if ($resultado) {
    if ($resultado->num_rows > 0) {
        $_SESSION["autentificado"]="2";
        header("location:userr/user.php");
        
    } else {
        header("Location:index.php?errorusuario=si");
    }
} else {
    echo "Error en la consulta SQL: " . $MySQLiconn->error;
}

// if($filas['id_cargo']==1){ //administrador
//     $_SESSION["autentificado"]="1";
//     header("location:admin/admin.php");

// }else
// if($filas['id_cargo']==2){ //usuario
//     $_SESSION["autentificado"]="2";
//     header("location:userr/user.php");
// }

mysqli_free_result($resultado);
mysqli_close($conexion);
