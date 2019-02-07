<?php
class PackingSlip{
  private $id;
  private $id_rfq;
  private $responsible;
  private $order_date;
  private $customer_contact;
  private $ship_to;
  private $message;

  public function __construct($id, $id_rfq, $responsible, $order_date, $customer_contact, $ship_to, $message){
    $this-> id = $id;
    $this-> id_rfq = $id_rfq;
    $this-> responsible = $responsible;
    $this-> order_date = $order_date;
    $this-> customer_contact = $customer_contact;
    $this-> ship_to = $ship_to;
    $this-> message = $message;
  }

  public function get_id(){
    return $this-> id;
  }

  public function get_id_rfq(){
    return $this-> id_rfq;
  }

  public function get_responsible(){
    return $this-> responsible;
  }

  public function get_order_date(){
    return $this-> order_date;
  }

  public function get_customer_contact(){
    return $this-> customer_contact;
  }

  public function get_ship_to(){
    return $this-> ship_to;
  }

  public function get_message(){
    return $this-> message;
  }
}
?>
