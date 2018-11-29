<?php
if(isset($_POST['send'])){
  $error = false;
  if(isset($_POST['password1']) && !empty($_POST['password1']) && isset($_POST['password2']) && !empty($_POST['password2'])){
    if($_POST['password1'] == $_POST['password2']){
      $password = password_hash($_POST['password1'], PASSWORD_DEFAULT);
      ConnectionFullFillment::open_connection();
      $hash_exists = UserFullFillmentRepository::hash_exists(ConnectionFullFillment::get_connection(), $_POST['hash']);
      if($hash_exists){
        $user = UserFullFillmentRepository::get_user_by_hash(ConnectionFullFillment::get_connection(), $_POST['hash']);
        UserFullFillmentRepository::update_password(ConnectionFullFillment::get_connection(), $password, $user-> get_id());
        UserFullFillmentRepository::remove_hash(ConnectionFullFillment::get_connection(), $user-> get_id());
      }else {
        $error = true;
      }
      ConnectionFullFillment::close_connection();
    }else{
      $error = true;
    }
  }else{
    $error = true;
  }
}
?>
