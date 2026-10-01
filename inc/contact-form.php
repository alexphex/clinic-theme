<?php
add_action('admin_post_nopriv_clinic_contact', 'clinic_handle_contact');
add_action('admin_post_clinic_contact', 'clinic_handle_contact');

function clinic_contact_redirect($status) {
    $back = wp_get_referer() ?: home_url('/');
    $back = remove_query_arg('form', $back);
    wp_safe_redirect(add_query_arg('form', $status, $back) . '#contact');
    exit;
}

function clinic_handle_contact() {
    $nonce = isset($_POST['clinic_nonce']) ? sanitize_text_field(wp_unslash($_POST['clinic_nonce'])) : '';
    if (!wp_verify_nonce($nonce, 'clinic_contact')) {
        clinic_contact_redirect('error');
    }

    // Honeypot: bots fill this hidden field
    if (!empty($_POST['website'])) {
        clinic_contact_redirect('sent');
    }

    $name    = sanitize_text_field(wp_unslash($_POST['name'] ?? ''));
    $phone   = sanitize_text_field(wp_unslash($_POST['phone'] ?? ''));
    $email   = sanitize_email(wp_unslash($_POST['email'] ?? ''));
    $message = sanitize_textarea_field(wp_unslash($_POST['message'] ?? ''));

    if ($name === '' || $phone === '') {
        clinic_contact_redirect('error');
    }

    $subject = 'New appointment request from ' . $name;
    $body    = "Name: $name\nPhone: $phone\nEmail: $email\n\nMessage:\n$message\n";

    $headers = [];
    if ($email && is_email($email)) {
        $headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
    }

    $sent = wp_mail(get_option('admin_email'), $subject, $body, $headers);
    clinic_contact_redirect($sent ? 'sent' : 'error');
}