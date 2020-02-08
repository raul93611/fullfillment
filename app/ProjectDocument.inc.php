<?php
class ProjectDocument{
  private $id;
  private $id_fulfillment_project;
  private $documents_name;
  private $comment;
  private $document_date;
  private $username;

  public function __construct($id, $id_fulfillment_project, $documents_name, $comment, $document_date, $username){
    $this-> id = $id;
    $this-> id_fulfillment_project = $id_fulfillment_project;
    $this-> documents_name = $documents_name;
    $this-> comment = $comment;
    $this-> document_date = $document_date;
    $this-> username = $username;
  }

  public function get_id(){
    return $this-> id;
  }

  public function get_id_fulfillment_project(){
    return $this-> id_fulfillment_project;
  }

  public function get_documents_name(){
    return $this-> documents_name;
  }

  public function get_comment(){
    return $this-> comment;
  }

  public function get_document_date(){
    return $this-> document_date;
  }

  public function get_username(){
    return $this-> username;
  }
}
?>
