<?php
include_once '../db.php';

if(isset($_POST['save']))
{
    $usuario = $MySQLiconn->real_escape_string($_POST['usuario']);
    $contra = $MySQLiconn->real_escape_string($_POST['contra']);
    $id_cargo = $MySQLiconn->real_escape_string($_POST['id_cargo']);

    //conusulta por procedimiento almacenado
    $SQL = $MySQLiconn->prepare("CALL insert_user(?,?,?)");
    $SQL->bind_param("sss",$usuario,$contra,$id_cargo);
    $SQL->execute();    
    $SQL->close();
    //error 
    if(!$SQL)
    {
        echo $MySQLiconn->error;
    }
}

if(isset($_GET['del']))
{
    $SQL = $MySQLiconn->prepare("CALL delete_user(?)");
    $SQL->bind_param("s",$_GET['del']);
    $SQL->execute();    
    $SQL->close();
    header("Location: listado.php");
}

if(isset($_GET['edit']))
{
    
    $SQL = $MySQLiconn->query("SELECT * FROM usuario WHERE id =".$_GET['edit']);
    $getROW = $SQL->fetch_array();
}
if(isset($_POST['update']))
{   
    $usuario = $MySQLiconn->real_escape_string($_POST['usuario']);
    $contra = $MySQLiconn->real_escape_string($_POST['contra']);
    $id_cargo = $MySQLiconn->real_escape_string($_POST['id_cargo']);

    $SQL = $MySQLiconn->prepare("CALL actu_datos(?,?,?,?)");
    $SQL->bind_param("ssss",$usuario,$contra,$id_cargo,$_GET['edit']);
    $SQL->execute();    
    $SQL->close();
    //$SQL = $MySQLiconn->query("UPDATE usuario SET usuario='".$_POST['usuario']."', contra='".$_POST['contra']."',id_cargo='".$_POST['id_cargo']."' WHERE id=".$_GET['edit']);
    header("Location: listado.php");
}

?>