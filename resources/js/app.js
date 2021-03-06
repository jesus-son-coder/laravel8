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
                $('.experience_voyage').html($('#userProfileForm').find($('textarea[name="voyage"]')).val());
                $('.userPresentation').html($('#userProfileForm').find($('textarea[name="presentation"]')).val());
                $('.user_short_description').html($('#userProfileForm').find($('input[name="short_description"]')).val());
                $('.userPassion').html($('#userProfileForm').find($('input[name="culinaire"]')).val());

                $('.notification-update').show(0).delay(3000).hide(0);
                // alert(data.msg);
            }
          }
        });
    });

    /* Change User Picture : */
    $(document).on('click', '#change_picture_btn', function() {
        $('#user_picture').trigger('click');
    });

    $('#user_picture').ijaboCropTool({
        preview : '.user_profile_picture',
        setRatio:1,
        allowedExtensions: ['jpg', 'jpeg','png'],
        buttonsText:['CROP','QUIT'],
        buttonsColor:['#30bf7d','#ee5155', -15],
        processUrl:'/change-profile-picture',
        // withCSRF:['_token','{{ csrf_token() }}'],
        onSuccess:function(message, element, status){
           // alert(message);
        },
        onError:function(message, element, status){
          alert(message);
        }
     });


     /* Change User Password : */
     $('#userChangePasswordForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function(){
                $(document).find('span.error-text').text('');
            },
            success:function(data) {
                if(data.status == 0) {
                    $.each(data.error, function(prefix, val) {
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                } else {
                    $('#userChangePasswordForm')[0].reset();
                    alert(data.msg);
                }
            }
        });

     });


});
