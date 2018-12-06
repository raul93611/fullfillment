<?php
class ExtraSubitem{
  private $id;
  private $id_subitem;
  private $payment_terms;

  public function __construct($id, $id_subitem, $payment_terms){
    $this-> id = $id;
    $this-> id_subitem = $id_subitem;
    $this-> payment_terms = $payment_terms;
  }

  public function get_id(){
    return $this-> id;
  }

  public function get_id_subitem(){
    return $this-> id_subitem;
  }

  public function get_payment_terms(){
    return $this-> payment_terms;
  }
}
?>
