<?php
switch ($level) {
  case 1:
    include_once 'templates/admin_dashboard.inc.php';
    break;
  case 2:
    Redirection::redirect1(RECEIVED_QUOTES);
    break;
  case 3:
    Redirection::redirect1(INVOICES);
  default:
    break;
}
?>
