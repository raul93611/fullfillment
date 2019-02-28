<?php
class ShipTo{
  private $id;
  private $ship_to;

  public function __construct($id, $ship_to){
    $this-> id = $id;
    $this-> ship_to = $ship_to;
  }

  public function get_id(){
    return $this-> id;
  }

  public function get_ship_to(){
    return $this-> ship_to;
  }
}
?>
