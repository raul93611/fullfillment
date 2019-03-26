<?php
class Member{
  private $id;
  private $id_fulfillment_project;
  private $names;

  public function __construct($id, $id_fulfillment_project, $names){
    $this-> id = $id;
    $this-> id_fulfillment_project = $id_fulfillment_project;
    $this-> names = $names;
  }

  public function get_id(){
    return $this-> id;
  }

  public function get_id_fulfillment_project(){
    return $this-> id_fulfillment_project;
  }

  public function get_names(){
    return $this-> names;
  }
}
?>
