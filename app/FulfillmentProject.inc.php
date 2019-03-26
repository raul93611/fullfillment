<?php
class FulfillmentProject{
  private $id;
  private $id_project;
  private $received;
  private $received_date;

  public function __construct($id, $id_project, $received, $received_date){
    $this-> id = $id;
    $this-> id_project = $id_project;
    $this-> received = $received;
    $this-> received_date = $received_date;
  }

  public function get_id(){
    return $this-> id;
  }

  public function get_id_project(){
    return $this-> id_project;
  }

  public function get_received(){
    return $this-> received;
  }

  public function get_received_date(){
    return $this-> received_date;
  }
}
?>
