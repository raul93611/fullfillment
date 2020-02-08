<?php
class ExtraService{
  private $id;
  private $id_fulfillment_project;
  private $description;
  private $cost;

  public function __construct($id, $id_fulfillment_project, $description, $cost){
    $this-> id = $id;
    $this-> id_fulfillment_project = $id_fulfillment_project;
    $this-> description = $description;
    $this-> cost = $cost;
  }

  public function get_id(){
    return $this-> id;
  }

  public function get_id_fulfillment_project(){
    return $this-> id_fulfillment_project;
  }

  public function get_description(){
    return $this-> description;
  }

  public function get_cost(){
    return $this-> cost;
  }
}
?>
