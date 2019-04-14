<?php
require_once ('data/class.database.php');
class Cliente extends  class_db
{
  private $id;
  private $nombre;
  private $dni;
  private $localidad;

  // set id
    public function setid($id)
    {
    $this->id = $id;
    }
    // get id
    public function getid()
    {
    return $this->id;
    }
    // set nombre
      public function setnombre($nombre)
      {
      $this->nombre = $nombre;
      }
      // get nombre
      public function getnombre()
      {
      return $this->nombre;
      }

      // set DNI
        public function setdni($dni)
        {
        $this->dni = $dni;
        }
        // get DNI
        public function getdni()
        {
        return $this->dni;
        }
        // set localidad
          public function setlocalidad($localidad)
          {
          $this->localidad = $localidad;
          }
          // get localidad
          public function getlocalidad()
          {
          return $this->localidad;
          }

    public function getAll() {
      $result = $this->conn->query( "SELECT c.id,c.nombre as Nombre_CLI,c.dni,l.nombre FROM clientes c inner join localidades l on c.localidad=l.id order by c.nombre  ");
      return $result;
      $this->conn->close();
    }

    public function getAllbyid($id) {
      $result = $this->conn->query( "SELECT c.id,c.nombre as Nombre_CLI,c.dni,l.nombre as localidad,l.id as idLocalidad FROM clientes c inner join localidades l on c.localidad=l.id  where c.id=$id order by c.nombre ");
      return $result;
      $this->conn->close();
    }

    public function insert($nombre,$dni,$localidad,&$mensaje){
      $sql="INSERT into clientes(nombre,dni,localidad) values('$nombre','$dni',$localidad) ";

      if ($this->conn->query($sql) === TRUE) {
        $mensaje="succcess";
        echo "<h3> succcess </h3>";
        } else {
            echo "<h3> Failed </h3>";
            $mensaje="failed";
        }
        $this->conn->close();
    }

    public function modificar($nombre,$dni,$localidad,$id,&$mensaje){
      $sql="UPDATE clientes SET nombre='$nombre',dni='$dni',localidad=$localidad  where id=$id ";
      if ($this->conn->query($sql) === TRUE) {
        $mensaje="succcess";
        echo "<h3> succcess </h3>";
        } else {
            echo "<h3> Failed </h3>";
            $mensaje="failed";
        }
        $this->conn->close();
    }





}
?>
