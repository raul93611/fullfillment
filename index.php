<?php
session_save_path('temp');
session_start();
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

include_once 'app/ExtraItem.inc.php';
include_once 'app/ExtraItemRepository.inc.php';
include_once 'app/ExtraSubitem.inc.php';
include_once 'app/ExtraSubitemRepository.inc.php';

include_once 'app/PurchaseOrder.inc.php';
include_once 'app/PurchaseOrderRepository.inc.php';
include_once 'app/PurchaseOrderItem.inc.php';
include_once 'app/PurchaseOrderItemRepository.inc.php';

include_once 'app/WorkOrder.inc.php';
include_once 'app/WorkOrderRepository.inc.php';
include_once 'app/WorkOrderItem.inc.php';
include_once 'app/WorkOrderItemRepository.inc.php';
include_once 'app/WorkOrderItemDetail.inc.php';
include_once 'app/WorkOrderItemDetailRepository.inc.php';

include_once 'app/PackingSlip.inc.php';
include_once 'app/PackingSlipItem.inc.php';
include_once 'app/PackingSlipSubitem.inc.php';
include_once 'app/PackingSlipRepository.inc.php';
include_once 'app/PackingSlipItemRepository.inc.php';
include_once 'app/PackingSlipSubitemRepository.inc.php';

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
      case 'save_payment_terms_item':
        $chosen_route = 'scripts/save_payment_terms_item.php';
        break;
      case 'save_payment_terms_subitem':
        $chosen_route = 'scripts/save_payment_terms_subitem.php';
        break;
      case 'save_new_purchase_order_item':
        $chosen_route = 'scripts/save_new_purchase_order_item.php';
        break;
      case 'save_edit_purchase_order_item':
        $chosen_route = 'scripts/save_edit_purchase_order_item.php';
        break;
      case 'remove_purchase_order_item':
        $chosen_route = 'scripts/remove_purchase_order_item.php';
        break;
      case 'save_edit_shipment_cost':
        $chosen_route = 'scripts/save_edit_shipment_cost.php';
        break;
      case 'save_purchase_order':
        $chosen_route = 'scripts/save_purchase_order.php';
        break;
      case 'save_work_order':
        $chosen_route = 'scripts/save_work_order.php';
        break;
      case 'save_new_work_order_item':
        $chosen_route = 'scripts/save_new_work_order_item.php';
        break;
      case 'save_new_work_order_item_detail':
        $chosen_route = 'scripts/save_new_work_order_item_detail.php';
        break;
      case 'save_edit_work_order_item':
        $chosen_route = 'scripts/save_edit_work_order_item.php';
        break;
      case 'remove_work_order_item_detail':
        $chosen_route = 'scripts/remove_work_order_item_detail.php';
        break;
      case 'remove_work_order_item':
        $chosen_route = 'scripts/remove_work_order_item.php';
        break;
      case 'save_packing_slip':
        $chosen_route = 'scripts/save_packing_slip.php';
        break;
      case 'save_new_packing_slip_item':
        $chosen_route = 'scripts/save_new_packing_slip_item.php';
        break;
      case 'save_new_packing_slip_subitem':
        $chosen_route = 'scripts/save_new_packing_slip_subitem.php';
        break;
      case 'save_edit_packing_slip_item':
        $chosen_route = 'scripts/save_edit_packing_slip_item.php';
        break;
      case 'save_edit_packing_slip_subitem':
        $chosen_route = 'scripts/save_edit_packing_slip_subitem.php';
        break;
      case 'remove_packing_slip_item':
        $chosen_route = 'scripts/remove_packing_slip_item.php';
        break;
      case 'remove_packing_slip_subitem':
        $chosen_route = 'scripts/remove_packing_slip_subitem.php';
        break;
      case 'disable_user':
        $chosen_route = 'scripts/disable_user.php';
        break;
      case 'load_users':
        $chosen_route = 'scripts/load_users.php';
        break;
      case 'enable_user':
        $id_user = $parts_route[2];
        $chosen_route = 'scripts/enable_user.php';
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
      case 'load_payment_terms_item':
        $id_item = $parts_route[2];
        $chosen_route = 'scripts/load_payment_terms_item.php';
        break;
      case 'load_payment_terms_subitem':
        $id_subitem = $parts_route[2];
        $chosen_route = 'scripts/load_payment_terms_subitem.php';
        break;
      case 'new_purchase_order':
        $id_rfq = $parts_route[2];
        $chosen_route = 'scripts/new_purchase_order.php';
        break;
      case 'load_purchase_order_items':
        $id_purchase_order = $parts_route[2];
        $chosen_route = 'scripts/load_purchase_order_items.php';
        break;
      case 'load_purchase_order_item':
        $id_purchase_order_item = $parts_route[2];
        $chosen_route = 'scripts/load_purchase_order_item.php';
        break;
      case 'load_shipment_cost':
        $id_purchase_order = $parts_route[2];
        $chosen_route = 'scripts/load_shipment_cost.php';
        break;
      case 'purchase_order_pdf':
        $id_purchase_order = $parts_route[2];
        $chosen_route = 'scripts/purchase_order_pdf.php';
        break;
      case 'load_all_purchase_orders':
        $id_rfq = $parts_route[2];
        $chosen_route = 'scripts/load_all_purchase_orders.php';
        break;
      case 'delete_purchase_order':
        $id_purchase_order = $parts_route[2];
        $chosen_route = 'scripts/delete_purchase_order.php';
        break;
      case 'new_work_order':
        $id_rfq = $parts_route[2];
        $chosen_route = 'scripts/new_work_order.php';
        break;
      case 'load_work_order_items':
        $id_work_order = $parts_route[2];
        $chosen_route = 'scripts/load_work_order_items.php';
        break;
      case 'load_work_order_item':
        $id_work_order_item = $parts_route[2];
        $chosen_route = 'scripts/load_work_order_item.php';
        break;
      case 'work_order_pdf':
        $id_work_order = $parts_route[2];
        $chosen_route = 'scripts/work_order_pdf.php';
        break;
      case 'load_all_work_orders':
        $id_rfq = $parts_route[2];
        $chosen_route = 'scripts/load_all_work_orders.php';
        break;
      case 'delete_work_order':
        $id_work_order = $parts_route[2];
        $chosen_route = 'scripts/delete_work_order.php';
        break;
      case 'load_packing_slip_items':
        $id_rfq = $parts_route[2];
        $chosen_route = 'scripts/load_packing_slip_items.php';
        break;
      case 'load_packing_slip_item':
        $id_item = $parts_route[2];
        $chosen_route = 'scripts/load_packing_slip_item.php';
        break;
      case 'load_packing_slip_subitem':
        $id_subitem = $parts_route[2];
        $chosen_route = 'scripts/load_packing_slip_subitem.php';
        break;
      case 'packing_slip_pdf':
        $id_packing_slip = $parts_route[2];
        $chosen_route = 'scripts/packing_slip_pdf.php';
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
          case 'packing_slip':
            $current_manager = 'packing_slip';
            $id_rfq = $parts_route[3];
            break;
          case 'purchase_order':
            $current_manager = 'purchase_order';
            $id_purchase_order = $parts_route[3];
            break;
          case 'work_order':
            $current_manager = 'work_order';
            $id_work_order = $parts_route[3];
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
