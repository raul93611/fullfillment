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
  case 'received':
    include_once 'templates/received.inc.php';
    break;
  case 'in_process':
    include_once 'templates/in_process.inc.php';
    break;
  case 'invoices':
    include_once 'templates/invoices.inc.php';
    break;
  case 'sign_in':
    include_once 'templates/sign_in.inc.php';
    break;
  case 'edit_user':
    include_once 'templates/edit_user.inc.php';
    break;
  case 'edit_quote':
    include_once 'templates/edit_quote.inc.php';
    break;
  case 'add_item':
    include_once 'templates/add_item.inc.php';
    break;
  case 'edit_item':
    include_once 'templates/edit_item.inc.php';
    break;
  case 'add_provider':
    include_once 'templates/add_provider.inc.php';
    break;
  case 'edit_provider':
    include_once 'templates/edit_provider.inc.php';
    break;
  case 'add_subitem':
    include_once 'templates/add_subitem.inc.php';
    break;
  case 'edit_subitem':
    include_once 'templates/edit_subitem.inc.php';
    break;
  case 'add_provider_subitem':
    include_once 'templates/add_provider_subitem.inc.php';
    break;
  case 'edit_provider_subitem':
    include_once 'templates/edit_provider_subitem.inc.php';
    break;
  case 'tracking':
    include_once 'templates/tracking.inc.php';
    break;
  case 'employee_docs_page':
    include_once 'templates/employee_docs_page.inc.php';
    break;
}
include_once 'templates/end_document.inc.php';
?>
