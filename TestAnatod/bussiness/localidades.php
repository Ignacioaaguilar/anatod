<?php
require_once ('data/class.database.php');
class Localidades extends  class_db
{

    public function getAllLocalidades() {
      $result = $this->conn->query( "SELECT l.id as idLocalidad,l.nombre FROM localidades l  ");
      return $result;
    }


}
?>
