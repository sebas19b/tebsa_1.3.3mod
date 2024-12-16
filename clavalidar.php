<?php

 /**
  *
  */
 class registrar
 {
   private $nu;
   private $ap;
   private $cp;


   function __construct($n,$a,$c){
      $this->nu=$n;
      $this->ap=$a;
      $this->cp=$c;
   }

        function validar()
        {
          $val=true;
          $con=0;
            if ($val==true) {
              if (empty($this->nu)) {
                $val=false;
                  if ($val==false) {
                    $res1="Ingrese Usuario";
                    return Array($res1,$con);
                  }
              } else {
                  if(filter_var($this->nu, FILTER_VALIDATE_EMAIL)){
                            $con=$con+1;
                            $val=true;
                    }else{
                        $val=false;
                        $res1="correo inaidao";
                        return Array($res1,$con);
                    }
                  }
            }
              if ($val==true) {

              if (empty($this->ap)) {
                $val=false;
                  if ($val==false) {
                    $res2="ingrese un a contraseña";
                    return Array($res2,$con);
                  }
              } else {
                $con=$con+1;
                $val=true;
              }
            }
            if ($val==true) {

            if (empty($this->cp)) {
              $val=false;
                if ($val==false) {
                  $res3="ingrese para verificar contrasena";
                  return Array($res3,$con);
                }
            } else {
              $con=$con+1;
              $val=true;
            }
          }
          if ($val==true) {
    if ($this->ap != $this->cp){
      $val=false;
      if ($val==false) {
          $res4="Contraseñas no Coinciden";
          return Array($res4,$con);
    }
    }else {
   $val=true;
   $con=$con+1;
   $res4="felicitaciones";
   return Array($res4, $con);
      }
}

        }
          function inserta(){
            $con=mysqli_connect("localhost","root","","tebsa") or die('no se pudo conectar: '.mysql_error());

            $sql = "SELECT nombre FROM usuario WHERE nombre= '$this->nu'";
            $res=mysqli_query($con,$sql) or die('consulta fallida: '.mysql_error());
             $cont=mysqli_num_rows($res);
             if ($cont>0){
             echo "El correo ya existe ". $cont;
             }else {
                $insertar =  "INSERT INTO usuario VALUES('0','$this->nu',md5('$this->ap'))";
                  $re=mysqli_query($con,$insertar) or die ('nose pudo insertar nada '.mysql_error());
                    echo "Guardado";
              }


          }
 }



?>
