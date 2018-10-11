<?php
if(!SessionControl::session_started()) {
  Redirection::redirect(SERVER);
}

$title = 'Profile';

ConnectionFullFillment::open_connection();
$user = UserFullFillmentRepository::get_user_by_id(ConnectionFullFillment::get_connection(), $_SESSION['id_user']);
ConnectionFullFillment::close_connection();
$level = $user->get_level();

include_once 'templates/head_document.inc.php';
include_once 'templates/navbar.inc.php';
include_once 'templates/sidebar.inc.php';

switch ($current_manager) {
  case '':
    include_once 'templates/dashboard.inc.php';
    break;
  case 'rfq_team':
    include_once 'templates/rfq_team.inc.php';
    break;
}
include_once 'templates/end_document.inc.php';
?>
