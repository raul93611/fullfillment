<?php
class RfqFullFillmentPart{
  private $id;
  private $id_rfq;
  private $name;
  private $po_number;
  private $business_classification;
  private $description;
  private $po_date;
  private $eta;
  private $consolidate_others;
  private $total_vendor_cost;
  private $fedbid;
  private $estimated_final_cost;
  private $estimated_profit_g;
  private $percent_g;
  private $estimated_profit_s;
  private $percent_s;
  private $fullfillment_date;
  private $in_process;
  private $in_process_date;
  private $invoice;
  private $invoice_date;
  private $payment_terms;

  public function __construct($id, $id_rfq, $name, $po_number, $business_classification, $description, $po_date, $eta, $consolidate_others, $total_vendor_cost, $fedbid, $estimated_final_cost, $estimated_profit_g, $percent_g, $estimated_profit_s, $percent_s, $fullfillment_date, $in_process, $in_process_date, $invoice, $invoice_date, $payment_terms){
    $this-> id = $id;
    $this-> id_rfq = $id_rfq;
    $this-> name = $name;
    $this-> po_number = $po_number;
    $this-> business_classification = $business_classification;
    $this-> description = $description;
    $this-> po_date = $po_date;
    $this-> eta = $eta;
    $this-> consolidate_others = $consolidate_others;
    $this-> total_vendor_cost = $total_vendor_cost;
    $this-> fedbid = $fedbid;
    $this-> estimated_final_cost = $estimated_final_cost;
    $this-> estimated_profit_g = $estimated_profit_g;
    $this-> percent_g = $percent_g;
    $this-> estimated_profit_s = $estimated_profit_s;
    $this-> percent_s = $percent_s;
    $this-> fullfillment_date = $fullfillment_date;
    $this-> in_process = $in_process;
    $this-> in_process_date = $in_process_date;
    $this-> invoice = $invoice;
    $this-> invoice_date = $invoice_date;
    $this-> payment_terms = $payment_terms;
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

  public function get_po_number(){
    return $this-> po_number;
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

  public function get_eta(){
    return $this-> eta;
  }

  public function get_consolidate_others(){
    return $this-> consolidate_others;
  }

  public function get_total_vendor_cost(){
    return $this-> total_vendor_cost;
  }

  public function get_fedbid(){
    return $this-> fedbid;
  }

  public function get_estimated_final_cost(){
    return $this-> estimated_final_cost;
  }

  public function get_estimated_profit_g(){
    return $this-> estimated_profit_g;
  }

  public function get_percent_g(){
    return $this-> percent_g;
  }

  public function get_estimated_profit_s(){
    return $this-> estimated_profit_s;
  }

  public function get_percent_s(){
    return $this-> percent_s;
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

  public function get_payment_terms(){
    return $this-> payment_terms;
  }
}
?>
