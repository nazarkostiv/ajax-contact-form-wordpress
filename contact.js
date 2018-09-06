$('#form_contact').submit(function(){
    event.preventDefault();

    var name = $('input[name=name]').val();
    var email = $('input[name=email]').val();
    var phone = $('input[name=phone]').val();
    var message = $('textarea[name=message]').val();

    var data = {
        'action' : 'contact_form',
        'name' : name,
        'email' : email,
        'phone' : phone,
        'message' : message
    };

    $.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php', /* OR url: '<?php echo admin_url('admin-ajax.php') ?>', */
        data: data,
        beforeSend: function (xhr){
        },
        success: function (data){
           if(data){
                var response = JSON.parse(data);

                if(response.status == false){
                    console.log(response.message);
                }

                if (response.status == true) {
                    $('#form_contact')[0].reset();
                }
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
        }
    });
});