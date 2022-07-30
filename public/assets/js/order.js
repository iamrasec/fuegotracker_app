(function($) {
  var jwt = $("[name='atoken']").attr('content');

  $(document).ready(function() {
    $("#export_start_date").datepicker({
      dateFormat: "yy-mm-dd",
      onSelect: function(dateStr) 
      {         
          $("#export_end_date").val(dateStr);
          $("#export_end_date").datepicker("option",{ minDate: new Date(dateStr)})
          $("#export_end_date").prop("disabled", false);
      }
    });

    $("#export_end_date").datepicker({
      dateFormat: "yy-mm-dd",
    });
  });

  $(document).on('click', '#exportExcelModal .modal-submit', function() {
    $("#export_data_form").submit();
    // let exportData = {};

    // exportData.start_date = $("#export_start_date").val();
    // exportData.end_date = $("#export_end_date").val();

    // $.ajax({
    //   type: "POST",
    //   url: "/order/export_data",
    //   data: exportData,
    //   dataType: "json",
    //   success: function(json) {
    //     console.log(json);
    //   },
    //   error: function(XMLHttpRequest, textStatus, errorThrown) {
    //     console.log(textStatus);
    //   },
    //   beforeSend: function(xhr) {
    //     xhr.setRequestHeader("Authorization", 'Bearer '+ jwt);
    //   }
    // });
  });

  $(document).on('click', '#update_order', function() {
    console.log("update_order clicked!");
    currStatus = $(this).data("status-id");

    $("#order_id").val($(this).data("order-id"));
    $("#order_status_modal").val(currStatus);

  });

  $(document).on('click', '#updateModal .modal-submit', function() {
    let newStatus = $("#order_status_modal option:selected").val();
    let close_order = 0;

    if($("#close_order_modal:checked").length > 0) {
      close_order = 1
    }

    if(currStatus != newStatus || close_order == 1) {
      let data = {};

      data.order_id = $("#order_id").val();
      data.curr_status = currStatus;
      data.new_status = newStatus;
      data.close_order = close_order;

      $.ajax({
        type: "POST",
        // url: "/api/order/update_order",
        url: "/order/update_order",
        data: data,
        dataType: "json",
        success: function(json) {
          console.log(json);
          // if(json.message == true) {
          //   $("#newBrandModal .cancel-btn").click();
          //   $("new_brand_name").val("");
          //   $("#select_brand").prop('selectedIndex', -1);
          //   $("#select_brand").append('<option value="'+json.data+'" selected="selected">'+data.name+'</option>');
          // }
          location.reload(true);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          console.log(textStatus);
        },
        beforeSend: function(xhr) {
          xhr.setRequestHeader("Authorization", 'Bearer '+ jwt);
        }
      });
    }
    else {
      $(".modal-close").trigger("click");
    }

  });

})(jQuery);