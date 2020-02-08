<?php
class PurchaseOrderItem{
  private $id;
  private $id_purchase_order;
  private $part_number;
  private $quantity;
  private $description;
  private $unit_price;
  private $amount;

  public function __construct($id, $id_purchase_order, $part_number, $quantity, $description, $unit_price, $amount){
    $this-> id = $id;
    $this-> id_purchase_order = $id_purchase_order;
    $this-> part_number = $part_number;
    $this-> quantity = $quantity;
    $this-> description = $description;
    $this-> unit_price = $unit_price;
    $this-> amount = $amount;
  }

  public function get_id(){
    return $this-> id;
  }

  public function get_id_purchase_order(){
    return $this-> id_purchase_order;
  }

  public function get_part_number(){
    return $this-> part_number;
  }

  public function get_quantity(){
    return $this-> quantity;
  }

  public function get_description(){
    return $this-> description;
  }

  public function get_unit_price(){
    return $this-> unit_price;
  }

  public function get_amount(){
    return $this-> amount;
  }
}
?>
