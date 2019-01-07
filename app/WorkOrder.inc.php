<?php
class WorkOrder{
  private $id;
  private $id_rfq;
  private $company;
  private $address;
  private $phone;
  private $client;
  private $date;
  private $contract_number;
  private $bpa;

  public function __construct($id, $id_rfq, $company, $address, $phone, $client, $date, $contract_number, $bpa){
    $this-> id = $id;
    $this-> id_rfq = $id_rfq;
    $this-> company = $company;
    $this-> address = $address;
    $this-> phone = $phone;
    $this-> client = $client;
    $this-> date = $date;
    $this-> contract_number = $contract_number;
    $this-> bpa = $bpa;
  }

  public function get_id(){
    return $this-> id;
  }

  public function get_id_rfq(){
    return $this-> id_rfq;
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

  public function get_contract_number(){
    return $this-> contract_number;
  }

  public function get_bpa(){
    return $this-> bpa;
  }
}
?>
