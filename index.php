<?php
include_once 'app/config.inc.php';
include_once 'app/ConnectionFullFillment.inc.php';
include_once 'app/SessionControl.inc.php';
include_once '../rfp/app/Redirection.inc.php';

include_once 'app/CommentRfqFullFillment.inc.php';
include_once 'app/RepositorioRfqFullFillmentComment.inc.php';

include_once 'app/RfqFullFillmentPart.inc.php';
include_once 'app/RfqFullFillmentPartRepository.inc.php';

include_once '../rfq/app/Conexion.inc.php';

include_once '../rfq/app/Usuario.inc.php';
include_once '../rfq/app/RepositorioUsuario.inc.php';

include_once '../rfq/app/Rfq.inc.php';
include_once 'app/RepositorioRfqFullFillment.inc.php';

include_once '../rfq/app/Item.inc.php';
include_once 'app/RepositorioItemFullFillment.inc.php';

include_once '../rfq/app/Provider.inc.php';
include_once 'app/RepositorioProviderFullFillment.inc.php';

include_once '../rfq/app/Subitem.inc.php';
include_once 'app/RepositorioSubitemFullFillment.inc.php';

include_once '../rfq/app/ProviderSubitem.inc.php';
include_once 'app/RepositorioProviderSubitemFullFillment.inc.php';

include_once '../rfp/app/User.inc.php';
include_once 'app/UserFullFillmentRepository.inc.php';
include_once 'app/UserValidator.inc.php';
include_once 'app/UserLoginValidatorFullFillment.inc.php';
include_once '../rfp/app/UserSignInValidator.inc.php';

include_once 'app/Tracking.inc.php';
include_once 'app/TrackingRepository.inc.php';

include_once 'app/TrackingSubitem.inc.php';
include_once 'app/TrackingSubitemRepository.inc.php';

$url_components = parse_url($_SERVER['REQUEST_URI']);
$route = $url_components['path'];

$parts_route = explode('/', $route);
$parts_route = array_filter($parts_route);
$parts_route = array_slice($parts_route, 0);
$chosen_route = 'views/404.php';

if($parts_route[0] == 'fullfillment'){
  if(count($parts_route) == 1){
    $chosen_route = 'views/home.php';
  }else if(count($parts_route) == 2){
    switch ($parts_route[1]) {
      case 'profile':
        $current_manager = '';
        $chosen_route = 'views/profile.php';
        break;
      case 'generate_user':
        $chosen_route = 'tools/generate_user.php';
        break;
      case 'save_edit_user':
        $chosen_route = 'scripts/save_edit_user.php';
        break;
      case 'save_quote':
        $chosen_route = 'scripts/save_quote.php';
        break;
      case 'save_add_item':
        $chosen_route = 'scripts/save_add_item.php';
        break;
      case 'save_edit_item':
        $chosen_route = 'scripts/save_edit_item.php';
        break;
      case 'save_add_provider':
        $chosen_route = 'scripts/save_add_provider.php';
        break;
      case 'save_edit_provider':
        $chosen_route = 'scripts/save_edit_provider.php';
        break;
      case 'save_add_subitem':
        $chosen_route = 'scripts/save_add_subitem.php';
        break;
      case 'save_edit_subitem':
        $chosen_route = 'scripts/save_edit_subitem.php';
        break;
      case 'save_add_provider_subitem':
        $chosen_route = 'scripts/save_add_provider_subitem.php';
        break;
      case 'save_edit_provider_subitem':
        $chosen_route = 'scripts/save_edit_provider_subitem.php';
        break;
      case 'save_comment_rfq':
        $chosen_route = 'scripts/save_comment_rfq.php';
        break;
      case 'save_rfq_fullfillmet_info':
        $chosen_route = 'scripts/save_rfq_fullfillment_info.php';
        break;
      case 'save_tracking':
        $chosen_route = 'scripts/save_tracking.php';
        break;
      case 'save_tracking_subitem':
        $chosen_route = 'scripts/save_tracking_subitem.php';
        break;
      case 'log_out':
        $chosen_route = 'scripts/log_out.php';
        break;
      case 'recover_password_form':
        $chosen_route = 'tools/recover_password_form.php';
        break;
      default:
        break;
    }
  }else if(count($parts_route) == 3){
    switch ($parts_route[1]) {
      case 'profile':
        $chosen_route = 'views/profile.php';
        switch ($parts_route[2]) {
          case 'received':
            $current_manager = 'received';
            break;
          case 'in_process':
            $current_manager = 'in_process';
            break;
          case 'invoices':
            $current_manager = 'invoices';
            break;
          case 'sign_in':
            $current_manager = 'sign_in';
            break;
          case 'edit_user':
            $current_manager = 'edit_user';
            break;
          case 'employee_docs_page':
            $current_manager = 'employee_docs_page';
            $chosen_route = 'views/profile.php';
            break;
          default:
            break;
        }
        break;
      case 'disable_user':
        $id_user = $parts_route[2];
        $chosen_route = 'scripts/disable_user.php';
        break;
      case 'enable_user':
        $id_user = $parts_route[2];
        $chosen_route = 'scripts/enable_user.php';
        break;
      case 'delete_item':
        $id_item = $parts_route[2];
        $chosen_route = 'scripts/delete_item.php';
        break;
      case 'delete_provider':
        $id_provider = $parts_route[2];
        $chosen_route = 'scripts/delete_provider.php';
        break;
      case 'delete_subitem':
        $id_subitem = $parts_route[2];
        $chosen_route = 'scripts/delete_subitem.php';
        break;
      case 'delete_provider_subitem';
        $id_provider_subitem = $parts_route[2];
        $chosen_route = 'scripts/delete_provider_subitem.php';
        break;
      case 'delete_tracking':
        $id_tracking = $parts_route[2];
        $chosen_route = 'scripts/delete_tracking.php';
        break;
      case 'delete_tracking_subitem':
        $id_tracking_subitem = $parts_route[2];
        $chosen_route = 'scripts/delete_tracking_subitem.php';
        break;
      case 'pdf_items_table':
        $id_rfq = $parts_route[2];
        $chosen_route = 'scripts/pdf_items_table.php';
        break;
      case 'tracking_pdf':
        $id_rfq = $parts_route[2];
        $chosen_route = 'scripts/tracking_pdf.php';
        break;
      case 'load_img':
        $id_rfq = $parts_route[2];
        $chosen_route = 'scripts/load_img.php';
        break;
      case 'restart_password':
        $hash = $parts_route[2];
        $chosen_route = 'tools/restart_password.php';
        break;
      default;
        break;
    }
  }else if(count($parts_route) == 4){
    switch ($parts_route[1]) {
      case 'profile':
        $chosen_route = 'views/profile.php';
        switch ($parts_route[2]) {
          case 'edit_user':
            $current_manager = 'edit_user';
            $id_user = $parts_route[3];
            break;
          case 'edit_quote':
            $current_manager = 'edit_quote';
            $id_rfq = $parts_route[3];
            break;
          case 'add_item':
            $current_manager = 'add_item';
            $id_rfq = $parts_route[3];
            break;
          case 'edit_item':
            $current_manager = 'edit_item';
            $id_item = $parts_route[3];
            break;
          case 'add_provider':
            $current_manager = 'add_provider';
            $id_item = $parts_route[3];
            break;
          case 'edit_provider':
            $current_manager = 'edit_provider';
            $id_provider = $parts_route[3];
            break;
          case 'add_subitem':
            $current_manager = 'add_subitem';
            $id_item = $parts_route[3];
            break;
          case 'edit_subitem':
            $current_manager = 'edit_subitem';
            $id_subitem = $parts_route[3];
            break;
          case 'add_provider_subitem':
            $current_manager = 'add_provider_subitem';
            $id_subitem = $parts_route[3];
            break;
          case 'edit_provider_subitem':
            $current_manager = 'edit_provider_subitem';
            $id_provider_subitem = $parts_route[3];
            break;
          case 'tracking':
            $current_manager = 'tracking';
            $id_rfq = $parts_route[3];
            break;
          default:
            break;
        }
        break;
        case 'delete_document':
          $id_rfq = $parts_route[2];
          $archivo = $parts_route[3];
          $chosen_route = 'scripts/delete_document.php';
          break;
      default:
        break;
    }
  }
}
include_once $chosen_route;
?>
