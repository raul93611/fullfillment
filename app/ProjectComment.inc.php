<?php
class ProjectComment{
  private $id;
  private $id_fulfillment_project;
  private $username;
  private $comment;
  private $comment_date;

  public function __construct($id, $id_fulfillment_project, $username, $comment, $comment_date){
    $this-> id = $id;
    $this-> id_fulfillment_project = $id_fulfillment_project;
    $this-> username = $username;
    $this-> comment = $comment;
    $this-> comment_date = $comment_date;
  }

  public function get_id(){
    return $this-> id;
  }

  public function get_id_fulfillment_project(){
    return $this-> id_fulfillment_project;
  }

  public function get_username(){
    return $this-> username;
  }

  public function get_comment(){
    return $this-> comment;
  }

  public function get_comment_date(){
    return $this-> comment_date;
  }
}
?>
