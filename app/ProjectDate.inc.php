<?php
class ProjectDate{
  private $id;
  private $id_fulfillment_project;
  private $date;
  private $comment;

  public function __construct($id, $id_fulfillment_project, $date, $comment){
    $this-> id = $id;
    $this-> id_fulfillment_project = $id_fulfillment_project;
    $this-> date = $date;
    $this-> comment = $comment;
  }

  public function get_id(){
    return $this-> id;
  }

  public function get_id_fulfillment_project(){
    return $this-> id_fulfillment_project;
  }

  public function get_date(){
    return $this-> date;
  }

  public function get_comment(){
    return $this-> comment;
  }
}
?>
