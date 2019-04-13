<?php
class FulfillmentProject{
  private $id;
  private $id_project;
  private $received;
  private $received_date;
  private $name;
  private $business_classification;
  private $due_date;
  private $ship_to;
  private $accounting_completed;
  private $accounting_completed_date;
  private $order_date;

  public function __construct($id, $id_project, $received, $received_date, $name, $business_classification, $due_date, $ship_to, $accounting_completed, $accounting_completed_date, $order_date){
    $this-> id = $id;
    $this-> id_project = $id_project;
    $this-> received = $received;
    $this-> received_date = $received_date;
    $this-> name = $name;
    $this-> business_classification = $business_classification;
    $this-> due_date = $due_date;
    $this-> ship_to = $ship_to;
    $this-> accounting_completed = $accounting_completed;
    $this-> accounting_completed_date = $accounting_completed_date;
    $this-> order_date = $order_date;
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

  public function get_name(){
    return $this-> name;
  }

  public function get_business_classification(){
    return $this-> business_classification;
  }

  public function get_due_date(){
    return $this-> due_date;
  }

  public function get_ship_to(){
    return $this-> ship_to;
  }

  public function get_accounting_completed(){
    return $this-> accounting_completed;
  }

  public function get_accounting_completed_date(){
    return $this-> accounting_completed_date;
  }

  public function get_order_date(){
    return $this-> order_date;
  }
}
?>
