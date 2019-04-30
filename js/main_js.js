$(document).ready(function(){
  $('.rfq_team_table, .rfp_team_table').DataTable({
    'pageLength': 100,
    'ordering': false
  });
  /**/
  $('#generate_graphic_report_rfq').click(function(){
    $('#graphic_report_rfq').load('http://' + document.location.hostname + '/fullfillment/load_graphic_report_rfq/',{'date_from': $('#date_from').val(), 'date_to': $('#date_to').val()}, function(){
      if($('#rfq_pie_report').length != 0){
        var users_array = jQuery.parseJSON($('#users_array').val());
        var received_array = jQuery.parseJSON($('#received_array').val());
        var colors = jQuery.parseJSON($('#colors').val());
        console.log(users_array);
        var rfq_pie_report_box = $('#rfq_pie_report');
        var rfq_pie_report = new Chart(rfq_pie_report_box, {
          type: 'pie',
          data:
          {
            labels: users_array,
            datasets:
            [{
              backgroundColor: colors,
              data: received_array
            }]
          }
        });
      }
    });
  });
  /***********************************edit tracking*******************************/
  $('#tracking_box').on('click', '.edit_tracking_subitem', function(){
    $('#edit_tracking_subitem_modal form').load('http://' + document.location.hostname + '/fullfillment/load_tracking_subitem/' + $(this).attr('data'), function(){
      $('.date').daterangepicker({
        singleDatePicker: true
      });
      $('#edit_tracking_subitem_modal').modal();
    });
    return false;
  });

  $('#edit_tracking_subitem_form').submit(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_edit_tracking_subitem', $(this).serialize(), function(res){
      $('#edit_tracking_subitem_modal').modal('hide');
      $('#tracking_box').load('http://' + document.location.hostname + '/fullfillment/load_tracking_box/' + res.id_rfq);
    });
    return false;
  });
  /***********************************edit tracking*******************************/
  $('#tracking_box').on('click', '.edit_tracking', function(){
    $('#edit_tracking_modal form').load('http://' + document.location.hostname + '/fullfillment/load_tracking/' + $(this).attr('data'), function(){
      $('.date').daterangepicker({
        singleDatePicker: true
      });
      $('#edit_tracking_modal').modal();
    });
    return false;
  });

  $('#edit_tracking_form').submit(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_edit_tracking', $(this).serialize(), function(res){
      $('#edit_tracking_modal').modal('hide');
      $('#tracking_box').load('http://' + document.location.hostname + '/fullfillment/load_tracking_box/' + res.id_rfq);
    });
    return false;
  });
  /************************************set accounting completed for projects**************************************/
  $('#accounting_project_completed').click(function(){
    if($(this).prop('checked')){
      $.ajax({
        url: 'http://' + document.location.hostname + '/fullfillment/set_accounting_project_completed/',
        type: 'POST',
        data: {
          id_fulfillment_project: $(this).val()
        },
        success: function(res){
          $('.accounting_project_completed').hide();
        }
      });
    }
  });
  /***********************************edit  extra service*******************************/
  $('#accounting_project_table').on('click', '.edit_extra_service_button', function(){
    $('#edit_extra_service_modal form').load('http://' + document.location.hostname + '/fullfillment/load_extra_service/' + $(this).attr('data'), function(){
      $('#edit_extra_service_modal').modal();
    });
    return false;
  });

  $('#edit_extra_service_form').submit(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_edit_extra_service', $(this).serialize(), function(res){
      $('#edit_extra_service_modal').modal('hide');
      $('#accounting_project_table').load('http://' + document.location.hostname + '/fullfillment/load_accounting_project_table/' + res.id_fulfillment_project);
    });
    return false;
  });
  //remove extra cost
  $('#edit_extra_service_form').on('click', '.remove_extra_service_button', function(){
    $.ajax({
      url: 'http://' + document.location.hostname + '/fullfillment/remove_extra_service/',
      data: {
        id_extra_service: $(this).attr('data')
      },
      type: 'POST',
      success: function(res){
        console.log(res);
        $('#edit_extra_service_modal').modal('hide');
        $('#accounting_project_table').load('http://' + document.location.hostname + '/fullfillment/load_accounting_project_table/' + $('#accounting_project_form input[name="id_fulfillment_project"]').val());
      }
    });
  });
  /******************************************save_extra_service**************************/
  $('#accounting_project_table').on('click', '.new_extra_service_button', function(){
    $('#new_extra_service_modal').modal();
  });

  $('#new_extra_service_form').submit(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_new_extra_service', $(this).serialize(), function(res){
      $('#new_extra_service_form')[0].reset();
      $('#new_extra_service_modal').modal('hide');
      console.log(res);
      $('#accounting_project_table').load('http://' + document.location.hostname + '/fullfillment/load_accounting_project_table/' + res.id_fulfillment_project);
    });
    return false;
  });
  /*********************************edit accounting item price****************************************/
  $('#accounting_project_table').on('click', '.edit_accounting_service_price_button', function(){
    $('#edit_accounting_service_price_modal form').load('http://' + document.location.hostname + '/fullfillment/load_accounting_service_price/' + $(this).attr('data'), function(){
      $('#edit_accounting_service_price_modal').modal();
    });
    return false;
  });

  $('#edit_accounting_service_price_form').submit(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_edit_accounting_service_price', $(this).serialize(), function(res){
      $('#edit_accounting_service_price_modal').modal('hide');
      $('#accounting_project_table').load('http://' + document.location.hostname + '/fullfillment/load_accounting_project_table/' + res.id_fulfillment_project);
    });
    return false;
  });
  //remove accounting item price
  $('#edit_accounting_service_price_form').on('click', '.remove_accounting_service_price_button', function(){
    $.ajax({
      url: 'http://' + document.location.hostname + '/fullfillment/remove_accounting_service_price/',
      data: {
        id_accounting_service_price: $(this).attr('data')
      },
      type: 'POST',
      success: function(res){
        $('#edit_accounting_service_price_modal').modal('hide');
        $('#accounting_project_table').load('http://' + document.location.hostname + '/fullfillment/load_accounting_project_table/' + $('#accounting_project_form input[name="id_fulfillment_project"]').val());
      }
    });
  });
  /******************************************save_accounting_item_price**************************/
  $('#accounting_project_table').on('click', '.new_accounting_service_price_button', function(){
    $('#new_accounting_service_price_form input[name="id_service"]').val($(this).attr('name'));
    $('#new_accounting_service_price_modal').modal();
  });

  $('#new_accounting_service_price_form').submit(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_new_accounting_service_price', $(this).serialize(), function(res){
      $('#new_accounting_service_price_form')[0].reset();
      $('#new_accounting_service_price_modal').modal('hide');
      console.log(res);
      $('#accounting_project_table').load('http://' + document.location.hostname + '/fullfillment/load_accounting_project_table/' + res.id_fulfillment_project);
    });
    return false;
  });
  /******************************************SAVE ACCOUNTING project PART************************/
  $('#accounting_project_form').submit(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_accounting_project/', $(this).serialize(), function(res){
      console.log('asdsadsada');
    });
    return false;
  });
  /****************************project dates********************/
  $('#project_dates_button').click(function(){
    $('#project_dates_modal').modal();
  });
  /*****************************calendar***************************/
  $('#calendar').fullCalendar({
    themeSystem: 'bootstrap4',
    dayClick: function(date, jsEvent, view){
      $('#new_project_date_form input[name="date"]').val(date.format('MM/DD/YYYY'));
      $('#new_project_date_modal').modal();
    },
    events: 'http://' + document.location.hostname + '/fullfillment/load_project_dates/' + $('#id_fulfillment_project').val(),
    eventClick: function(info){
      $('#project_date_modal .contenido').load('http://' + document.location.hostname + '/fullfillment/load_project_date/' + info.id);
      $('#project_date_modal').modal();
    }
  });

  $('#project_date_modal').on('click', '.remove_project_date', function(){
    $.ajax({
      type: 'POST',
      url: 'http://' + document.location.hostname + '/fullfillment/remove_project_date/',
      data: {
        id_project_date: $(this).attr('data')
      },
      success: function(res){
        $('#project_date_modal').modal('hide');
        $('#calendar').fullCalendar('refetchEvents');
        $('#project_dates_modal .modal-body').load('http://' + document.location.hostname + '/fullfillment/load_all_project_dates/');
      }
    });
  });

  $('#new_project_date_form').submit(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_new_project_date/', $(this).serialize(), function(res){
      $('#new_project_date_form')[0].reset();
      $('#new_project_date_modal').modal('hide');
      $('#calendar').fullCalendar('refetchEvents');
      $('#project_dates_modal .modal-body').load('http://' + document.location.hostname + '/fullfillment/load_all_project_dates/');
    });
    return false;
  });
  /***********************************members***********************/
  $('#new_member_button').click(function(){
    $('#new_member_modal').modal();
  });

  $('#new_member_form').submit(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_new_member/', $(this).serialize(), function(res){
      $('#new_member_form')[0].reset();
      $('#new_member_modal').modal('hide');
      $('#members').load('http://' + document.location.hostname + '/fullfillment/load_members/' + $('#id_fulfillment_project').val());
    });
    return false;
  });

  $('#members').on('click', '.edit_member_button', function(){
    $('#edit_member_modal form').load('http://' + document.location.hostname + '/fullfillment/load_member/' + $(this).attr('data'));
    $('#edit_member_modal').modal();
    return false;
  });

  $('#edit_member_form').submit(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_edit_member/', $(this).serialize(), function(res){
      $('#edit_member_modal').modal('hide');
      $('#members').load('http://' + document.location.hostname + '/fullfillment/load_members/' + $('#id_fulfillment_project').val());
    });
    return false;
  });

  $('#edit_member_form').on('click', '.remove_member_button', function(){
    $.ajax({
      type: 'POST',
      url: 'http://' + document.location.hostname + '/fullfillment/remove_member/',
      data: {
        id_member: $(this).attr('data')
      },
      success: function(res){
        $('#edit_member_modal').modal('hide');
        $('#members').load('http://' + document.location.hostname + '/fullfillment/load_members/' + $('#id_fulfillment_project').val());
      }
    });
  });
  /***********************************real cost project***********************/
  $('#real_project_costs').on('click', '.edit_real_project_cost_button', function(){
    $('#edit_real_project_cost_modal form').load('http://' + document.location.hostname + '/fullfillment/load_real_project_cost/' + $(this).attr('data'));
    $('#edit_real_project_cost_modal').modal();
    return false;
  });

  $('#edit_real_project_cost_form').submit(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_edit_real_project_cost/', $(this).serialize(), function(res){
      $('#edit_real_project_cost_modal').modal('hide');
      $('#real_project_costs').load('http://' + document.location.hostname + '/fullfillment/load_real_project_costs/' + $('#id_fulfillment_project').val(), function(){
        $('#total_difference').load('http://' + document.location.hostname + '/fullfillment/load_total_difference/' + $('#id_fulfillment_project').val(), {'total': $('#total_project').attr('data'), 'real_total': $('#total_real_project').attr('data')});
      });
    });
    return false;
  });
  /*************************************inputfile fulfillment rfp*************/
  $('#new_document_button').click(function(){
    $('#new_document_modal').modal();
  });

  $('#new_document_form').submit(function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: 'http://' + document.location.hostname + '/fullfillment/save_new_project_document/',
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,
      success: function(res){
        $('#new_document_form')[0].reset();
        $('#new_document_modal').modal('hide');
        $('.project_documents').load('http://' + document.location.hostname + '/fullfillment/load_project_documents/' + $('#id_fulfillment_project').val());
      }
    });
    return false;
  });

  $('#customFile').change(function(e){
    var files = e.target.files;
    var filename = [];
    $.each(files, function(index, value) {
      filename.push(value.name);
    });
    $('#filenames').html(filename.join());
  });
  /************************************comments*******************************/
  $('#new_project_comment_button').click(function(){
    $('#new_project_comment_modal').modal();
  });

  $('#new_project_comment_form').submit(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_new_project_comment/', $(this).serialize(), function(res){
      $('#new_project_comment_form')[0].reset();
      $('#new_project_comment_modal').modal('hide');
      $('#all_project_comments_modal .modal-body').load('http://' + document.location.hostname + '/fullfillment/load_project_comments_modal/' + res.id_fulfillment_project);
      $('#project_comments').load('http://' + document.location.hostname + '/fullfillment/load_project_comments/' + res.id_fulfillment_project);
    });
    return false;
  });

  $('#project_comments').on('click', '#show_project_comments_button', function(){
    $('#all_project_comments_modal').modal();
  });
  /************************************set accounting completed**************************************/
  $('#accounting_completed').click(function(){
    if($(this).prop('checked')){
      $.ajax({
        url: 'http://' + document.location.hostname + '/fullfillment/set_accounting_completed/',
        type: 'POST',
        data: {
          id_rfq: $(this).val()
        },
        success: function(res){
          $('.accounting_completed').hide();
        }
      });
    }
  });
  /***********************************edit  extra cost*******************************/
  $('#accounting_quote_table').on('click', '.edit_extra_cost_button', function(){
    $('#edit_extra_cost_modal form').load('http://' + document.location.hostname + '/fullfillment/load_extra_cost/' + $(this).attr('data'), function(){
      $('#edit_extra_cost_modal').modal();
    });
    return false;
  });

  $('#edit_extra_cost_form').submit(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_edit_extra_cost', $(this).serialize(), function(res){
      $('#edit_extra_cost_modal').modal('hide');
      console.log(res);
      $('#accounting_quote_table').load('http://' + document.location.hostname + '/fullfillment/load_accounting_quote_table/' + res.id_rfq);
    });
    return false;
  });
  //remove extra cost
  $('#edit_extra_cost_form').on('click', '.remove_extra_cost_button', function(){
    $.ajax({
      url: 'http://' + document.location.hostname + '/fullfillment/remove_extra_cost/',
      data: {
        id_extra_cost: $(this).attr('data')
      },
      type: 'POST',
      success: function(res){
        console.log(res);
        $('#edit_extra_cost_modal').modal('hide');
        $('#accounting_quote_table').load('http://' + document.location.hostname + '/fullfillment/load_accounting_quote_table/' + $('#accounting_quote_form input[name="id_rfq"]').val());
      }
    });
  });
  /******************************************save_extra_cost**************************/
  $('#accounting_quote_table').on('click', '.new_extra_cost_button', function(){
    $('#new_extra_cost_modal').modal();
  });

  $('#new_extra_cost_form').submit(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_new_extra_cost', $(this).serialize(), function(res){
      $('#new_extra_cost_form')[0].reset();
      $('#new_extra_cost_modal').modal('hide');
      console.log(res);
      $('#accounting_quote_table').load('http://' + document.location.hostname + '/fullfillment/load_accounting_quote_table/' + res.id_rfq);
    });
    return false;
  });
  /*********************************edit accounting subitem price****************************************/
  $('#accounting_quote_table').on('click', '.edit_accounting_subitem_price_button', function(){
    $('#edit_accounting_subitem_price_modal form').load('http://' + document.location.hostname + '/fullfillment/load_accounting_subitem_price/' + $(this).attr('data'), function(){
      $('#edit_accounting_subitem_price_modal').modal();
    });
    return false;
  });

  $('#edit_accounting_subitem_price_form').submit(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_edit_accounting_subitem_price', $(this).serialize(), function(res){
      $('#edit_accounting_subitem_price_modal').modal('hide');
      console.log(res);
      $('#accounting_quote_table').load('http://' + document.location.hostname + '/fullfillment/load_accounting_quote_table/' + res.id_rfq);
    });
    return false;
  });
  //remove accounting subitem price
  $('#edit_accounting_subitem_price_form').on('click', '.remove_accounting_subitem_price_button', function(){
    $.ajax({
      url: 'http://' + document.location.hostname + '/fullfillment/remove_accounting_subitem_price/',
      data: {
        id_accounting_subitem_price: $(this).attr('data')
      },
      type: 'POST',
      success: function(res){
        console.log(res);
        $('#edit_accounting_subitem_price_modal').modal('hide');
        $('#accounting_quote_table').load('http://' + document.location.hostname + '/fullfillment/load_accounting_quote_table/' + $('#accounting_quote_form input[name="id_rfq"]').val());
      }
    });
  });
  /*********************************edit accounting item price****************************************/
  $('#accounting_quote_table').on('click', '.edit_accounting_item_price_button', function(){
    $('#edit_accounting_item_price_modal form').load('http://' + document.location.hostname + '/fullfillment/load_accounting_item_price/' + $(this).attr('data'), function(){
      $('#edit_accounting_item_price_modal').modal();
    });
    return false;
  });

  $('#edit_accounting_item_price_form').submit(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_edit_accounting_item_price', $(this).serialize(), function(res){
      $('#edit_accounting_item_price_modal').modal('hide');
      console.log(res);
      $('#accounting_quote_table').load('http://' + document.location.hostname + '/fullfillment/load_accounting_quote_table/' + res.id_rfq);
    });
    return false;
  });
  //remove accounting item price
  $('#edit_accounting_item_price_form').on('click', '.remove_accounting_item_price_button', function(){
    $.ajax({
      url: 'http://' + document.location.hostname + '/fullfillment/remove_accounting_item_price/',
      data: {
        id_accounting_item_price: $(this).attr('data')
      },
      type: 'POST',
      success: function(res){
        console.log(res);
        $('#edit_accounting_item_price_modal').modal('hide');
        $('#accounting_quote_table').load('http://' + document.location.hostname + '/fullfillment/load_accounting_quote_table/' + $('#accounting_quote_form input[name="id_rfq"]').val());
      }
    });
  });
  /******************************************save_accounting_item_price**************************/
  $('#accounting_quote_table').on('click', '.new_accounting_item_price_button', function(){
    $('#new_accounting_item_price_form input[name="id_item"]').val($(this).attr('name'));
    $('#new_accounting_item_price_modal').modal();
  });

  $('#new_accounting_item_price_form').submit(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_new_accounting_item_price', $(this).serialize(), function(res){
      $('#new_accounting_item_price_form')[0].reset();
      $('#new_accounting_item_price_modal').modal('hide');
      console.log(res);
      $('#accounting_quote_table').load('http://' + document.location.hostname + '/fullfillment/load_accounting_quote_table/' + res.id_rfq);
    });
    return false;
  });
  /******************************************save_accounting_subitem_price**************************/
  $('#accounting_quote_table').on('click', '.new_accounting_subitem_price_button', function(){
    $('#new_accounting_subitem_price_form input[name="id_subitem"]').val($(this).attr('name'));
    $('#new_accounting_subitem_price_modal').modal();
  });

  $('#new_accounting_subitem_price_form').submit(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_new_accounting_subitem_price', $(this).serialize(), function(res){
      $('#new_accounting_subitem_price_form')[0].reset();
      $('#new_accounting_subitem_price_modal').modal('hide');
      console.log(res);
      $('#accounting_quote_table').load('http://' + document.location.hostname + '/fullfillment/load_accounting_quote_table/' + res.id_rfq);
    });
    return false;
  });
  /******************************************SAVE ACCOUNTING QUOTE PART************************/
  $('#accounting_quote_form').submit(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_accounting_quote/', $(this).serialize(), function(res){
      console.log('asdsadsada');
    });
    return false;
  });
  /*********************************************FINAL QUOTE MANAGEMENT*************************/
  $('#final_quote').hide();
  $('#final_re_quote').hide();

  $('#final_quote_toggle').click(function(){
    $('#final_quote').toggle('fade');
  });
  $('#final_re_quote_toggle').click(function(){
    $('#final_re_quote').toggle('fade');
  });
  /***************************SAVE EDIT USER******************************************************/
  $('#edit_user_form #save_edit_user').click(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_edit_user/', $('#edit_user_form').serialize(), function(res){
      console.log(res);
    });
  });
  /**************************DISABLE USER*********************************************************/
  $('#users').on('click', '.disable_user', function(){
    var user_id = $(this).attr('name');
    $.ajax({
      url: 'http://' + document.location.hostname + '/fullfillment/disable_user/',
      data: {
        id_user: user_id
      },
      type: 'POST',
      success: function(res){
        console.log(res);
        $('#users').load('http://' + document.location.hostname + '/fullfillment/load_users/');
      }
    });
  });
  /**************************ENABLE USER*********************************************************/
  $('#users').on('click', '.enable_user', function(){
    var user_id = $(this).attr('name');
    $.ajax({
      url: 'http://' + document.location.hostname + '/fullfillment/enable_user/',
      data: {
        id_user: user_id
      },
      type: 'POST',
      success: function(res){
        console.log(res);
        $('#users').load('http://' + document.location.hostname + '/fullfillment/load_users/');
      }
    });
  });
  /*************************REMOVE PACKING SLIP SUBITEM*****************************************/
  $('#packing_slip_items').on('click', '.remove_packing_slip_subitem', function(){
    $.ajax({
      url: 'http://' + document.location.hostname + '/fullfillment/remove_packing_slip_subitem/',
      data: {
        id_subitem: $(this).attr('name')
      },
      type: 'POST',
      success: function(res){
        console.log(res);
        $('#packing_slip_items').load('http://' + document.location.hostname + '/fullfillment/load_packing_slip_items/' + res.id_rfq);
      }
    });
  });
  /*************************REMOVE PACKING SLIP ITEM*****************************************/
  $('#packing_slip_items').on('click', '.remove_packing_slip_item', function(){
    $.ajax({
      url: 'http://' + document.location.hostname + '/fullfillment/remove_packing_slip_item/',
      data: {
        id_item: $(this).attr('name')
      },
      type: 'POST',
      success: function(res){
        console.log(res);
        $('#packing_slip_items').load('http://' + document.location.hostname + '/fullfillment/load_packing_slip_items/' + res.id_rfq);
      }
    });
  });
  /*********************************EDIT PACKING SLIP ITEM****************************************/
  $('#packing_slip_items').on('click', '.edit_packing_slip_subitem', function(){
    $('#edit_packing_slip_subitem_modal .modal-body form').load('http://' + document.location.hostname + '/fullfillment/load_packing_slip_subitem/' + $(this).attr('name'), function(){
      $('#edit_packing_slip_subitem_modal').modal();
    });
  });

  $('#save_edit_packing_slip_subitem').click(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_edit_packing_slip_subitem', $('#edit_packing_slip_subitem_form').serialize(), function(res){
      $('#edit_packing_slip_subitem_modal').modal('hide');
      $('#packing_slip_items').load('http://' + document.location.hostname + '/fullfillment/load_packing_slip_items/' + res.id_rfq);
    });
  });
  /*********************************EDIT PACKING SLIP ITEM****************************************/
  $('#packing_slip_items').on('click', '.edit_packing_slip_item', function(){
    $('#edit_packing_slip_item_modal .modal-body form').load('http://' + document.location.hostname + '/fullfillment/load_packing_slip_item/' + $(this).attr('name'), function(){
      $('#edit_packing_slip_item_modal').modal();
    });
  });

  $('#save_edit_packing_slip_item').click(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_edit_packing_slip_item', $('#edit_packing_slip_item_form').serialize(), function(res){
      $('#edit_packing_slip_item_modal').modal('hide');
      $('#packing_slip_items').load('http://' + document.location.hostname + '/fullfillment/load_packing_slip_items/' + res.id_rfq);
    });
  });
  /*********************************NEW PACKING SLIP SUBITEMS**************************************/
  $('#packing_slip_items').on('click', '.new_packing_slip_subitem', function(){
    $('#new_packing_slip_subitem_form input[name="id_subitem"]').val($(this).attr('name'));
    $('#new_packing_slip_subitem_modal').modal();
  });

  $('#save_new_packing_slip_subitem').click(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_new_packing_slip_subitem', $('#new_packing_slip_subitem_form').serialize(), function(res){
      $('#new_packing_slip_subitem_form')[0].reset();
      $('#new_packing_slip_subitem_modal').modal('hide');
      $('#packing_slip_items').load('http://' + document.location.hostname + '/fullfillment/load_packing_slip_items/' + res.id_rfq);
    });
  });
  /**********************************NEW PACKING SLIP ITEM*************************************/
  $('#packing_slip_items').on('click', '.new_packing_slip_item', function(){
    $('#new_packing_slip_item_form input[name="id_item"]').val($(this).attr('name'));
    $('#new_packing_slip_item_modal').modal();
  });

  $('#save_new_packing_slip_item').click(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_new_packing_slip_item', $('#new_packing_slip_item_form').serialize(), function(res){
      $('#new_packing_slip_item_form')[0].reset();
      $('#new_packing_slip_item_modal').modal('hide');
      $('#packing_slip_items').load('http://' + document.location.hostname + '/fullfillment/load_packing_slip_items/' + res.id_rfq);
    });
  });
  /**********************************SAVE PACKING SLIP****************************************/
  $('#save_packing_slip').click(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_packing_slip', $('#packing_slip_form').serialize(), function(res){
      console.log(res);
    });
  });
  /***********************************OPEN ALL WORK ORDERS MODAL******************************/
  $('#work_orders_button').click(function(){
    console.log('asdsa');
    $('#orders_modal').load('http://' + document.location.hostname + '/fullfillment/load_all_work_orders/' + $(this).attr('name'), function(){
      $('#orders_modal').modal();
    });
  });
  /*************************REMOVE WORK ORDER ITEM*****************************************/
  $('#work_order_items').on('click', '.delete_work_order_item_button', function(){
    console.log($(this).attr('name'));
    $.ajax({
      url: 'http://' + document.location.hostname + '/fullfillment/remove_work_order_item/',
      data: {
        id_work_order_item: $(this).attr('name')
      },
      type: 'POST',
      success: function(res){
        console.log(res);
        $('#work_order_items').load('http://' + document.location.hostname + '/fullfillment/load_work_order_items/' + res.id_work_order);
      }
    });
  });
  /*********************************REMOVE WORK ORDER DETAIL*************************/
  $('#work_order_items').on('click', '.delete_work_order_item_detail_button', function(){
    $.ajax({
      url: 'http://' + document.location.hostname + '/fullfillment/remove_work_order_item_detail/',
      data: {
        id_work_order_item_detail: $(this).attr('name')
      },
      type: 'POST',
      success: function(res){
        console.log(res);
        $('#work_order_items').load('http://' + document.location.hostname + '/fullfillment/load_work_order_items/' + res.id_work_order);
      }
    });
  });
  /*******************************EDIT WORK ORDER DETAIL*********************************************/
  $('#work_order_items').on('click', '.edit_work_order_item_detail_button', function(){
    $('#edit_work_order_item_detail_modal .modal-body form').load('http://' + document.location.hostname + '/fullfillment/load_work_order_item_detail/' + $(this).attr('name'), function(){
      $('#edit_work_order_item_detail_modal').modal();
    });
  });

  $('#save_edit_work_order_item_detail').click(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_edit_work_order_item_detail', $('#edit_work_order_item_detail_form').serialize(), function(res){
      $('#edit_work_order_item_detail_modal').modal('hide');
      $('#work_order_items').load('http://' + document.location.hostname + '/fullfillment/load_work_order_items/' + res.id_work_order);
    });
  });
  /********************************SAVE EDIT WORK ORDER ITEM****************************************/
  $('#work_order_items').on('click', '.edit_work_order_item_button', function(){
    $('#edit_work_order_item_modal .modal-body form').load('http://' + document.location.hostname + '/fullfillment/load_work_order_item/' + $(this).attr('name'), function(){
      $('#edit_work_order_item_modal').modal();
    });
  });

  $('#save_edit_work_order_item').click(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_edit_work_order_item', $('#edit_work_order_item_form').serialize(), function(res){
      console.log(res);
      $('#edit_work_order_item_modal').modal('hide');
      $('#work_order_items').load('http://' + document.location.hostname + '/fullfillment/load_work_order_items/' + res.id_work_order);
    });
  });
  /*************************************SAVE NEW WORK ORDER ITEM DETAIL ****************************/
  $('#work_order_items').on('click', '.new_work_order_item_detail_button', function(){
    $('#id_work_order_item').val($(this).attr('name'));
    $('#new_work_order_item_detail_modal').modal();
  });

  $('#save_new_work_order_item_detail').click(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_new_work_order_item_detail', $('#new_work_order_item_detail_form').serialize(), function(res){
      $('#new_work_order_item_detail_form')[0].reset();
      $('#new_work_order_item_detail_modal').modal('hide');
      $('#work_order_items').load('http://' + document.location.hostname + '/fullfillment/load_work_order_items/' + res.id_work_order);
    });
  });
  /***********************************SAVE NEW WORK ORDER ITEM*************************************/
  $('#new_work_order_item_button').click(function(){
    $('#new_work_order_item_modal').modal();
  });
  $('#save_new_work_order_item').click(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_new_work_order_item', $('#new_work_order_item_form').serialize(), function(res){
      $('#new_work_order_item_form')[0].reset();
      $('#new_work_order_item_modal').modal('hide');
      $('#work_order_items').load('http://' + document.location.hostname + '/fullfillment/load_work_order_items/' + res.id_work_order);
    });
  });
  /*********************************SAVE WORK ORDER***********************************************/
  $('#save_work_order').click(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_work_order', $('#work_order_form').serialize(), function(res){
      console.log(res);
    });
  });
  /***********************************OPEN ALL PURCHASE ORDERS MODAL******************************/
  $('#purchase_orders_button').click(function(){
    $('#orders_modal').load('http://' + document.location.hostname + '/fullfillment/load_all_purchase_orders/' + $(this).attr('name'), function(){
      $('#orders_modal').modal();
    });
  });
  /************************************DATE IN PURCHASE WORK ORDERS AND PACKING SLIP*******************************/
  $('#packing_slip_form #order_date').daterangepicker({
    singleDatePicker: true
  });

  $('#work_order_form #date, .date').daterangepicker({
    singleDatePicker: true
  });

  $('#purchase_order_form #date').daterangepicker({
    singleDatePicker: true
  });
  $('#purchase_order_form #order_date').daterangepicker({
    singleDatePicker: true
  });
  /*****************************SAVE PURCHASE ORDER****************************************/
  $('#save_purchase_order').click(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_purchase_order', $('#purchase_order_form').serialize(), function(res){
      console.log(res);
    });
  });
  /****************************EDIT SHIPMENT COST PURCHASE ORDER***********************/
  $('#purchase_order_items').on('click', '#edit_shipment_cost', function(){
    $('#edit_shipment_cost_modal .modal-body form').load('http://' + document.location.hostname + '/fullfillment/load_shipment_cost/' + $('#id_purchase_order', this).val(), function(){
      $('#edit_shipment_cost_modal').modal();
    });
  });

  $('#save_edit_shipment_cost').click(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_edit_shipment_cost', $('#edit_shipment_cost_form').serialize(), function(res){
      if(res){
        $('#edit_shipment_cost_modal').modal('hide');
        $('#purchase_order_items').load('http://' + document.location.hostname + '/fullfillment/load_purchase_order_items/' + res.id_purchase_order);
      }
    });
  });
  /*********************************REMOVE PURCHASE ORDER ITEM*************************/
  $('#purchase_order_items').on('click', '.remove_purchase_order_item', function(){
    $.ajax({
      url: 'http://' + document.location.hostname + '/fullfillment/remove_purchase_order_item/',
      data: {
        id_purchase_order_item: $('.id_purchase_order_item', this).val()
      },
      type: 'POST',
      success: function(res){
        $('#purchase_order_items').load('http://' + document.location.hostname + '/fullfillment/load_purchase_order_items/' + res.id_purchase_order);
      }
    });
  });
  /***********************************SAVE EDIT PURCHASE ORDER ITEM**********************/
  $('#purchase_order_items').on('click', '.edit_purchase_order_item', function(){
    $('#edit_purchase_order_item_modal .modal-body form').load('http://' + document.location.hostname + '/fullfillment/load_purchase_order_item/' + $('.id_purchase_order_item', this).val(), function(){
      $('#edit_purchase_order_item_modal').modal();
    });
    return false;
  });
  $('#save_edit_purchase_order_item').click(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_edit_purchase_order_item', $('#edit_purchase_order_item_form').serialize(), function(res){
      if(res){
        $('#edit_purchase_order_item_modal').modal('hide');
        $('#purchase_order_items').load('http://' + document.location.hostname + '/fullfillment/load_purchase_order_items/' + res.id_purchase_order);
      }
    });
  });
  /**********************************SAVE PURCHASE ORDER ITEM****************************/
  $('#new_purchase_order_item').click(function(){
    $('#new_purchase_order_item_modal').modal();
  });
  $('#save_new_purchase_order_item').click(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_new_purchase_order_item', $('#new_purchase_order_item_form').serialize(), function(res){
      $('#new_purchase_order_item_form')[0].reset();
      $('#new_purchase_order_item_modal').modal('hide');
      $('#purchase_order_items').load('http://' + document.location.hostname + '/fullfillment/load_purchase_order_items/' + res.id_purchase_order);
    });
  });
  /**************************************INPUT FILE rfp*************************************/
  if($('#file_input_rfp').length != 0){
    var files = $('#files').val();
    var array_div_files = [];
    var array_options = [];
    if(files != ''){
      files = files.split(',');
      for (var i = 0; i < files.length; i++) {
        array_div_files.push('"<h3>' + "<i class='" + "fas fa-file" + "'></i>" + '</h3>"');
        array_options.push('{"previewAsData": false, "caption": "' + files[i] + '", "downloadUrl": "' + 'http://' + document.location.hostname + '/fullfillment/documents/rfp_team/' + $('input[name="id_project"]').val() + '/' + files[i] + '", "key": ' + i + '}');
      }
      array_div_files.join(',');
      array_div_files = '[' + array_div_files + ']';
      array_div_files = jQuery.parseJSON(array_div_files);
      array_options.join(',');
      array_options = '[' + array_options + ']';
      array_options = jQuery.parseJSON(array_options);
    }
    $('#file_input_rfp').fileinput({
      theme: 'explorer-fas',
      overwriteInitial: false,
      showBrowse: false,
      initialPreviewAsData: true,
      showClose: false,
      initialPreview: array_div_files,
      initialPreviewConfig: array_options,
      fileActionSettings:
      {
        showZoom: false,
        showRemove: false
      }
    });
  }
  /**************************************INPUT FILE rfq*************************************/
  if($('#file_input').length != 0){
    var files = $('#files').val();
    var array_div_files = [];
    var array_options = [];
    if(files != ''){
      files = files.split(',');
      console.log(files);
      for (var i = 0; i < files.length; i++) {
        array_div_files.push('"<h3>' + "<i class='" + "fas fa-file" + "'></i>" + '</h3>"');
        array_options.push('{"previewAsData": false, "caption": "' + files[i] + '", "url": "' + 'http://' + document.location.hostname + '/fullfillment/delete_document/' + $('input[name="id_rfq"]').val() + '/' + files[i] + '", "downloadUrl": "' + 'http://' + document.location.hostname + '/fullfillment/documents/rfq_team/' + $('input[name="id_rfq"]').val() + '/' + files[i] + '", "key": ' + i + '}');
      }
      array_div_files.join(',');
      array_div_files = '[' + array_div_files + ']';
      array_div_files = jQuery.parseJSON(array_div_files);
      array_options.join(',');
      array_options = '[' + array_options + ']';
      array_options = jQuery.parseJSON(array_options);
    }
    $('#file_input').fileinput({
      theme: 'explorer-fas',
      uploadUrl: 'http://' + document.location.hostname + '/fullfillment/load_img/' + $('input[name="id_rfq"]').val(),
      overwriteInitial: false,
      initialPreviewAsData: true,
      showClose: false,
      initialPreview: array_div_files,
      initialPreviewConfig: array_options,
      fileActionSettings:
      {
        showZoom: false
      }
    });
  }
  /********************************CHECKBOXES PAYMENT TERMS ITEM FULLFILLMENT***********************************/
  $('.payment_terms_item').click(function(){
    var id_item = $(this).attr('href');
    console.log('http://' + document.location.hostname + '/fullfillment/load_payment_terms_item/' + id_item);
    $('#payment_terms_item_modal .modal-body form').load('http://' + document.location.hostname + '/fullfillment/load_payment_terms_item/' + id_item, function(){
      $('#payment_terms_item_modal').modal();
    });
    return false;
  });
  $('#send_payment_terms_item').click(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_payment_terms_item', $('#payment_terms_item_form').serialize(), function(res){
      if(res){
        $('#payment_terms_item_modal').modal('hide');
      }
    });
  });
  /******************************CHECKBOXES PAYMENT TERMS SUBITEM FULLFILLMENT******************/
  $('.payment_terms_subitem').click(function(){
    var id_subitem = $(this).attr('href');
    $('#payment_terms_subitem_modal .modal-body form').load('http://' + document.location.hostname + '/fullfillment/load_payment_terms_subitem/' + id_subitem, function(){
      $('#payment_terms_subitem_modal').modal();
    });
    return false;
  });
  $('#send_payment_terms_subitem').click(function(){
    $.post('http://' + document.location.hostname + '/fullfillment/save_payment_terms_subitem', $('#payment_terms_subitem_form').serialize(), function(res){
      if(res){
        $('#payment_terms_subitem_modal').modal('hide');
      }
    });
  });
/********************************SUBMIT PAYMENT TERMS FORM******************************/

  /*********************************TRACKING SUBITEM MODAL*******************************/
  $('#tracking_box').on('click', '.add_tracking_subitem_button', function(){
    var id_subitem = $(this).attr('name');
    $('#new_tracking_subitem #id_subitem').val(id_subitem);
    $('#new_tracking_subitem').modal();
  });
  /*********************************TRACKING MODAL*******************************/
  $('#tracking_box').on('click', '.add_tracking_button', function(){
    var id_item = $(this).attr('name');
    $('#new_tracking #id_item').val(id_item);
    $('#new_tracking').modal();
  });
  /**********************************DATEPICKER********************************/
  $('#po_date, .eta').daterangepicker({
    singleDatePicker: true
  });
  $('#delivery_date').daterangepicker({
    singleDatePicker: true
  });
  $('#delivery_date_subitem').daterangepicker({
    singleDatePicker: true
  });
  /*********************************SHOW COMMENTS*******************************/
  $('#quote_comments').click(function(){
    $('#todos_commentarios_quote').modal();
  });
  /********************************INPUT FILE**********************************/
  $('#file_input_info_create').change(function(e){
    var fileName_create = [];
    for (var i = 0; i < e.target.files.length; i++) {
      fileName_create.push(e.target.files[i].name);
    }
    $('#label_file_create').html(fileName_create.join(', '));
  });
  /**********************************************************************************/

  /****************************************************************************/
  /***********************************VARIABLES INICIALES PARA EL BORRADO*********************/
  var link_to_delete;
  var alert_delete_system = $('#alert_delete_system');
  var continue_button = $('#continue_button');
  function habilitar_continue_button(boton){
    alert_delete_system.modal();
    link_to_delete = boton.attr('href');
    continue_button.attr('href', link_to_delete);
  }
  /******************************ALERT EN BOTONES PARA BORRAR DOCUMENTOS********************/
  $('.delete_document_button').click(function(){
    habilitar_continue_button($(this));
    return false;
  });
  /***********************************ALERT EN BOTONES PARA BORRAR ITEMS******************/
  $('.delete_item_button').click(function(){
    habilitar_continue_button($(this));
    return false;
  });
  /**********************************ALERT EN BOTONES PARA BORRAR SUBITEMS******************/
  $('.delete_subitem_button').click(function(){
    habilitar_continue_button($(this));
    return false;
  });
  /******************************ALERT EN BOTONES PARA BORRAR PROVIDER DE ITEMS**************/
  $('.delete_provider_item_button').click(function(){
    habilitar_continue_button($(this));
    return false;
  });
  /******************************ALERT EN BOTONES PARA BORRAR PROVIDER SUBITEMS*************/
  $('.delete_provider_subitem_button').click(function(){
    habilitar_continue_button($(this));
    return false;
  });
  /*************************************NUEVO COMENTARIO***********************************/
  if($('#nuevo_comment').length != 0){
    $('#add_comment').click(function(){
      $('#nuevo_comment').modal();
    });
  }
  /*****************************ITEMS_TABLE*************************************************/
  var monto = [];
  var quantity = [];

  $('#items tr').each(function () {
    quantity.push($(this).find('td').eq(5).text());
    if (!isNaN($(this).find('td').eq(8).text().split(' ')[1])) {
      monto.push($(this).find('td').eq(8).text().split(' ')[1]);
    } else {
      monto.push(0);
    }
  });


  var time = setInterval(function(){
    var total_additional = 0;
    var payment_terms = 0;
    if ($('input:radio[name=payment_terms]:checked').val() === 'Net 30/CC') {
      payment_terms = 1.0215;
    } else {
      payment_terms = 1;
    }
    var taxes = $('#taxes').val();
    var profit = $('#profit').val();
    if(!isNaN($('#additional_general').val()) && $('#additional_general').val() != ''){
      var additional_general = $('#additional_general').val();
    }else{
      var additional_general = 0;
    }

    if(!isNaN($('#shipping_cost').val()) && $('#shipping_cost').val() != ''){
      var shipping_cost = $('#shipping_cost').val();
    }else{
      var shipping_cost = 0;
    }

    if(!isNaN($('#consolidate_others').val()) && $('#consolidate_others').val() != ''){
      var consolidate_others = $('#consolidate_others').val();
    }else{
      var consolidate_others = 0;
    }
    var contador_subitems = 0;
    var i = 0;
    var j = 1;
    var total1 = 0 + parseFloat(consolidate_others);
    var total2 = 0 + parseFloat(shipping_cost);
    var partes_total_price = '';
    var partes_total_price_subitems = '';
    var unit_prices = '';
    var unit_prices_subitems = '';
    var additional = '';
    var additional_subitems = '';
    var total_quantity = 0;
    $('#items tr').each(function () {
      if(!isNaN($(this).find('td').eq(5).text())){
        total_quantity = total_quantity + Number($(this).find('td').eq(5).text());
      }
      if(!isNaN($('#add_cost' + j).val()) && $('#add_cost' + j).val() != ''){
        var add_cost = $('#add_cost' + j).val();
      }else{
        var add_cost = 0;
      }

      total_additional = total_additional + (parseFloat(add_cost)*quantity[i]) + (parseFloat(additional_general)*quantity[i]);

      if($(this).hasClass('fila_subitem')){
        if(contador_subitems === 0){
          additional_subitems = additional_subitems + add_cost;
        }else{
          additional_subitems = additional_subitems + ',' + add_cost;
        }
      }else{
        if (i === 0) {
          additional = additional + add_cost;
        } else {
          additional = additional + ',' + add_cost;
        }
      }

        var resul_taxes = parseFloat(additional_general) + parseFloat(add_cost) + ((1 + (taxes / 100)) * monto[i] * payment_terms);
        resul_taxes = resul_taxes.toFixed(2);
        $(this).find('td').eq(8).html('$ ' + resul_taxes);
        if (profit !== 0) {
          var resul_profit = (1 + (profit / 100)) * resul_taxes;
          resul_profit = resul_profit.toFixed(2);
          $(this).find('td').eq(10).html('$ ' + resul_profit);
          if($(this).hasClass('fila_subitem')){
            if (contador_subitems === 0) {
              unit_prices_subitems = unit_prices_subitems + resul_profit;
            } else {
              unit_prices_subitems = unit_prices_subitems + ',' + resul_profit;
            }

          }else{
            if (i === 0) {
              unit_prices = unit_prices + resul_profit;
            } else {
              unit_prices = unit_prices + ',' + resul_profit;
            }
          }
        } else {
          $(this).find('td').eq(10).html('$ ' + resul_taxes);
          if($(this).hasClass('fila_subitem')){
            if (contador_subitems === 0) {
              unit_prices_subitems = unit_prices_subitems + resul_taxes;
            } else {
              unit_prices_subitems = unit_prices_subitems + ',' + resul_taxes;
            }

          }else{
            if (i === 0) {
              unit_prices = unit_prices + resul_taxes;
            } else {
              unit_prices = unit_prices + ',' + resul_taxes;
            }
          }
        }
        var total_cost = resul_taxes * quantity[i];
        total_cost = total_cost.toFixed(2);

        if (!isNaN(total_cost)) {
          total1 = total1 + parseFloat(total_cost);
        }

        $(this).find('td').eq(9).html('$ ' + total_cost);
        var total_price = resul_profit * quantity[i];
        total_price = total_price.toFixed(2);

        if (!isNaN(total_price)) {
          total2 = total2 + parseFloat(total_price);
        }

        $(this).find('td').eq(11).html('$ ' + total_price);
        if($(this).hasClass('fila_subitem')){
          if(contador_subitems === 0){
            partes_total_price_subitems = partes_total_price_subitems + total_price;
          }else{
            partes_total_price_subitems = partes_total_price_subitems + ',' + total_price;
          }
          contador_subitems++;
        }else{
          if (i === 0) {
            partes_total_price = partes_total_price + total_price;
          } else {
            partes_total_price = partes_total_price + ',' + total_price;
          }
        }

        i++;
        j++;
    });
    $('#additional').val(additional);
    $('#additional_subitems').val(additional_subitems);
    $('#unit_prices').val(unit_prices);
    $('#unit_prices_subitems').val(unit_prices_subitems);
    $('#partes_total_price').val(partes_total_price);
    $('#partes_total_price_subitems').val(partes_total_price_subitems);
    total1 = total1.toFixed(2);
    total2 = total2.toFixed(2);
    $('#total_cost').val(total1);
    $('#total_price').val(total2);
    $('#total1').html('$ ' + total1);
    $('#total2').html('$ ' + total2);
    $('#total_quantity').html(total_quantity);
    $('#total_additional').html('$ ' + total_additional);
  }, 400);



  $('#form_edited_quote').submit(function () {
    var total_additional = 0;
    var payment_terms = 0;
    if ($('input:radio[name=payment_terms]:checked').val() === 'Net 30/CC') {
      payment_terms = 1.0215;
    } else {
      payment_terms = 1;
    }
    var taxes = $('#taxes').val();
    var profit = $('#profit').val();
    if(!isNaN($('#additional_general').val()) && $('#additional_general').val() != ''){
      var additional_general = $('#additional_general').val();
    }else{
      var additional_general = 0;
    }

    if(!isNaN($('#shipping_cost').val()) && $('#shipping_cost').val() != ''){
      var shipping_cost = $('#shipping_cost').val();
    }else{
      var shipping_cost = 0;
    }

    if(!isNaN($('#consolidate_others').val()) && $('#consolidate_others').val() != ''){
      var consolidate_others = $('#consolidate_others').val();
    }else{
      var consolidate_others = 0;
    }

    var contador_subitems = 0;
    var i = 0;
    var j = 1;
    var total1 = 0 + parseFloat(consolidate_others);
    var total2 = 0 + parseFloat(shipping_cost);
    var partes_total_price = '';
    var partes_total_price_subitems = '';
    var unit_prices = '';
    var unit_prices_subitems = '';
    var additional = '';
    var additional_subitems = '';
    var total_quantity = 0;
    $('#items tr').each(function () {
      if(!isNaN($(this).find('td').eq(5).text())){
        total_quantity = total_quantity + Number($(this).find('td').eq(5).text());
      }
      if(!isNaN($('#add_cost' + j).val()) && $('#add_cost' + j).val() != ''){
        var add_cost = $('#add_cost' + j).val();
      }else{
        var add_cost = 0;
      }

      total_additional = total_additional + (parseFloat(add_cost)*quantity[i]) + (parseFloat(additional_general)*quantity[i]);

      if($(this).hasClass('fila_subitem')){
        if(contador_subitems === 0){
          additional_subitems = additional_subitems + add_cost;
        }else{
          additional_subitems = additional_subitems + ',' + add_cost;
        }
      }else{
        if (i === 0) {
          additional = additional + add_cost;
        } else {
          additional = additional + ',' + add_cost;
        }
      }

        var resul_taxes = parseFloat(additional_general) + parseFloat(add_cost) + ((1 + (taxes / 100)) * monto[i] * payment_terms);
        resul_taxes = resul_taxes.toFixed(2);
        $(this).find('td').eq(8).html('$ ' + resul_taxes);
        if (profit !== 0) {
          var resul_profit = (1 + (profit / 100)) * resul_taxes;
          resul_profit = resul_profit.toFixed(2);
          $(this).find('td').eq(10).html('$ ' + resul_profit);
          if($(this).hasClass('fila_subitem')){
            if (contador_subitems === 0) {
              unit_prices_subitems = unit_prices_subitems + resul_profit;
            } else {
              unit_prices_subitems = unit_prices_subitems + ',' + resul_profit;
            }

          }else{
            if (i === 0) {
              unit_prices = unit_prices + resul_profit;
            } else {
              unit_prices = unit_prices + ',' + resul_profit;
            }
          }
        } else {
          $(this).find('td').eq(10).html('$ ' + resul_taxes);
          if($(this).hasClass('fila_subitem')){
            if (contador_subitems === 0) {
              unit_prices_subitems = unit_prices_subitems + resul_taxes;
            } else {
              unit_prices_subitems = unit_prices_subitems + ',' + resul_taxes;
            }

          }else{
            if (i === 0) {
              unit_prices = unit_prices + resul_taxes;
            } else {
              unit_prices = unit_prices + ',' + resul_taxes;
            }
          }
        }
        var total_cost = resul_taxes * quantity[i];
        total_cost = total_cost.toFixed(2);

        if (!isNaN(total_cost)) {
          total1 = total1 + parseFloat(total_cost);
        }

        $(this).find('td').eq(9).html('$ ' + total_cost);
        var total_price = resul_profit * quantity[i];
        total_price = total_price.toFixed(2);

        if (!isNaN(total_price)) {
          total2 = total2 + parseFloat(total_price);
        }

        $(this).find('td').eq(11).html('$ ' + total_price);
        if($(this).hasClass('fila_subitem')){
          if(contador_subitems === 0){
            partes_total_price_subitems = partes_total_price_subitems + total_price;
          }else{
            partes_total_price_subitems = partes_total_price_subitems + ',' + total_price;
          }
          contador_subitems++;
        }else{
          if (i === 0) {
            partes_total_price = partes_total_price + total_price;
          } else {
            partes_total_price = partes_total_price + ',' + total_price;
          }
        }

        i++;
        j++;
    });
    $('#additional').val(additional);
    $('#additional_subitems').val(additional_subitems);
    $('#unit_prices').val(unit_prices);
    $('#unit_prices_subitems').val(unit_prices_subitems);
    $('#partes_total_price').val(partes_total_price);
    $('#partes_total_price_subitems').val(partes_total_price_subitems);
    total1 = total1.toFixed(2);
    total2 = total2.toFixed(2);
    $('#total_cost').val(total1);
    $('#total_price').val(total2);
    $('#total1').html('$ ' + total1);
    $('#total2').html('$ ' + total2);
    $('#total_quantity').html(total_quantity);
    $('#total_additional').html('$ ' + total_additional);
  });
});
