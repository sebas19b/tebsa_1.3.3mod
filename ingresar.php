<?php
/**
* Autor Sebastian Barreto
*/

// Incluye el archivo "veriingresar.php" para poder ejecutar el codigo de la pagina
include_once "veriingresar.php";

// recibe los datos ya filtrados


$user=$_POST["user"];
$pass= $_POST["pass"];
$inst=new login($user,$pass);
$f=$inst->filtrar();
$inst->loguiarse($f[0],$f[1]);

// abre session
session_start();
$_SESSION["usu"]=$_POST["user"];
?>
