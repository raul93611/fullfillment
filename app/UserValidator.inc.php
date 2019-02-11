<?php

abstract class UserValidator {

  protected $open_alert;
  protected $close_alert;

  protected $username;
  protected $password;
  protected $names;
  protected $last_names;
  protected $email;
  protected $username_error;
  protected $password1_error;
  protected $password2_error;
  protected $names_error;
  protected $last_names_error;

  public function __construct() {

  }

  protected function started_variable($variable) {
    if (isset($variable) && !empty($variable)) {
      return true;
    } else {
      return false;
    }
  }

  protected function validate_username($username, $connection) {
    if (!$this->started_variable($username)) {
      return 'Must be fill out.';
    } else {
      $this->username = $username;
    }

    if (!preg_match("/^[a-zA-Z0123456789]*$/", $username)) {
      return 'Wrong values.';
    }

    if(UserFullFillmentRepository::username_exists($connection, $username)){
      return 'Username has already been used.';
    }

    return '';
  }

  protected function validate_names($names) {
    if (!$this->started_variable($names)) {
      return 'Must be fill out.';
    } else {
      $this->names = $names;
    }

    if (!preg_match("/^[a-zA-Z áéíóúÁÉÍÓÚÑñ]*$/", $names)) {
      return 'Wrong values';
    }

    return '';
  }

  protected function validate_last_names($connection, $last_names, $names) {
    if (!$this->started_variable($names)) {
      return 'Must be fill out.';
    }

    if (!$this->started_variable($last_names)) {
      return 'Must be fill out.';
    } else {
      $this->last_names = $last_names;
    }

    if (UserFullFillmentRepository::full_name_exists($connection, $last_names, $names)) {
      return 'Full name has already been used.';
    }
    return '';
  }

  protected function validate_password1($password1) {
    if (!$this->started_variable($password1)) {
      return 'Must be fill out.';
    }
    return '';
  }

  protected function validate_password2($password1, $password2) {
    if (!$this->started_variable($password1)) {
      return 'Must be fill out.';
    }

    if (!$this->started_variable($password2)) {
      return 'Must be fill out.';
    }

    if ($password1 != $password2) {
      return 'Wrong values.';
    }
    return '';
  }

  public function get_username(){
    return $this-> username;
  }

  public function get_password(){
    return $this-> password;
  }

  public function get_names(){
    return $this-> names;
  }

  public function get_last_names(){
    return $this-> last_names;
  }

  public function get_email(){
    return $this-> email;
  }

  public function get_username_error(){
    return $this-> username_error;
  }

  public function get_password1_error(){
    return $this-> password1_error;
  }

  public function get_password2_error(){
    return $this-> password2_error;
  }

  public function get_names_error(){
    return $this-> names_error;
  }

  public function get_last_names_error(){
    return $this-> last_names_error;
  }

  public function show_username(){
    if($this-> username != ''){
      echo 'value="' . $this-> username . '"';
    }
  }

  public function show_names(){
    if($this-> names != ''){
      echo 'value="' . $this-> names . '"';
    }
  }

  public function show_last_names(){
    if($this-> last_names != ''){
      echo 'value="' . $this-> last_names . '"';
    }
  }

  public function show_email(){
    if($this-> email != ''){
      echo 'value="' . $this-> email . '"';
    }
  }

  public function show_username_error(){
    if($this-> username_error != ''){
      echo $this-> open_alert . $this-> username_error . $this-> close_alert;
    }
  }

  public function show_password1_error(){
    if($this-> password1_error != ''){
      echo $this-> open_alert . $this-> password1_error . $this-> close_alert;
    }
  }

  public function show_password2_error(){
    if($this-> password2_error != ''){
      echo $this-> open_alert . $this-> password2_error . $this-> close_alert;
    }
  }

  public function show_names_error(){
    if($this-> names_error != ''){
      echo $this-> open_alert . $this-> names_error . $this-> close_alert;
    }
  }

  public function show_last_names_error(){
    if($this-> last_names_error != ''){
      echo $this-> open_alert . $this-> last_names_error . $this-> close_alert;
    }
  }

  public function valid_record(){
    if($this-> username_error == '' && $this-> password1_error == '' && $this-> password2_error == '' && $this-> names_error == '' && $this-> last_names_error == ''){
      return true;
    }else{
      return false;
    }
  }
}

?>
