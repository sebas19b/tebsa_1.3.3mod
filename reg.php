<?php
include_once 'clavalidar.php';
$nomuser=$_POST["nu"];
$agpas=$_POST["ap"];
$cpassw=$_POST["cp"];

$validar =new registrar($nomuser,$agpas,$cpassw);
$res=$validar->validar();

if ($res[1]==4) {
  $in=$validar->inserta();
}else{
  echo $res[1]." ".$res[0];
}

?>
