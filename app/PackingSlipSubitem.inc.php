<?php
class PackingSlipSubitem{
  private $id;
  private $id_packing_slip_item;
  private $id_subitem;
  private $unit_type;
  private $back_order_quantity;

  public function __construct($id, $id_packing_slip_item, $id_subitem, $unit_type, $back_order_quantity){
    $this-> id = $id;
    $this-> id_packing_slip_item = $id_packing_slip_item;
    $this-> id_subitem = $id_subitem;
    $this-> unit_type = $unit_type;
    $this-> back_order_quantity = $back_order_quantity;
  }

  public function get_id(){
    return $this-> id;
  }

  public function get_id_packing_slip_item(){
    return $this-> id_packing_slip_item;
  }

  public function get_id_subitem(){
    return $this-> id_subitem;
  }

  public function get_unit_type(){
    return $this-> unit_type;
  }

  public function get_back_order_quantity(){
    return $this-> back_order_quantity;
  }
}
?>
