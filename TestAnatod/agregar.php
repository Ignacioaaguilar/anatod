<?php
require_once ('bussiness/cliente.php');
require_once ('bussiness/localidades.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Test Anatod :. Agregar Cliente</title>
    <link rel="stylesheet" href="css/styles.css" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script Language="JavaScript">
        if(window.history.forward(1) != null)   window.history.forward(1);
    </script>
    <script>
    $( function() {
      $( "#dialog" ).dialog();
    } );
    </script>
    <script>
      function validarFormulario(){
        var txtNombre = document.getElementById('nombre').value;
        var txtDni = document.getElementById('dni').value;
        var banderaRBTN = false;
        //Test campo obligatorio
        if(txtNombre == null || txtNombre.length == 0 || /^\s+$/.test(txtNombre)){
          alert('ERROR: El campo nombre no debe ir vacío o lleno de solamente espacios en blanco');
          return false;
        }

        //Test correo
        if(!(/^\d{8}(?:[-\s]\d{4})?$/.test(txtDni))){
          alert('ERROR: Debe escribir un DNI válido');
          return false;
        }
    return true;
  }

  </script>

  </head>
  <body>
    <h1> Agregar</h1>
    <div class='centrar estiloFormulario sombra'>
    <form action="agregar_clientes.php" method="post" onsubmit="return validarFormulario()" >
        Nombre:</br>
        <input class="redondeado confondo" type="text" id="nombre" name="nombre" required />
      <div class="blanco"></div>
        DNI:</br>
        <input class="redondeado confondo" type="text" name="dni" id="dni"  maxlength="8" onclick="validaDNI(this)" required >
      <div class="blanco"></div>
        Localidad:</br>
        <select class="redondeado confondo" name="localidad" >
          <?php
          $Loc =new Localidades();
          $result=    $Loc->getAllLocalidades();
          while($row =$result->fetch_assoc()){
              echo '<option value="'.$row['idLocalidad'].'">'.$row['nombre'].'</option>';
          }
        ?>
        </select>
      <div class="blanco"></div>
      <hr>
      <div class="button">
        <button type="submit" class="botonGuardar">Guardar</button>
      </div>
    </form>
      <div class="blanco"></div>
      <a href="index.php" title="Ir la página anterior" class="botonRegresar">&larr; Volver</a>
    </div>
    <?php
      if(!empty($_GET['mensaje'])){
        $mensaje  =$_GET['mensaje'];
          if ($mensaje=="succcess"){
            ?>
            <div id="dialog" title="Agregar Clientes">
                <p>El Cliente, se Agrego Exitosamente</p>
            </div>
          <?php
              }
          else if ($mensaje=="failed") {
            ?>
            <div id="dialog" title="Agregar Clientes">
                <p>Hubo un error, el cliente no se pudo Agregar</p>
            </div>
            <?php
          }
        }
     ?>
  </body>
</html>
