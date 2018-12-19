<?php
class ExtraItem{
  private $id;
  private $id_item;
  private $payment_terms;

  public function __construct($id, $id_item, $payment_terms){
    $this-> id = $id;
    $this-> id_item = $id_item;
    $this-> payment_terms = $payment_terms;
  }

  public function get_id(){
    return $this-> id;
  }

  public function get_id_item(){
    return $this-> id_item;
  }

  public function get_payment_terms(){
    return $this-> payment_terms;
  }
}
?>
