<?php
// Incluye el archivo 'bus_archi.php' para poder ejecutar el codigo de la pagina
include_once 'bus_archi.php';
// recibe el parametro a buscar
$b=$_POST["produc"];
// recibe el resultado de la busqueda
$buscar=new buscarchi();
// manda el resultado de la busqueda
$buscar->busca($b);

?>
