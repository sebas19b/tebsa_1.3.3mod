<?php

session_start();
include "conexion.php";

 
if($_SESSION["usu"]== "sebas@mail.com"){
    
    header("Location:listadm.php");
    
}else{
    header("Location:listausu.php");
}


?>