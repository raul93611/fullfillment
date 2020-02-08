<?php
class RfqFullFillmentPart{
  private $id;
  private $id_rfq;
  private $name;
  private $business_classification;
  private $description;
  private $po_date;
  private $eta1;
  private $consolidate_others;
  private $fullfillment_date;
  private $in_process;
  private $in_process_date;
  private $invoice;
  private $invoice_date;
  private $eta2;
  private $eta3;
  private $comment_consolidate_others;
  private $due_date;
  private $accounting_ship_to;
  private $accounting_completed;
  private $accounting_completed_date;
  private $order_date;

  public function __construct($id, $id_rfq, $name, $business_classification, $description, $po_date, $eta1, $consolidate_others, $fullfillment_date, $in_process, $in_process_date, $invoice, $invoice_date, $eta2, $eta3, $comment_consolidate_others, $due_date, $accounting_ship_to, $accounting_completed, $accounting_completed_date, $order_date){
    $this-> id = $id;
    $this-> id_rfq = $id_rfq;
    $this-> name = $name;
    $this-> business_classification = $business_classification;
    $this-> description = $description;
    $this-> po_date = $po_date;
    $this-> eta1 = $eta1;
    $this-> consolidate_others = $consolidate_others;
    $this-> fullfillment_date = $fullfillment_date;
    $this-> in_process = $in_process;
    $this-> in_process_date = $in_process_date;
    $this-> invoice = $invoice;
    $this-> invoice_date = $invoice_date;
    $this-> eta2 = $eta2;
    $this-> eta3 = $eta3;
    $this-> comment_consolidate_others = $comment_consolidate_others;
    $this-> due_date = $due_date;
    $this-> accounting_ship_to = $accounting_ship_to;
    $this-> accounting_completed = $accounting_completed;
    $this-> accounting_completed_date = $accounting_completed_date;
    $this-> order_date = $order_date;
  }

  public function get_id(){
    return $this-> id;
  }

  public function get_id_rfq(){
    return $this-> id_rfq;
  }

  public function get_name(){
    return $this-> name;
  }

  public function get_business_classification(){
    return $this-> business_classification;
  }

  public function get_description(){
    return $this-> description;
  }

  public function get_po_date(){
    return $this-> po_date;
  }

  public function get_eta1(){
    return $this-> eta1;
  }

  public function get_consolidate_others(){
    return $this-> consolidate_others;
  }

  public function get_fullfillment_date(){
    return $this-> fullfillment_date;
  }

  public function get_in_process(){
    return $this-> in_process;
  }

  public function get_in_process_date(){
    return $this-> in_process_date;
  }

  public function get_invoice(){
    return $this-> invoice;
  }

  public function get_invoice_date(){
    return $this-> invoice_date;
  }

  public function get_eta2(){
    return $this-> eta2;
  }

  public function get_eta3(){
    return $this-> eta3;
  }

  public function get_comment_consolidate_others(){
    return $this-> comment_consolidate_others;
  }

  public function get_due_date(){
    return $this-> due_date;
  }

  public function get_accounting_ship_to(){
    return $this-> accounting_ship_to;
  }

  public function get_accounting_completed(){
    return $this-> accounting_completed;
  }

  public function get_accounting_completed_date(){
    return $this-> accounting_completed_date;
  }

  public function get_order_date(){
    return $this-> order_date;
  }
}
?>
