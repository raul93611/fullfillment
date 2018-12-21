<?php
class PackingSlipItem{
  private $id;
  private $id_packing_slip;
  private $id_item;
  private $unit_type;
  private $back_order_quantity;

  public function __construct($id, $id_packing_slip, $id_item, $unit_type, $back_order_quantity){
    $this-> id = $id;
    $this-> id_packing_slip = $id_packing_slip;
    $this-> id_item = $id_item;
    $this-> unit_type = $unit_type;
    $this-> back_order_quantity = $back_order_quantity;
  }

  public function get_id(){
    return $this-> id;
  }

  public function get_id_packing_slip(){
    return $this-> id_packing_slip;
  }

  public function get_id_item(){
    return $this-> id_item;
  }

  public function get_unit_type(){
    return $this-> unit_type;
  }

  public function get_back_order_quantity(){
    return $this-> back_order_quantity;
  }
}
?>
