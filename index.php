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
include_once '../rfq/app/ProposalRepository.inc.php';

include_once '../rfq/app/Comment.inc.php';
include_once '../rfq/app/RepositorioComment.inc.php';

include_once '../rfq/app/Usuario.inc.php';
include_once '../rfq/app/RepositorioUsuario.inc.php';

include_once '../rfq/app/Rfq.inc.php';
include_once '../rfq/app/RepositorioRfq.inc.php';
include_once 'app/RepositorioRfqFullFillment.inc.php';

include_once '../rfq/app/ReQuote.inc.php';
include_once '../rfq/app/ReQuoteRepository.inc.php';

include_once '../rfq/app/ReQuoteItem.inc.php';
include_once '../rfq/app/ReQuoteItemRepository.inc.php';

include_once '../rfq/app/ReQuoteProvider.inc.php';
include_once '../rfq/app/ReQuoteProviderRepository.inc.php';

include_once '../rfq/app/ReQuoteSubitem.inc.php';
include_once '../rfq/app/ReQuoteSubitemRepository.inc.php';

include_once '../rfq/app/ReQuoteSubitemProvider.inc.php';
include_once '../rfq/app/ReQuoteSubitemProviderRepository.inc.php';

include_once '../rfq/app/Item.inc.php';
include_once '../rfq/app/RepositorioItem.inc.php';
include_once 'app/RepositorioItemFullFillment.inc.php';

include_once '../rfq/app/Provider.inc.php';
include_once '../rfq/app/RepositorioProvider.inc.php';
include_once 'app/RepositorioProviderFullFillment.inc.php';

include_once '../rfq/app/Subitem.inc.php';
include_once '../rfq/app/RepositorioSubitem.inc.php';
include_once 'app/RepositorioSubitemFullFillment.inc.php';

include_once '../rfq/app/ProviderSubitem.inc.php';
include_once '../rfq/app/RepositorioProviderSubitem.inc.php';
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

include_once 'app/ShipTo.inc.php';
include_once 'app/ShipToRepository.inc.php';

include_once 'app/AccountingItemPrice.inc.php';
include_once 'app/AccountingItemPriceRepository.inc.php';
include_once 'app/AccountingSubitemPrice.inc.php';
include_once 'app/AccountingSubitemPriceRepository.inc.php';

include_once 'app/ExtraCost.inc.php';
include_once 'app/ExtraCostRepository.inc.php';

include_once '../rfp/app/Connection.inc.php';

include_once '../rfp/app/UserRepository.inc.php';

include_once 'app/FulfillmentProject.inc.php';
include_once 'app/FulfillmentProjectRepository.inc.php';

include_once 'app/ProjectComment.inc.php';
include_once 'app/ProjectCommentRepository.inc.php';

include_once '../rfp/app/Project.inc.php';
include_once '../rfp/app/ProjectRepository.inc.php';

include_once '../rfp/app/Service.inc.php';
include_once '../rfp/app/ServiceRepository.inc.php';

include_once '../rfp/app/Staff.inc.php';
include_once '../rfp/app/StaffRepository.inc.php';

include_once '../rfp/app/Cost.inc.php';
include_once '../rfp/app/CostRepository.inc.php';

include_once 'app/ProjectDocument.inc.php';
include_once 'app/ProjectDocumentRepository.inc.php';

include_once 'app/RealProjectExtracost.inc.php';
include_once 'app/RealProjectExtracostRepository.inc.php';

include_once 'app/Member.inc.php';
include_once 'app/MemberRepository.inc.php';

include_once 'app/ProjectDate.inc.php';
include_once 'app/ProjectDateRepository.inc.php';

include_once 'app/AccountingServicePrice.inc.php';
include_once 'app/AccountingServicePriceRepository.inc.php';

include_once 'app/ExtraService.inc.php';
include_once 'app/ExtraServiceRepository.inc.php';

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
      case 'save_edit_taxes':
        $chosen_route = 'scripts/save_edit_taxes.php';
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
      case 'save_edit_work_order_item_detail':
        $chosen_route = 'scripts/save_edit_work_order_item_detail.php';
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
        $chosen_route = 'scripts/enable_user.php';
        break;
      case 'generate_excel_report':
        $chosen_route = 'scripts/generate_excel_report.php';
        break;
      case 'generate_excel_report_rfp':
        $chosen_route = 'scripts/generate_excel_report_rfp.php';
        break;
      case 'generate_excel_report_rfq_rfp':
        $chosen_route = 'scripts/generate_excel_report_rfq_rfp.php';
        break;
      case 'generate_excel_report_services_equipment':
        $chosen_route = 'scripts/generate_excel_report_services_equipment.php';
        break;
      case 'save_accounting_quote':
        $chosen_route = 'scripts/save_accounting_quote.php';
        break;
      case 'save_new_accounting_item_price':
        $chosen_route = 'scripts/save_new_accounting_item_price.php';
        break;
      case 'save_new_accounting_subitem_price':
        $chosen_route = 'scripts/save_new_accounting_subitem_price.php';
        break;
      case 'save_edit_accounting_item_price':
        $chosen_route = 'scripts/save_edit_accounting_item_price.php';
        break;
      case 'remove_accounting_item_price':
        $chosen_route = 'scripts/remove_accounting_item_price.php';
        break;
      case 'save_edit_accounting_subitem_price':
        $chosen_route = 'scripts/save_edit_accounting_subitem_price.php';
        break;
      case 'remove_accounting_subitem_price':
        $chosen_route = 'scripts/remove_accounting_subitem_price.php';
        break;
      case 'set_accounting_completed':
        $chosen_route = 'scripts/set_accounting_completed.php';
        break;
      case 'save_new_extra_cost':
        $chosen_route = 'scripts/save_new_extra_cost.php';
        break;
      case 'save_edit_extra_cost':
        $chosen_route = 'scripts/save_edit_extra_cost.php';
        break;
      case 'remove_extra_cost':
        $chosen_route = 'scripts/remove_extra_cost.php';
        break;
      case 'save_new_project_comment':
        $chosen_route = 'scripts/save_new_project_comment.php';
        break;
      case 'save_new_project_document':
        $chosen_route = 'scripts/save_new_project_document.php';
        break;
      case 'save_edit_real_project_cost':
        $chosen_route = 'scripts/save_edit_real_project_cost.php';
        break;
      case 'save_new_member':
        $chosen_route = 'scripts/save_new_member.php';
        break;
      case 'save_edit_member':
        $chosen_route = 'scripts/save_edit_member.php';
        break;
      case 'remove_member':
        $chosen_route = 'scripts/remove_member.php';
        break;
      case 'save_new_project_date':
        $chosen_route = 'scripts/save_new_project_date.php';
        break;
      case 'remove_project_date':
        $chosen_route = 'scripts/remove_project_date.php';
        break;
      case 'load_all_project_dates':
        $chosen_route = 'scripts/load_all_project_dates.php';
        break;
      case 'save_accounting_project':
        $chosen_route = 'scripts/save_accounting_project.php';
        break;
      case 'save_new_accounting_service_price':
        $chosen_route = 'scripts/save_new_accounting_service_price.php';
        break;
      case 'save_edit_accounting_service_price':
        $chosen_route = 'scripts/save_edit_accounting_service_price.php';
        break;
      case 'remove_accounting_service_price':
        $chosen_route = 'scripts/remove_accounting_service_price.php';
        break;
      case 'save_new_extra_service':
        $chosen_route = 'scripts/save_new_extra_service.php';
        break;
      case 'save_edit_extra_service':
        $chosen_route = 'scripts/save_edit_extra_service.php';
        break;
      case 'remove_extra_service':
        $chosen_route = 'scripts/remove_extra_service.php';
        break;
      case 'set_accounting_project_completed':
        $chosen_route = 'scripts/set_accounting_project_completed.php';
        break;
      case 'save_edit_tracking':
        $chosen_route = 'scripts/save_edit_tracking.php';
        break;
      case 'save_edit_tracking_subitem':
        $chosen_route = 'scripts/save_edit_tracking_subitem.php';
        break;
      case 'load_graphic_report_rfq':
        $chosen_route = 'scripts/load_graphic_report_rfq.php';
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
          case 'accounting_completed':
            $current_manager = 'accounting_completed';
            break;
          case 'sign_in':
            $current_manager = 'sign_in';
            break;
          case 'edit_user':
            $current_manager = 'edit_user';
            break;
          case 'employee_docs_page':
            $current_manager = 'employee_docs_page';
            break;
          case 'excel_reports':
            $current_manager = 'excel_reports';
            break;
          case 'received_projects':
            $current_manager = 'received_projects';
            break;
          case 'accounting_completed_projects':
            $current_manager = 'accounting_completed_projects';
            break;
          case 'graphic_reports':
            $current_manager = 'graphic_reports';
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
      case 'quote_pdf_items_table':
        $id_rfq = $parts_route[2];
        $chosen_route = 'scripts/quote_pdf_items_table.php';
        break;
      case 're_quote_pdf_items_table':
        $id_rfq = $parts_route[2];
        $chosen_route = 'scripts/re_quote_pdf_items_table.php';
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
      case 'load_taxes':
        $id_purchase_order = $parts_route[2];
        $chosen_route = 'scripts/load_taxes.php';
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
      case 'load_work_order_item_detail':
        $id_work_order_item_detail = $parts_route[2];
        $chosen_route = 'scripts/load_work_order_item_detail.php';
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
      case 'load_accounting_quote_table':
        $id_rfq = $parts_route[2];
        $chosen_route = 'scripts/load_accounting_quote_table.php';
        break;
      case 'load_accounting_item_price':
        $id_accounting_item_price = $parts_route[2];
        $chosen_route = 'scripts/load_accounting_item_price.php';
        break;
      case 'load_accounting_subitem_price':
        $id_accounting_subitem_price = $parts_route[2];
        $chosen_route = 'scripts/load_accounting_subitem_price.php';
        break;
      case 'load_extra_cost':
        $id_extra_cost = $parts_route[2];
        $chosen_route = 'scripts/load_extra_cost.php';
        break;
      case 'load_project_comments':
        $id_fulfillment_project = $parts_route[2];
        $chosen_route = 'scripts/load_project_comments.php';
        break;
      case 'load_project_comments_modal':
        $id_fulfillment_project = $parts_route[2];
        $chosen_route = 'scripts/load_project_comments_modal.php';
        break;
      case 'load_project_documents':
        $id_fulfillment_project = $parts_route[2];
        $chosen_route = 'scripts/load_project_documents.php';
        break;
      case 'load_real_project_costs':
        $id_fulfillment_project = $parts_route[2];
        $chosen_route = 'scripts/load_real_project_costs.php';
        break;
      case 'load_real_project_cost':
        $id_real_project_cost = $parts_route[2];
        $chosen_route = 'scripts/load_real_project_cost.php';
        break;
      case 'load_total_difference':
        $id_fulfillment_project = $parts_route[2];
        $chosen_route = 'scripts/load_total_difference.php';
        break;
      case 'load_members':
        $id_fulfillment_project = $parts_route[2];
        $chosen_route = 'scripts/load_members.php';
        break;
      case 'load_member':
        $id_member = $parts_route[2];
        $chosen_route = 'scripts/load_member.php';
        break;
      case 'load_project_dates':
        $id_fulfillment_project = $parts_route[2];
        $chosen_route = 'scripts/load_project_dates.php';
        break;
      case 'load_project_date':
        $id_project_date = $parts_route[2];
        $chosen_route = 'scripts/load_project_date.php';
        break;
      case 'load_accounting_project_table':
        $id_fulfillment_project = $parts_route[2];
        $chosen_route = 'scripts/load_accounting_project_table.php';
        break;
      case 'load_accounting_service_price':
        $id_accounting_service_price = $parts_route[2];
        $chosen_route = 'scripts/load_accounting_service_price.php';
        break;
      case 'load_extra_service':
        $id_extra_service = $parts_route[2];
        $chosen_route = 'scripts/load_extra_service.php';
        break;
      case 'load_tracking':
        $id_tracking = $parts_route[2];
        $chosen_route = 'scripts/load_tracking.php';
        break;
      case 'load_tracking_box':
        $id_rfq = $parts_route[2];
        $chosen_route = 'scripts/load_tracking_box.php';
        break;
      case 'load_tracking_subitem':
        $id_tracking_subitem = $parts_route[2];
        $chosen_route = 'scripts/load_tracking_subitem.php';
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
          case 'edit_accounting_quote':
            $current_manager = 'edit_accounting_quote';
            $id_rfq = $parts_route[3];
            break;
          case 'edit_project':
            $current_manager = 'edit_project';
            $id_project = $parts_route[3];
            break;
          case 'edit_accounting_project':
            $current_manager = 'edit_accounting_project';
            $id_project = $parts_route[3];
            break;
          case 'service':
            $current_manager = 'service';
            $id_service = $parts_route[3];
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
