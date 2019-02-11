<?php
class WorkOrderItem{
  private $id;
  private $id_work_order;
  private $equipment;

  public function __construct($id, $id_work_order, $equipment){
    $this-> id = $id;
    $this-> id_work_order = $id_work_order;
    $this-> equipment = $equipment;
  }

  public function get_id(){
    return $this-> id;
  }

  public function get_id_work_order(){
    return $this-> id_work_order;
  }

  public function get_equipment(){
    return $this-> equipment;
  }
}
?>
