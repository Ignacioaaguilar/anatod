<?php
require ('bussiness/cliente.php');

$cli =new Cliente();
$cli->setid($_POST['id']);
$cli->setnombre($_POST['nombre']);
$cli->setdni($_POST['dni']);
$cli->setlocalidad($_POST['localidad']);
$cli->modificar($cli->getnombre(),$cli->getdni(),$cli->getlocalidad(),$cli->getid(),$mensaje);
header("Location: index.php?mensaje=$mensaje");
?>
