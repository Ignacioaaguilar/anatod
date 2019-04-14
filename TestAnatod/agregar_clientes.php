<?php
require ('bussiness/cliente.php');

$cli =new Cliente();
$cli->setnombre($_POST['nombre']);
$cli->setdni($_POST['dni']);
$cli->setlocalidad($_POST['localidad']);
$cli->insert($cli->getnombre(),$cli->getdni(),$cli->getlocalidad(),$mensaje);
header("Location:agregar.php?mensaje=$mensaje");
?>
