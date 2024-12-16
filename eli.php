<?php
session_start();
include "conexion.php";
include 'listadm.php';

//$location = new Location();
  //$location->init();
    $this->x;
    $this->uno=$_POST["x"];

   /*function rmDir_rf($dir)
    {
      foreach(glob($dir . "/*") as $x){             
        if (is_dir($x)){
          rmDir_rf($x);
        } else {
        unlink($x);
        }
      }
      rmdir($dir);
     }*/
       unlink($uno);

//rmdir($this->location->getDir(false, true, 0).$dir->getNameEncoded().$dir->getName());

//header("Location:listadm.php");
?> 