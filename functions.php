<?php

/*
* Contact Form Handler
*/
add_action('wp_ajax_contacts_form', 'contacts_form');
add_action('wp_ajax_nopriv_contacts_form', 'contacts_form');

function contacts_form()
{
    $message = '';

    $name = trim( strip_tags( htmlspecialchars( $_POST['name'] ) ) );
    $email = trim( strip_tags( htmlspecialchars( $_POST['email'] ) ) );
    $phone = trim( strip_tags( htmlspecialchars( $_POST['phone'] ) ) );
    $text = trim( strip_tags(htmlspecialchars( $_POST['message'] ) ) );

    $response = array(
        'status' => true,
        'message' => array()
    );

    /** Name Validation */
    if ( empty( $name ) ) {
        $response['status'] = false;
        $response['message']['name'] = 'Name is required';
    } else if ( ! preg_match( "/^[a-zA-Z ]*$/", $name ) ) {
        $response['status'] = false;
        $response['message']['name'] = 'Only letters';
    } else {
        $message .= 'Name: ' . $name . ', ';
    }

    /** Email Validation */
    if ( empty( $email ) ) {
        $response['status'] = false;
        $response['message']['email'] = 'Email is required';
    } else if ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
        $response['status'] = false;
        $response['message']['email'] = 'Invalid email format';
    } else {
        $message .= 'Email: ' . $email . ', ';
    }

    /** Phone Validation */
    if ( ! empty( $phone ) ) {
        $phone = str_replace( array( ' ', '-', '.', '(', ')' ), '', $phone );

        if ( strlen( $phone ) <= 8 OR strlen( $phone ) >= 13 AND ! preg_match('/([0-9]{8,13})/', $phone ) ) {
            $response['status'] = false;
            $response['message']['phone'] = 'Invalid first phone format';
        }
    } else {
        $message .= 'First Phone: ' . $phone . ', ';
    }

    /** Message Validation */
    if ( ! empty( $text ) ) {
        $message .= 'Message: ' . $text . '.';
    }

    if ( $response['status'] == true ) {
        $headers = 'Content-type: text/html; charset=utf-8';
        $subject = bloginfo('name') . ' | Contact Form';
        $send_messages_to = get_theme_mod('address');

//        $mail_send = wp_mail($send_messages_to, $subject, $message, $headers);
    }

    echo json_encode($response);

    die();
}