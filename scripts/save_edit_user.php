<?php
if(isset($_POST['edit_user'])){
  if(empty($_POST['password'])){
    $password = '';
  }else{
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  }
  ConnectionFullFillment::open_connection();
  UserFullFillmentRepository::edit_user(ConnectionFullFillment::get_connection(), $password, $_POST['username'], $_POST['names'], $_POST['last_names'], $_POST['email'], $_POST['id_user']);
  ConnectionFullFillment::close_connection();
  Redirection::redirect(PROFILE);
}
?>
