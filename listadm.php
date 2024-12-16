<?php
session_start();
// Incluye el archivo "veriingresar.php" para poder ejecutar el codigo de la pagina

$conection = new mysqli("localhost","root","","tebsa");
$conection->set_charset("utf8");

 if (!isset($_SESSION["usu"])) {
 	header("location:index.html");
}

$query="SELECT * FROM archivos";

$resultado=$conection->query($query);

$_CONFIG = array();
$_ERROR = "";
$_LANG = array();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
  <title>Gestor Documental</title>
  <link rel="shortcut icon" type="image/x-icon" href="media/LogoTebsaicono.ico" />
<link rel="stylesheet" type="text/css" href="style/estilo.css" />
<meta  content="text/html"; http-equiv="content-type" />
 <script type="text/javascript" src="js/codigo.js"></script>
 <script type="text/javascript" src="js/js.js"></script>
 <script type="text/javascript" src="js/lib/jquery-2.2.3.min.js"></script>
 <script type="text/javascript" src="js/main.js" ></script>
 <script src="http://code.jquery.com/jquery-latest.js" ></script>
</head>
<body  ondragstart="return false">
<div id="cer"></div>
  <header>
      <div class="menu_bar">
         <a href="#" class="bt-menu"><span class="icon-list2"></span><img src="media/menu.png" /></a>
      </div>

       <nav>
            <ul id="masg">
                <li><a href="#" onclick="ocultar()">Inicio</a></li>
            </ul >
            <ul>
                <li><a href="#" onclick="mostrar()">Buscar</a></li>
            </ul >
            <ul id="masg">
              <li><a href="cerrar_s.php" onclick="cerrar()" >Cerrar Sesion</a>	</li>
            </ul>
      </nav>
  </header>
<!-- abre cuadro de busqueda-->
<div id="cuadrodebusqueda" >

<input type="text" id="Buproduct" placeholder="Buscar Documento" name="archivo" onkeyup="buscar();" autocomplete="on" />
<br>
<h5 id="procamp">Archivos</h5>
<br>

     <div id="caparc" class="cldiv" >
         <br>
         <br>
         <div id="resultado"></div>
       </div>

      <div id="propedi" class="cldiv">
        <br>
        <h5>Archivos</h5>
        <br>
          <!-- muestra los archivos buscados -->
          <p id="ca3"></p>
          <p id="ca2"></p>
          <p id="ca1"></p>
          <p id="ca"></p>
          <div class="" id="pedi"> </div>
          <p id="ca"></p>
          <br>
    </div>
</div>
   <!--cierra cuadro de busqueda-->
<div  id="listaarchivos" >
  <!-- abre listadearchivos-->


  <?php
  /*
  *Parte del codigo tomado y modificado de la pagina http://encode-explorer.siineiolekala.net/
  */
  $_CONFIG = array();
  $_ERROR = "";
  $_LANG = array();


  //
  // Directorio de inicio
  // solo subdirectorios relativos
  // Default:
  //
  $_CONFIG['starting_dir'] = "Documentos";

  //
  // Se abriran los archivos en nueva ventana 0=no, 1=si. Default: 0
  //
  $_CONFIG['open_in_new_window'] = 0;

  //
  // El espacio máximo permitido en el servidor
  // 1024KB  Default: 25600
  //
  $_CONFIG['max_space'] = 6120000;

  //
  //buscara la secuencia por niveles

  $_CONFIG['dir_levels'] = 6;

  //
  // mostrar el encabezado de la pagina 0=no, 1=si. Default: 1
  //
  $_CONFIG['show_top'] = 1;

  // codificacion del doc

  $_CONFIG['charset'] = "UTF-8";

  //
  // The array of folders that will be hidden from the list.
  //
  $_CONFIG['hidden_dirs'] = array();

  //
  // Nombres de archivo que se ocultarán de la lista
  //
  $_CONFIG['hidden_files'] = array(".ftpquota", "index.php", "index.php~", ".htaccess", ".htpasswd");

  //
  // ubicacion en el servidor
  //
  $_CONFIG['basedir'] = "";

  ?>

  <?php

  //
  // Organizar los documentos por nombre, size, fecha de modificacion
  //

  function cmp_name_desc($a, $b)
  {
    return strcasecmp($a->name, $b->name);
  }

  function cmp_name_asc($b, $a)
  {
    return strcasecmp($a->name, $b->name);
  }

  function cmp_size_desc($a, $b)
  {
    return ($b->size - $a->size);
  }

  function cmp_size_asc($a, $b)
  {
    return ($a->size - $b->size);
  }

  function cmp_mod_desc($a, $b)
  {
    return ($a->modTime - $b->modTime);
  }

  function cmp_mod_asc($b, $a)
  {
    return ($a->modTime - $b->modTime);
  }

//aqui

  include 'vanarc.php';

  //
  // La clase Dir contiene la información acerca de un directorio en la lista
  //
  class Dir
  {
    var $name;
    var $location;

    //
    // Constructor
    //
    function Dir($name, $location)
    {
      $this->name = htmlspecialchars($name);
      $this->location = $location;
    }

    function getName()
    {
      return $this->name;
    }

    function getNameEncoded()
    {
      return urlencode($this->name);
    }

    //
    // Depuración de salida
    //
    function output()
    {
      print("Dir name: ".$this->name."\n");
      print("Dir location: ".$this->location->getDir(true, false, 0)."\n");
    }
  }

  //
  // La clase de archivo contiene la información sobre un archivo de la lista
  //
  class File
  {
    var $name;
    var $location;
    var $size;
    var $extension;
    var $modTime;

    //
    // Constructor
    //
    function File($name, $location)
    {
      $this->name = htmlspecialchars($name);
      $this->location = $location;

      $this->extension = $this->findExtension($this->location->getDir(true, false, 0).$this->getName());
      $this->size = $this->findSize($this->location->getDir(true, false, 0).$this->getName());
      $this->modTime = filemtime($this->location->getDir(true, false, 0).$this->getName());
    }

    function getName()
    {
      return $this->name;
    }

    function getNameEncoded()
    {
      return urlencode($this->name);
    }

    function getSize()
    {
      return $this->size;
    }

    function getExtension()
    {
      return $this->extension;
    }

    function getModTime()
    {
      return $this->modTime;
    }

    //
    // Determinar el tamaño de un archivo
    //
    function findSize($file)
    {
      $sizeInBytes = filesize($file);

      // Si filesize () falla (con archivos más grandes), obtiene el tamaño de la línea de comandos unix.
      if (!$sizeInBytes) {
        $sizeInBytes=exec("ls -l '$file' | awk '{print $5}'");
      }
      return $sizeInBytes;
    }

    //
    // Devuelve la extensión del archivo
    //
    function findExtension($file)
    {
      $chunks = explode(".", $file);
      return $chunks[count($chunks)-1];
    }


    //
    // Depuración de salida
    //
    function output()
    {
      print("File name: ".$this->getName()."\n");
      print("File location: ".$this->location->getDir(true, false, 0)."\n");
      print("File size: ".$this->size."\n");
      print("File extension: ".$this->extension."\n");
      print("File modTime: ".$this->modTime."\n");
    }
  }

  class Location
  {
    var $path;

    //
    // Dividir una ruta de acceso de archivo en elementos de matriz
    //
    function splitPath($dir)
    {
      $path1 = preg_split("/[\\\\\/]+/", $dir);
      $path2 = array();
      for($i = 0; $i < count($path1); $i++)
      {
        if($path1[$i] == ".." || $path1[$i] == "." || $path1[$i] == "")
          continue;
        $path2[] = $path1[$i];
      }
      return $path2;
    }

    //
    // Obtener el directorio actual.
    //
    function getDir($prefix, $encoded, $up)
    {
      $dir = "";
      if($prefix == true)
        $dir .= "";
      for($i = 0; $i < ((count($this->path) >= $up && $up > 0)?count($this->path)-$up:count($this->path)); $i++)
      {
        $dir .= ($encoded?rawurlencode($this->path[$i]):$this->path[$i])."/";
      }
      return $dir;
    }

    function getFullPath()
    {
      global $_CONFIG;
      return ($_CONFIG['basedir']?$_CONFIG['basedir']:dirname($_SERVER['SCRIPT_FILENAME']))."/".$this->getDir(true, false, 0);
    }

    //
    // Establecer el directorio actual
    //
    function init()
    {
      global $_CONFIG;
      if(!isset($_GET['dir']) || strlen($_GET['dir']) == 0)
      {
        $this->path = $this->splitPath($_CONFIG['starting_dir']);
      }
      else
      {
        $this->path = $this->splitPath($_GET['dir']);
      }
    }
  }

  class lista_archivos
  {
    var $location;
    var $dirs;
    var $files;
    var $sort_by;
    var $sort_as;

    //
    // Determina la clasificación, calcula el espacio.
    //
    function init()
    {
      $this->sort_by = "";
      $this->sort_as = "";
      if(isset($_GET["sort_by"]) && isset($_GET["sort_as"]))
      {
        if($_GET["sort_by"] == "name" || $_GET["sort_by"] == "size" || $_GET["sort_by"] == "mod")
          if($_GET["sort_as"] == "asc" || $_GET["sort_as"] == "desc")
          {
            $this->sort_by = $_GET["sort_by"];
            $this->sort_as = $_GET["sort_as"];
          }
      }
      if(strlen($this->sort_by) <= 0 || strlen($this->sort_as) <= 0)
      {
        $this->sort_by = "name";
        $this->sort_as = "desc";
      }

      $this->calculateSpace();
    }

    //
    // Lee la lista de archivos del directorio
    //
    function readDir()
    {
      global $_CONFIG;
      global $_ERROR;
      global $_LANG;
      //
      // Lee de los datos de archivos y directorios
      //
      if($open_dir = @opendir($this->location->getFullPath()))
      {
        $this->dirs = array();
        $this->files = array();
        while ($object = readdir($open_dir))
        {
          if($object != "." && $object != "..")
          {
            if(is_dir($this->location->getDir(true, false, 0)."/".$object))
            {
              if(!in_array($object, $_CONFIG['hidden_dirs']))
                $this->dirs[] = new Dir($object, $this->location);
            }
            else if(!in_array($object, $_CONFIG['hidden_files']))
              $this->files[] = new File($object, $this->location);
          }
        }
        closedir($open_dir);
      }
      else
      {
        $_ERROR = $_LANG['unable_to_read_dir'];
      }
    }

    //
    // Calcula el espacio total utilizado
    //
    function sum_dir($start_dir, $ignore_files, $levels = 1)
    {
      if ($dir = opendir($start_dir))
      {
        $filesize = 0;
        while ((($file = readdir($dir)) !== false))
        {
          if (!in_array($file, $ignore_files))
          {
            if ((is_dir($start_dir . '/' . $file)) && ($levels - 1 >= 0))
            {
              $filesize += $this->sum_dir($start_dir . '/' . $file, $ignore_files, $levels-1);
            }
            elseif (is_file($start_dir . '/' . $file))
            {
              $filesize += filesize($start_dir . '/' . $file) / 1024;
            }
          }
        }

        closedir($dir);
        return $filesize;
      }
    }

    function calculateSpace()
    {
      global $_CONFIG;
      $ignore_files = array('..', '.');
      $start_dir = getcwd();
      $spaceUsed = $this->sum_dir($start_dir, $ignore_files, $_CONFIG['dir_levels']);
      $spaceLeft = $_CONFIG['max_space'] - $spaceUsed;
      $this->spaceUsed = round($spaceUsed/1024, 6);
      $this->spaceLeft = round($spaceLeft/1024, 6);
    }

    function sort()
    {
      @usort($this->files, "cmp_".$this->sort_by."_".$this->sort_as);
      if($this->sort_by == "name" && $this->sort_as == "asc")
        @usort($this->dirs, "cmp_name_asc");
      else
        @usort($this->dirs, "cmp_name_desc");
    }

    function makeArrow($sort_by)
    {
      global $_LANG;

      if($this->sort_by == $sort_by && $this->sort_as == "asc")
      {
        $sort_as = "desc";
        $img = "media/up.png";
      }
      else
      {
        $sort_as = "asc";
        $img = "media/down.png";
      }

      if($sort_by == "name")
        $text = "Nombre";
      else if($sort_by == "size")
        $text = "Size";
      else if($sort_by == "mod")
        $text = "Ultima modificacion";

      return "<a href=\"?dir=".$this->location->getDir(false, true, 0)."&amp;sort_by=".$sort_by."&amp;sort_as=".$sort_as."\">
        $text <img style=\"border:0;\" alt=\"".$sort_as."\" src=".$img." /></a>";
    }

    function makeIcon($l)
    {
      $l = strtolower($l);
      return "?img=".$l;
    }

    function formatModTime($time)
    {
      return date("d.m.y H:i:s", $time);
    }

    function formatSize($size)
    {
      $sizes = Array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');
      $y = $sizes[0];
      for ($i = 1; (($i < count($sizes)) && ($size >= 1024)); $i++)
      {
        $size = $size / 1024;
        $y  = $sizes[$i];
      }
      return round($size, 2)." ".$y;
    }

    //
    // Función principal
    //
    function run($location)
    {
      $this->init();
      $this->location = $location;
      $this->readDir();
      $this->sort();
      $this->outputHtml();
    }

    //
    // Printing the actual page
    //
    function outputHtml()
    {
      global $_ERROR;
      global $_CONFIG;
      global $_LANG;
  ?>

  
  <div id="admin">
      <div id="resregi">
        <input type="button" id="btnagus" name="" value="Agregar Usuario" onclick="mosusu()">
        <input type="button" id="btnupar" name="" value="Agregar Archivo" onclick="mosarc()">
     </div>
     <br>
    <div id="agus" style="display:none">
      <input type="text" id="userlog" placeholder="example@tebsa.com.co" required>
      <input type="password" id="apass" placeholder="Password" required>
      <input type="password" id="cpass" placeholder="Confirmar Password" required>
      <button name="" onclick="validar()" >Agregar</button>
    </div>


    <div id="uparc" style="display:none">

      <form enctype="multipart/form-data" action=""    method="POST">
            <table cellspacing="0" cellpadding="0" border="0" width="100%">
              <tr>
                <td>
                    <div class="barsub">
                    <input name="userdir" id="nomcarp" type="text" class="text" onkeydown="val(this.form);" />
                    <input type="submit" value="Crear Carpeta" />
                    <input name="userfile" type="file"/>
                    <!--"Seleccionar carpeta" -> webkitdirectory multiple -->
                    <br>
                    <input type="text" name="mueb" id="mueb" placeholder="Mueble" />
                    <input type="text" name="entre" id="entre" placeholder="Entrepa&ntilde;o" />
                    <input type="text" name="uncov" id="uncov" placeholder="Unidad" />
                    <input name="btnsubir" type="submit" value="Subir" />
                     </div>
                </td>
              </tr>
            </table>
      </form>

      </div>

</div>

<?php
if($_ERROR)
{
?>
  <div id="error"><?php print $_ERROR; ?></div>
<?php
}
?>


<div id="frames">
<?php
if($_CONFIG['show_top'])
{
?>
<div id="topes">
  <!--emcabezado-->
    <div class="text_a0">Gestor Documental</div>
      
    <div class="text_a1">Al crear carpeta no deje espacio entre palabras</div>
</div>
    
<?php
}
?>

<!-- Comienza la lista (tabla) -->
<table class="table" border="0" cellpadding="3" cellspacing="0">
<tr class="breadcrumbs">
  <td colspan="4"> <a href="?dir="></a>
<?php
  for($i = 0; $i < count($this->location->path); $i++)
  {
?>
     <a href="?dir=<?php print $this->location->getDir(false, true, count($this->location->path) - $i - 1); ?>">
      <?php print $this->location->path[$i]; ?>
    </a>/
<?php
  }
?>
  </td>
</tr>
<tr class="row one">
  <td class="icon">&nbsp;</td>
  <td class="name"><?php print $this->makeArrow("name");?></td>
  <td class="size"><?php print $this->makeArrow("size"); ?></td>
  <td class="changed"><?php print $this->makeArrow("mod");?></td>
  <td class="act"> Action </td>
</tr>
<tr class="row two">
  <td class="icon"><img alt="dir" src="media/carpeta.png" /></td>
  <!-- ?img=directory -->
  <td colspan="3" class="long"><a href="?dir=<?php print $this->location->getDir(false, true, 1); ?>"> <img alt="dir" src="media/back.png" \> </a></td>
</tr>
<?php

    function delefic(){

        rmdir($this->location->getDir(false, true, 0).$dir->getNameEncoded().$dir->getName());
    }

    function delefil(){

        unlink($this->location->getDir(false, true, 0).$file->getNameEncoded().$file->getName());
    }

?>

<?php
//
// Muestra carpetas y archivos.
//
$row = 1;

//
// Primero Carpetas
//confirm('Desea Eliminar?')
//
if($this->dirs)
{
  foreach ($this->dirs as $dir)
  {
    $row_style = ($row ? "one" : "two");
?>
  
<tr class="row <?php print $row_style; ?>">
  <td class="icon"><img alt="dir" src="media/carpeta.png" /></td>
  <td colspan="3" class="long" id="yeah"><?php print "<a href=\"?dir=".$this->location->getDir(false, true, 0).$dir->getNameEncoded()."\">".$dir->getName()."</a>"; ?></td>

<td> 

    <img name="boor" class="imdel" id="ilfi" alt="del" src="media/delete.png" onclick="confirdelar(this)">
    <div id="condel"></div>

    </td>
</tr>
    
<?php
    $row =! $row;
  }
}

//
// Despues Archivos
//
if($this->files)
{
  foreach ($this->files as $file)
  {
    $row_style = ($row ? "one" : "two");
    print_r($file);  
?>
<tr class="row <?php echo $row_style; ?>">
  <td class="icon"><img alt="<?php print $file->getExtension(); ?>" src="media/pdf.png" /></td>
  <!--print $this->makeIcon($file->getExtension()); -->
  <td class="name">
<?php
    print "\t\t<a href=\"".$this->location->getDir(false, true, 0).$file->getName()."\"";
    if($_CONFIG['open_in_new_window'])

      print "target=\"_blank\"";
    print "target='_blank'>".$file->getName()."</a>";
      
?>
  </td>
  <td class="size"><?php print $this->formatSize($file->getSize()); ?></td>
  <td class="changed"><?php print $this->formatModTime($file->getModTime());?></td>
  <td class="act">
      <img class="mod" alt="mod" src="media/editar.png" onclick="" />
      <img  class="imdel" id="<?php print $this->location->getDir(false, true, 0).$file->getName(); ?>" alt="del" src="media/delete.png" onclick="confirdelar(this)" /> 
  </td>    
</tr>
<?php
  $row =! $row;  
  }
}

?>


</table>
<!-- FInal de la lista (tabla) -->

</div>

<?php
  }
}

//
// se activa el sistema
//

  $location = new Location();
  $location->init();
  $fileManager = new FileManager();
  $fileManager->run($location);
  $encodeExplorer = new lista_archivos();
  $encodeExplorer->run($location);

?>
</div>
  <!--cierra listadearchivos -->

  </body>
</html>
