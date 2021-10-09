// require('./jquery');
require("./bootstrap");
// require('./adminlte');

// Protection CSRF :

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$(function () {
    /* Update Personal Info : */
    $("#userProfileForm").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
          url:$(this).attr('action'),
          method:$(this).attr('method'),
          data: new FormData(this),
          processData:false,
          dataType:'json',
          contentType:false,
          beforeSend:function(){ 
            // vider les messages d'erreur :
            $(document).find('span.error-text').text('');
          },
          success:function(data) {
            if(data.status == 0) {
                $.each(data.error, function(prefix, val) {
                    $('span.'+prefix+'_error').text(val[0]);
                });
            } else {
                $('.user_name').each(function() {
                    $(this).html($('#userProfileForm').find($('input[name="name"]')).val());
                });
                alert(data.msg);
            }
          }
        });
    });
});
