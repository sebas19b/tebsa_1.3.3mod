<?php
/**
* autor Sebastian Barreto,Brayan Salgado
 * buscar los archivos 
 */

class buscarchi
{

function busca($b)
  {    // conecta a la base de datos
    $conectar= new mysqli("localhost","root","","tebsa");
    $conectar->set_charset("utf8");
    // selecciona la tabla archivos "like" busca segun se le indique en cuadro de busqueda
    $sql="select * from archivos where archivo_nombre like '%$b%'";
       $resultado=$conectar->query($sql);
      if ($b=="") {

      }else {

             echo "<div class='procajabus' id='procajabusv' style='color:#fff; ' ><div class='camos'><div class='ctnomarc'>Nombre</div> <div class='codmue'>Codigo Mueble</div> <div class='numentre'>Entrepa&ntilde;o</div> <div class='unicon'>Uni. Conservacion</div> <div class='dirarc'>Enlace</div>";
             echo "</div></div>";
             while($row=mysqli_fetch_array($resultado)) {
             //mostramos los archivos buscados
             echo "<br><div class='procajabus' id='procajabusv'><div class='camos'><div class='ctnomarc' src='' >".$row['archivo_nombre']."</div> <div class='codmue' src='' >".$row['codigo_mueble']."</div> <div class='numentre' src='' >".$row['n_entrepano']."</div> <div class='unicon' src='' >".$row['uni_conservacion']."</div> <div class='dirarc' src='' > <a href='".$row['url_arc']."' target='_blank' >Abrir</a> </div> ";
             echo "</div></div>";
            }

      }

  }

}

?>
