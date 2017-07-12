<?php
add_filter( 'wp_mail_from_name', 'my_mail_from_name' );
function my_mail_from_name( $name ) {
    return "Site name";
}

add_filter( 'wp_mail_from', 'my_mail_from' );
function my_mail_from( $email ) {
    return "your@email.com";
}

// AJAX send contact form
function contacts_form()
{
    $headers  = 'Content-type: text/html; charset=utf-8';

    $name = trim(htmlspecialchars($_POST['name']));
    $mail = trim(htmlspecialchars($_POST['email']));
    $phone = trim(htmlspecialchars($_POST['phone']));
    $comment = trim(htmlspecialchars($_POST['comment']));

    $mailTo = 'youremail@mail.com';
    //$mailTo = get_field('email', 'option');
    
    $textMessage = "<table>
                        <tr>
                            <td style='padding: 5px 0px;'><b>Name:</b></td>
                            <td style='padding: 5px 0px; padding-left: 20px;'>" . $name . "</td>
                        </tr>";
    if(!empty($mail)) {
        $textMessage .= "<tr>
                            <td style='padding: 5px 0px;'><b>E-mail:</b></td>
                            <td style='padding: 5px 0px; padding-left: 20px;'>" . $mail . "</td>
                        </tr>";
    }
    if(!empty($phone)) {
        $textMessage .= "<tr>
                            <td style='padding: 5px 0px;'><b>Phone:</b></td>
                            <td style='padding: 5px 0px; padding-left: 20px;'>" . $phone . "</td>
                        </tr>";
    }
    if(!empty($comment)) {
        $textMessage .= "<tr>
                            <td style='padding: 5px 0px;'><b>Comment:</b></td>
                            <td style='padding: 5px 0px; padding-left: 20px;'>" . $comment ."</td>
                        </tr>
                    </table>";
    }
    if(!empty($name) || !empty($mail) || !empty($phone)) {
        wp_mail($mailTo, '|Your Site', $textMessage, $headers);
    }
    wp_die();
}

add_action('wp_ajax_contacts_form', 'contacts_form');
add_action('wp_ajax_nopriv_contacts_form', 'contacts_form');
