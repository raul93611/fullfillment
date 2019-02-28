<?php
if(isset($_POST['log_in'])){
  ConnectionFullFillment::open_connection();
  $validator = new UserLoginValidatorFullFillment($_POST['username'], $_POST['password'], ConnectionFullFillment::get_connection());
  if($validator-> get_error() == '' && !is_null($validator->get_user())){
    SessionControl::log_in($validator->get_user()->get_id(), $validator->get_user()->get_username(), $validator-> get_user()-> get_level());
    ConnectionFullFillment::close_connection();
    Redirection::redirect1(PROFILE);
  }
}
?>
