<?php
class ExtraCost{
  private $id;
  private $id_rfq;
  private $description;
  private $cost;

  public function __construct($id, $id_rfq, $description, $cost){
    $this-> id = $id;
    $this-> id_rfq = $id_rfq;
    $this-> description = $description;
    $this-> cost = $cost;
  }

  public function get_id(){
    return $this-> id;
  }

  public function get_id_rfq(){
    return $this-> id_rfq;
  }

  public function get_description(){
    return $this-> description;
  }

  public function get_cost(){
    return $this-> cost;
  }
}
?>
