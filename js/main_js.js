$(document).ready(function(){
  /**********************************DATEPICKER********************************/
  $('#po_date, #eta').daterangepicker({
    singleDatePicker: true
  });
  /**************************************SHOW INFO RFQ FULLFILLMENT MODAL********/
  $('#add_rfq_fullfillment_info').click(function(){
    $('#info_rfq_fullfillment_modal').modal();
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
  $('#rfq_team_table').DataTable();
  $('#users_table').DataTable();
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
    var contador_subitems = 0;
    var i = 0;
    var j = 1;
    var total1 = 0;
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

    /***********************FULLFILLMENT PART**************/
    if($('#channel').length != 0 && $('#channel').val() == 'FedBid'){
      var vendors_estimate = $('#total_cost_fedbid').val();
      var equipment_amount = $('#total_price_fedbid').val();
    }else{
      var vendors_estimate = total1;
      var equipment_amount = total2;
    }
    $('#vendors_estimate').val(vendors_estimate);
    $('#equipment_amount').val(equipment_amount);
    if(!isNaN($('#consolidate_others').val()) && $('#consolidate_others').val() != ''){
      var consolidate_others = $('#consolidate_others').val();
    }else{
      var consolidate_others = 0;
    }
    var total_vendor_cost = parseFloat(vendors_estimate) + parseFloat(consolidate_others);
    total_vendor_cost = total_vendor_cost.toFixed(2);
    if($('#rfq_fullfillment_part_fedbid').length != 0){
      if(!isNaN($('#rfq_fullfillment_part_fedbid').val()) && $('#rfq_fullfillment_part_fedbid').val() != ''){
        var rfq_fullfillment_part_fedbid = $('#rfq_fullfillment_part_fedbid').val();
      }else{
        var rfq_fullfillment_part_fedbid = 0;
      }
    }else{
      var rfq_fullfillment_part_fedbid = 0;
    }
    var estimated_final_cost = parseFloat(total_vendor_cost) + parseFloat(rfq_fullfillment_part_fedbid);
    estimated_final_cost = estimated_final_cost.toFixed(2);
    var estimated_profit_g = parseFloat(equipment_amount) - parseFloat(total_vendor_cost);
    estimated_profit_g = estimated_profit_g.toFixed(2);
    var percent_g = (parseFloat(estimated_profit_g)/parseFloat(equipment_amount))*100;
    percent_g = percent_g.toFixed(2);
    var estimated_profit_s = parseFloat(equipment_amount) - parseFloat(estimated_final_cost);
    estimated_profit_s = estimated_profit_s.toFixed(2);
    var percent_s = (parseFloat(estimated_profit_s)/parseFloat(equipment_amount))*100;
    percent_s = percent_s.toFixed(2);
    $('#total_vendor_cost').val(total_vendor_cost);
    $('#estimated_final_cost').val(estimated_final_cost);
    $('#estimated_profit_g').val(estimated_profit_g);
    $('#percent_g').val(percent_g);
    $('#estimated_profit_s').val(estimated_profit_s);
    $('#percent_s').val(percent_s);
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
    var contador_subitems = 0;
    var i = 0;
    var j = 1;
    var total1 = 0;
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
