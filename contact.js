jQuery(document).ready(function(event){
    jQuery('#form_contact').submit(function(){
        var $user_name = $(this).find("input[name='name']");
        var $user_email = $(this).find("input[name='email']");
        var $user_phone = $(this).find("input[name='phone']");
        var $user_comments = $(this).find("textarea[name='comment']");
        var sentForm = true;

        if(sentForm){
            var data = $(this).serialize();
            
            jQuery.ajax({
                type: 'POST',
                url: "/wp-admin/admin-ajax.php",
                data: data + '&action=contacts_form',
                success: function (data) {
                    $user_name.val('');
                    $user_email.val('');
                    $user_comments.val('');
                    $user_phone.val('');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                }
            });
        }
    });
});