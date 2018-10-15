<?php
class RfqFullFillmentPart{
  private $id;
  private $id_rfq;
  private $contract;

  public function __construct($id, $id_rfq, $contract){
    $this-> id = $id;
    $this-> id_rfq = $id_rfq;
    $this-> contract = $contract;
  }

  public function get_id(){
    return $this-> id;
  }

  public function get_id_rfq(){
    return $this-> id_rfq;
  }

  public function get_contract(){
    return $this-> contract;
  }
}
?>
