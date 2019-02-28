<?php
class AccountingItemPrice{
  private $id;
  private $id_item;
  private $company;
  private $quantity;
  private $unit_cost;
  private $other_cost;
  private $real_cost;

  public function __construct($id, $id_item, $company, $quantity, $unit_cost, $other_cost, $real_cost){
    $this-> id = $id;
    $this-> id_item = $id_item;
    $this-> company = $company;
    $this-> quantity = $quantity;
    $this-> unit_cost = $unit_cost;
    $this-> other_cost = $other_cost;
    $this-> real_cost = $real_cost;
  }

  public function get_id(){
    return $this-> id;
  }

  public function get_id_item(){
    return $this-> id_item;
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
}
?>
