<?php
class WorkOrderItemDetail{
  private $id;
  private $id_work_order_item;
  private $detail_name;
  private $detail;
  private $keycode;
  private $notes;
  private $technitian;

  public function __construct($id, $id_work_order_item, $detail_name, $detail, $keycode, $notes, $technitian){
    $this-> id = $id;
    $this-> id_work_order_item = $id_work_order_item;
    $this-> detail_name = $detail_name;
    $this-> detail = $detail;
    $this-> keycode = $keycode;
    $this-> notes = $notes;
    $this-> technitian = $technitian;
  }

  public function get_id(){
    return $this-> id;
  }

  public function get_id_work_order_item(){
    return $this-> id_work_order_item;
  }

  public function get_detail_name(){
    return $this-> detail_name;
  }

  public function get_detail(){
    return $this-> detail;
  }

  public function get_keycode(){
    return $this-> keycode;
  }

  public function get_notes(){
    return $this-> notes;
  }

  public function get_technitian(){
    return $this-> technitian;
  }
}
?>
