<?php
// Add custom Theme Functions here

// Enqueue contact form styles and scripts
function flatsome_child_enqueue_contact_form() {
    // Check if we're on the contact page or if floating form should be available
    $is_contact_page = is_page_template('page-contacts.php') || 
                       (is_page() && (get_page_template_slug() === 'page-contacts.php' || 
                        strpos(get_permalink(), '/contacts/') !== false));
    
    // Always enqueue CSS (for both page and floating form)
    wp_enqueue_style(
        'contact-form-style',
        get_stylesheet_directory_uri() . '/contact-form.css',
        array(),
        '1.0.1'
    );
    
    // Enqueue JavaScript
    wp_enqueue_script(
        'contact-form-script',
        get_stylesheet_directory_uri() . '/contact-form.js',
        array(),
        '1.0.1',
        true
    );
    
    // Localize script for AJAX URL and nonce
    wp_localize_script('contact-form-script', 'contactFormAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('contact_form_submit')
    ));
    
    // Add reCAPTCHA site key if configured (replace with your actual site key or get from options)
    // For now, we'll enable reCAPTCHA but you need to add your site key
    $recaptcha_site_key = ''; // Replace with your reCAPTCHA site key or get_option('recaptcha_site_key')
    
    // If you have a reCAPTCHA site key, uncomment and add it here:
    // $recaptcha_site_key = 'YOUR_RECAPTCHA_SITE_KEY_HERE';
    
    if (!empty($recaptcha_site_key) && $recaptcha_site_key !== 'YOUR_RECAPTCHA_SITE_KEY') {
        wp_localize_script('contact-form-script', 'contactFormRecaptchaKey', $recaptcha_site_key);
        
        // Enqueue reCAPTCHA script with Vietnamese language (hl=vi)
        wp_enqueue_script(
            'google-recaptcha',
            'https://www.google.com/recaptcha/api.js?hl=vi',
            array(),
            null,
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'flatsome_child_enqueue_contact_form');

// Include email configuration file
$email_config_file = get_stylesheet_directory() . '/email-config.php';
if (file_exists($email_config_file)) {
    require_once $email_config_file;
    
    // Apply email configuration to PHPMailer
    add_action('phpmailer_init', 'apply_email_config');
} else {
    // Fallback: Basic SMTP configuration if email-config.php doesn't exist
    function flatsome_child_configure_smtp_fallback($phpmailer) {
        if (!is_object($phpmailer)) {
            return;
        }
        
        // Set From email and name
        $admin_email = get_option('admin_email');
        if (!empty($admin_email)) {
            $phpmailer->From = $admin_email;
            $phpmailer->FromName = get_bloginfo('name');
        }
    }
    add_action('phpmailer_init', 'flatsome_child_configure_smtp_fallback');
}

// Handle contact form submission
function flatsome_child_handle_contact_form() {
    // Verify nonce for security
    $nonce = isset($_POST['contact_form_nonce']) ? $_POST['contact_form_nonce'] : '';
    if (!wp_verify_nonce($nonce, 'contact_form_submit')) {
        wp_send_json_error(array('message' => 'Security verification failed. Please refresh the page and try again.'));
        return;
    }
    
    // Get form data
    $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $company = isset($_POST['company']) ? sanitize_text_field($_POST['company']) : '';
    $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';
    $interests = isset($_POST['interests']) ? array_map('sanitize_text_field', $_POST['interests']) : array();
    
    // Validate required fields
    $errors = array();
    
    if (empty($name)) {
        $errors[] = 'Name is required';
    }
    
    if (empty($email)) {
        $errors[] = 'Email is required';
    } elseif (!is_email($email)) {
        $errors[] = 'Please enter a valid email address';
    }
    
    if (empty($company)) {
        $errors[] = 'Company is required';
    }
    
    if (empty($phone)) {
        $errors[] = 'Phone is required';
    }
    
    if (empty($message)) {
        $errors[] = 'Message is required';
    }
    
    if (!empty($errors)) {
        wp_send_json_error(array('message' => implode('. ', $errors) . '.'));
        return;
    }
    
    // Verify reCAPTCHA (if enabled)
    // $recaptcha_response = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '';
    // if (!verify_recaptcha($recaptcha_response)) {
    //     wp_send_json_error(array('message' => 'Please complete the reCAPTCHA verification.'));
    //     return;
    // }
    
    // Prepare email content
    // Get recipient email from config file if available, otherwise use default
    $to = function_exists('get_contact_form_recipient') 
        ? get_contact_form_recipient() 
        : 'info@atpcgi.com';
    $subject = 'New Contact Form Submission from ' . get_bloginfo('name');
    
    // Build email body with all required fields
    $email_body = "You have received a new contact form submission from " . get_bloginfo('name') . "\n\n";
    $email_body .= "=== CONTACT INFORMATION ===\n";
    $email_body .= "Name: $name\n";
    $email_body .= "Email: $email\n";
    
    if (!empty($company)) {
        $email_body .= "Company: $company\n";
    }
    
    if (!empty($phone)) {
        $email_body .= "Phone: $phone\n";
    }
    
    if (!empty($interests)) {
        $email_body .= "Interests: " . implode(', ', $interests) . "\n";
    }
    
    $email_body .= "\n=== MESSAGE ===\n";
    if (!empty($message)) {
        $email_body .= "$message\n";
    }
    
    $email_body .= "\n---\n";
    $email_body .= "Submitted on: " . date('F j, Y, g:i a') . "\n";
    $email_body .= "IP Address: " . (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'Unknown') . "\n";
    
    // Get From email - use WordPress admin email for testing
    $admin_email = get_option('admin_email');
    $from_email = !empty($admin_email) ? $admin_email : 'noreply@example.com'; // Use admin email or fallback
    $from_name = get_bloginfo('name'); // Use site name as From name
    
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $from_name . ' <' . $from_email . '>',
        'Reply-To: ' . $name . ' <' . $email . '>'
    );
    
    // Enable error reporting temporarily to catch mail errors
    $old_error_reporting = error_reporting(E_ALL);
    $old_display_errors = ini_get('display_errors');
    ini_set('display_errors', 0);
    
    // Try to send email
    $mail_sent = false;
    $mail_error = '';
    
    // Capture PHPMailer errors
    global $phpmailer;
    
    try {
        // Send email using wp_mail
        $mail_sent = wp_mail($to, $subject, $email_body, $headers);
        
        // Check for PHPMailer errors
        if (!$mail_sent && isset($phpmailer) && is_object($phpmailer)) {
            $mail_error = $phpmailer->ErrorInfo;
            if (empty($mail_error)) {
                $mail_error = 'Unknown mail error';
            }
            
            // If connection failed on port 465, try port 587 next time
            $current_port = isset($phpmailer->Port) ? $phpmailer->Port : 465;
            if ($current_port == 465 && (strpos($mail_error, 'QUIT') !== false || strpos($mail_error, 'connect') !== false)) {
                // Set transient to try port 587 on next attempt
                set_transient('smtp_try_587', true, 300); // 5 minutes
            }
            
            // Log detailed error information
            if (defined('WP_DEBUG') && WP_DEBUG) {
                error_log('PHPMailer ErrorInfo: ' . $mail_error);
                error_log('SMTP Host: ' . (isset($phpmailer->Host) ? $phpmailer->Host : 'N/A'));
                error_log('SMTP Port: ' . (isset($phpmailer->Port) ? $phpmailer->Port : 'N/A'));
                error_log('SMTP Secure: ' . (isset($phpmailer->SMTPSecure) ? $phpmailer->SMTPSecure : 'N/A'));
                error_log('SMTP Auth: ' . (isset($phpmailer->SMTPAuth) ? ($phpmailer->SMTPAuth ? 'Yes' : 'No') : 'N/A'));
                error_log('Username: ' . (isset($phpmailer->Username) ? substr($phpmailer->Username, 0, 10) . '...' : 'N/A'));
            }
        } else if ($mail_sent) {
            // Clear the transient if email sent successfully
            delete_transient('smtp_try_587');
        }
    } catch (Exception $e) {
        $mail_error = $e->getMessage();
        $mail_sent = false;
    } catch (Error $e) {
        $mail_error = $e->getMessage();
        $mail_sent = false;
    }
    
    // Restore error reporting
    error_reporting($old_error_reporting);
    ini_set('display_errors', $old_display_errors);
    
    // Log the submission for debugging
    if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log('Contact form submission: Name=' . $name . ', Email=' . $email . ', Mail sent=' . ($mail_sent ? 'Yes' : 'No'));
        if (!empty($mail_error)) {
            error_log('Mail error: ' . $mail_error);
        }
    }
    
    // Return response
    if ($mail_sent) {
        wp_send_json_success(array('message' => 'Thank you! Your message has been sent successfully.'));
    } else {
        // Log detailed error for debugging (always log, not just in WP_DEBUG mode)
        $log_message = 'Contact form email sending failed.';
        if (!empty($mail_error)) {
            $log_message .= ' Error: ' . $mail_error;
        }
        if (isset($phpmailer) && is_object($phpmailer) && !empty($phpmailer->ErrorInfo)) {
            $log_message .= ' PHPMailer ErrorInfo: ' . $phpmailer->ErrorInfo;
        }
        error_log($log_message);
        
        // Show user-friendly error message (don't expose technical details)
        $error_message = 'Sorry, there was an error sending your message. Please try again later or contact us directly at info@atpcgi.com.';
        
        // In debug mode, show more details
        if (defined('WP_DEBUG') && WP_DEBUG && current_user_can('manage_options')) {
            if (!empty($mail_error)) {
                $error_message .= ' (Debug: ' . esc_html($mail_error) . ')';
            }
        }
        
        wp_send_json_error(array('message' => $error_message));
    }
}
// Register AJAX handlers for both logged-in and non-logged-in users
add_action('wp_ajax_submit_contact_form', 'flatsome_child_handle_contact_form');
add_action('wp_ajax_nopriv_submit_contact_form', 'flatsome_child_handle_contact_form'); // For non-logged-in users

// Debug: Log when AJAX handler is registered
if (defined('WP_DEBUG') && WP_DEBUG) {
    error_log('Contact form AJAX handler registered');
}

// Helper function to verify reCAPTCHA (if you enable it)
function verify_recaptcha($response) {
    $secret_key = 'YOUR_RECAPTCHA_SECRET_KEY'; // Replace with your secret key
    
    $verify_url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array(
        'secret' => $secret_key,
        'response' => $response,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    );
    
    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );
    
    $context = stream_context_create($options);
    $result = file_get_contents($verify_url, false, $context);
    $result_json = json_decode($result);
    
    return isset($result_json->success) && $result_json->success === true;
}