<?php
class WorkOrder{
  private $id;
  private $id_rfq;
  private $responsible;
  private $company;
  private $address;
  private $phone;
  private $client;
  private $date;
  private $bpa;
  private $doc_name;

  public function __construct($id, $id_rfq, $responsible, $company, $address, $phone, $client, $date, $bpa, $doc_name){
    $this-> id = $id;
    $this-> id_rfq = $id_rfq;
    $this-> responsible = $responsible;
    $this-> company = $company;
    $this-> address = $address;
    $this-> phone = $phone;
    $this-> client = $client;
    $this-> date = $date;
    $this-> contract_number = $contract_number;
    $this-> bpa = $bpa;
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

  public function get_company(){
    return $this-> company;
  }

  public function get_address(){
    return $this-> address;
  }

  public function get_phone(){
    return $this-> phone;
  }

  public function get_client(){
    return $this-> client;
  }

  public function get_date(){
    return $this-> date;
  }

  public function get_bpa(){
    return $this-> bpa;
  }

  public function get_doc_name(){
    return $this-> doc_name;
  }
}
?>
