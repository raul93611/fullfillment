<?php
session_start();
ConnectionFullFillment::open_connection();
$edited_user = UserFullFillmentRepository::enable_user(ConnectionFullFillment::get_connection(), $id_user);
ConnectionFullFillment::close_connection();
if($edited_user){
  Redirection::redirect(PROFILE);
}
?>
