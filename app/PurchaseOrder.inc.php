<?php
class PurchaseOrder{
  private $id;
  private $id_rfq;
  private $responsible;
  private $date;
  private $purchase_from;
  private $drop_ship_to;
  private $comments;
  private $ref_quote;
  private $ship_via;
  private $order_date;
  private $terms;
  private $subtotal;
  private $shipment_cost;
  private $total;
  private $message;
  private $taxes;
  private $doc_name;

  public function __construct($id, $id_rfq, $responsible, $date, $purchase_from, $drop_ship_to, $comments, $ref_quote, $ship_via, $order_date, $terms, $subtotal, $shipment_cost, $total, $message, $taxes, $doc_name){
    $this-> id = $id;
    $this-> id_rfq = $id_rfq;
    $this-> responsible = $responsible;
    $this-> date = $date;
    $this-> purchase_from = $purchase_from;
    $this-> drop_ship_to = $drop_ship_to;
    $this-> comments = $comments;
    $this-> ref_quote = $ref_quote;
    $this-> ship_via = $ship_via;
    $this-> order_date = $order_date;
    $this-> terms = $terms;
    $this-> subtotal = $subtotal;
    $this-> shipment_cost = $shipment_cost;
    $this-> total = $total;
    $this-> message = $message;
    $this-> taxes = $taxes;
    $this-> doc_name = $doc_name;
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

  public function get_date(){
    return $this-> date;
  }

  public function get_purchase_from(){
    return $this-> purchase_from;
  }

  public function get_drop_ship_to(){
    return $this-> drop_ship_to;
  }

  public function get_comments(){
    return $this-> comments;
  }

  public function get_ref_quote(){
    return $this-> ref_quote;
  }

  public function get_ship_via(){
    return $this-> ship_via;
  }

  public function get_order_date(){
    return $this-> order_date;
  }

  public function get_terms(){
    return $this-> terms;
  }

  public function get_subtotal(){
    return $this-> subtotal;
  }

  public function get_shipment_cost(){
    return $this-> shipment_cost;
  }

  public function get_total(){
    return $this-> total;
  }

  public function get_message(){
    return $this-> message;
  }

  public function get_taxes(){
    return $this-> taxes;
  }

  public function get_doc_name(){
    return $this-> doc_name;
  }
}
?>
