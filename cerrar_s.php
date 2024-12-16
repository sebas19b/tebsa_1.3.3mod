<?php
// reanuda la session iniciada
session_start();
// destruye los datos de  la session
session_destroy();
header("location: index.html");

?>
