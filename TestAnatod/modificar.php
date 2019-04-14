<?php
require_once ('bussiness/cliente.php');
require_once ('bussiness/localidades.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Test Anatod :. Modificar Cliente</title>
    <link rel="stylesheet" href="css/styles.css" type="text/css">
    <script Language="JavaScript">
        if(window.history.forward(1) != null)   window.history.forward(1);
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
    <h1> Modificar</h1>
    <?php
      $cli =new Cliente();
      $cli->setid($_GET['id']);
      $result=  $cli->getAllbyid($cli->getid());
      while($row =$result->fetch_assoc()){
        ?>
    <div class='centrar estiloFormulario sombra'>
      <form action="modificar_clientes.php" method="post"  onsubmit="return validarFormulario()">
        Nombre:</br>
        <div class="blanco"></div>
        <input class="redondeado confondo" type="text" id="nombre" name="nombre" value= "<?php echo $row['Nombre_CLI'];?>" required/>
        <div class="blanco"></div>
          DNI:</br>
        <input class="redondeado confondo" type="text" id="dni" name="dni" value= "<?php echo $row['dni'];?>"maxlength="8" onclick="validaDNI(this)" required  />
          <div class="blanco"></div>
        Localidad:</br>

        <select name="localidad" class="redondeado confondo" >
          <?php
          $Loc =new Localidades();
          $result=    $Loc->getAllLocalidades();
          echo '<option value="'.$row['idLocalidad'].'">'.$row['localidad'].'</option>';
          while($rows =$result->fetch_assoc()){
              echo '<option value="'.$rows['idLocalidad'].'">'.$rows['nombre'].'</option>';
          }
        ?>
        </select>
      <div>
          <input type="hidden" id="id" name="id" value="<?php echo $row['id'];?>">
      </div>
      <hr>
      <div class="button">
        <button type="submit" class="botonGuardar">Modificar</button>
      </div>
    </form>
    <div class="blanco"></div>
    <?php } ?>
    <a href="index.php" title="Ir la página anterior" class="botonRegresar">&larr; Volver</a>
    </div>
  </div>
  </body>
</html>
