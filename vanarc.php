<?php
class FileManager
{
    public $location;

    function __construct() {
        // Establecer ubicación predeterminada
        $this->location = (object) ['path' => "Documentos"];
    }

    // Función para crear una nueva carpeta
    function newFolder($location, $dirname)
    {
        global $_ERROR, $_LANG;

        if (strlen($dirname) > 0) {
            // Validar los nombres prohibidos
            $forbidden = ["", "\\", "/"];
            $dirname = str_replace($forbidden, "", $dirname);
            
            // Verifica que la carpeta no exista y crea la nueva carpeta
            $dirPath = $location->getDir(true, false, 0) . $dirname;
            if (!mkdir($dirPath, 0777)) {
                $_ERROR = $_LANG["new_dir_failed"];
            } else {
                // Cambiar los permisos si se creó la carpeta
                if (!chmod($dirPath, 0777)) {
                    $_ERROR = $_LANG["chmod_dir_failed"];
                }
            }
        }
    }

    // Función para subir el archivo
    function uploadFile($location, $userfile)
    {
        global $_ERROR, $_LANG;

        // Verifica que el archivo sea PDF
        if ($_FILES['userfile']['type'] == 'application/pdf' && isset($_POST['btnsubir'])) {
            echo "<span id='listom'>Entro</span>";
            
            // Obtenemos el nombre del archivo y lo limpiamos
            $name = basename($userfile['name']);
            $name = stripslashes($name);
            
            // Verifica la ruta de destino del archivo
            $upload_dir = $location->getDir(false, true, 0); // Asegúrate de que esta función retorne una ruta válida
            $upload_file = $upload_dir . $name;

            // Verifica si el archivo se sube correctamente
            if (!is_uploaded_file($userfile['tmp_name'])) {
                $_ERROR = $_LANG["failed_upload"];
            } elseif (!move_uploaded_file($userfile['tmp_name'], $upload_file)) {
                $_ERROR = $_LANG["failed_move"];
            } else {
                // Guardamos el archivo en la base de datos
                $almace_archivo = $_FILES['userfile']['size'];
                $nombre_temporal = $_FILES['userfile']['tmp_name'];
                $muebl = $_POST['mueb'];
                $entrep = $_POST['entre'];
                $uniconv = $_POST['uncov'];
                $na = basename($upload_file, '.pdf');

                // Conexión a la base de datos
                $ex = mysqli_connect("localhost", "root", "", "tebsa");
                if (!$ex) {
                    die('Error de conexión: ' . mysqli_connect_error());
                }

                // Inserción de datos
                $insertar_doc = "INSERT INTO archivos VALUES ('0', '$na', '$almace_archivo', 'application/pdf', '$muebl', '$entrep', '$uniconv', '$upload_file')";
                if (!mysqli_query($ex, $insertar_doc)) {
                    $_ERROR = 'No se pudo insertar el archivo: ' . mysqli_error($ex);
                } else {
                    echo "<span id='listom'>Archivo Guardado</span>";
                    header("Location:listadm.php");
                }

                mysqli_close($ex);
            }
        } else {
            echo "<span id='listom'>El Formato no es Valido(*pdf)</span>";
        }
    }

    // Función principal para manejar las solicitudes
    function run($location)
    {
        if (isset($_POST['userdir']) && strlen($_POST['userdir']) > 0) {
            $this->newFolder($location, $_POST['userdir']);
        }
        if (isset($_FILES['userfile']['name']) && strlen($_FILES['userfile']['name']) > 0) {
            $this->uploadFile($location, $_FILES['userfile']);
        }
    }
}

?>