<?php
class UserLoginValidatorFullFillment extends UserValidator{
  private $user;
  private $error;

  public function __construct($username, $password, $connection) {
    $this->open_alert = "<br><div class='alert alert-danger' role='alert'>";
    $this->close_alert = "</div>";
    $this->error = '';

    if (!$this->started_variable($username) || !$this->started_variable($password)) {
      $this->user = null;
      $this->error = 'Must be fill out.';
    } else {
      $this->user = UserFullFillmentRepository::get_user_by_username($connection, $username);
      if (is_null($this->user) || !password_verify($password, $this->user->get_password()) || !$this-> user-> get_status()) {
        $this->error = 'Error.';
      }
    }
  }

  public function get_user() {
    return $this->user;
  }

  public function get_error() {
    return $this->error;
  }

  public function show_error() {
    if ($this->error != '') {
      echo $this->open_alert . $this->error . $this->close_alert;
    }
  }
}
?>
