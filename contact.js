$('#form_contact').submit(function(){ // Form submit

    // Clear all fields
    $("#user_name, #user_email, #user_phone, #user_comment").val('');

    // Functions
    function isValidEmailAddress(email) {
        var pattern = new RegExp(/[a-z0-9!#$%&'*+=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/i);
        return pattern.test(email);
    };
    function isValidPhoneAddress(phone) {
        var pattern = new RegExp(/\b[+]?[-0-9\(\) ]{10,20}\b/);
        return pattern.test(phone);
    };

    // Some variables
    var submit = 0;
    var requareName = true;
    var name = $('#user_name').val();
    var mail = $('#user_email').val();
    var phone = $('#user_phone').val();
    var comment = $('#user_comment').val();

    // Form validation
    // Name validate
    if( name.length < 2) {
        submit++;
        requareName = false;
    } else {
    }
    // Phone validate
    if(!isValidPhoneAddress(phone)) {
        submit++;
    } else if(isValidEmailAddress(mail)) {
        submit--;
    } else {
        submit--;
    }
    // Email validate
    if(!isValidEmailAddress(mail)) {
        submit++;
    } else if(isValidPhoneAddress(phone)) {
        submit--;
    } else {
        submit--;
    }

    // Send form data
    var data = $(this).serialize();
    if( submit < 1 && requareName != false ) {    
        jQuery.ajax({
            type: 'POST',
            url: "/wp-admin/admin-ajax.php",
            data: data + '&action=contacts_form',
            success: function (data) {
                $("#user_name, #user_email, #user_phone, #user_comment").val('');
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });
    }
});