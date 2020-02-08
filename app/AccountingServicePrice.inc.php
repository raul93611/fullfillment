<?php
class AccountingServicePrice{
  private $id;
  private $id_service;
  private $company;
  private $quantity;
  private $unit_cost;
  private $other_cost;
  private $real_cost;
  private $id_fulfillment_project;

  public function __construct($id, $id_service, $company, $quantity, $unit_cost, $other_cost, $real_cost, $id_fulfillment_project){
    $this-> id = $id;
    $this-> id_service = $id_service;
    $this-> company = $company;
    $this-> quantity = $quantity;
    $this-> unit_cost = $unit_cost;
    $this-> other_cost = $other_cost;
    $this-> real_cost = $real_cost;
    $this-> id_fulfillment_project = $id_fulfillment_project;
  }

  public function get_id(){
    return $this-> id;
  }

  public function get_id_service(){
    return $this-> id_service;
  }

  public function get_company(){
    return $this-> company;
  }

  public function get_quantity(){
    return $this-> quantity;
  }

  public function get_unit_cost(){
    return $this-> unit_cost;
  }

  public function get_other_cost(){
    return $this-> other_cost;
  }

  public function get_real_cost(){
    return $this-> real_cost;
  }

  public function get_id_fulfillment_project(){
    return $this-> id_fulfillment_project;
  }
}
?>
