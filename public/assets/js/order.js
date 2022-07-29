(function($) {
  $(document).on('click', '#update_order', function() {
    console.log("update_order clicked!");
    currStatus = $(this).data("status-id");

    $("#order_id").val($(this).data("order-id"));
    $("#order_status_modal").val(currStatus);

  });

  $(document).on('click', '.modal-submit', function() {
    let newStatus = $("#order_status_modal option:selected").val();
    let close_order = 0;

    if($("#close_order_modal:checked").length > 0) {
      close_order = 1
    }

    if(currStatus != newStatus || close_order == 1) {
      let data = {};
      let jwt = $("[name='atoken']").attr('content');

      data.order_id = $("#order_id").val();
      data.curr_status = currStatus;
      data.new_status = newStatus;
      data.close_order = close_order;

      $.ajax({
        type: "POST",
        url: "/index.php/api/order/update_order",
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