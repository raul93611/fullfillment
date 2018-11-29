<?php
if(isset($_POST['sign_in'])){
  ConnectionFullFillment::open_connection();
  $validator = new UserSignInValidator($_POST['username'], $_POST['password1'], $_POST['password2'], $_POST['names'], $_POST['last_names'], $_POST['email'], ConnectionFullFillment::get_connection());
  if($validator-> valid_record()){
    $new_user = new User('', $validator-> get_username(), password_hash($validator-> get_password(), PASSWORD_DEFAULT), $validator-> get_names(), $validator-> get_last_names(), 2, $_POST['email'], 0, '');
    $inserted_user = UserFullFillmentRepository::insert_user(ConnectionFullFillment::get_connection(), $new_user);
    if($inserted_user){
      Redirection::redirect1(PROFILE);
    }
  }
  ConnectionFullFillment::close_connection();
}
?>
