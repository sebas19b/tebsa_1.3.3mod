<?php
/**
 *  Autor Sebastian Barreto
 */
class login
{
    // resivimos los datos ingresados por el usuario
    private $user;
    private $pas;

    function __construct($u,$p)
    {
        $this->user=$u;
        $this->pas=$p;
    }
    function filtrar(){ //filtramos los datos
        // $this->user=strtolower($this->user);
         $saneado1 = filter_var($this->user,FILTER_SANITIZE_STRING);
         $saneado2 = filter_var($this->pas,FILTER_SANITIZE_STRING);
       return Array($saneado1,$saneado2);
    }
    function loguiarse($u,$p){// conectamos a la base de datos

       $con=mysqli_connect("localhost","root","","tebsa") or die('no se pudo conectar: '.mysql_error());
        // comprovamos si los datos existen para iniciar la session | md5 al password
        $stmt="SELECT count(*) from usuario where nombre=('$u') and  pass=('$p')";
         $res=mysqli_query($con,$stmt) or die('consulta fallida: '.mysql_error());
            while ($data=mysqli_fetch_array($res)){
                if($data[0]==1  ){
                    echo '<script type="text/javascript">
                    window.location.href="desbok.php"</script>;';
                }else{
                    echo "<span style='color:red'>Usuario y/o Contraseña incorrecta</span>";
                }
            }
    }
}
?>
