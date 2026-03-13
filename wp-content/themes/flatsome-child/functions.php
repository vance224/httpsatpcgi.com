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
    
    // Localize script for AJAX URL
    wp_localize_script('contact-form-script', 'contactFormAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php')
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

// Configure SMTP for email sending
function flatsome_child_configure_smtp($phpmailer) {
    // Only configure if PHPMailer object exists
    if (!is_object($phpmailer)) {
        return;
    }
    
    // SMTP Configuration
    // For localhost/testing: You can use Gmail SMTP or a mail service like Mailtrap, SendGrid, etc.
    // For production: Use your hosting provider's SMTP settings
    
    // Option 1: Gmail SMTP (requires App Password)
    // To use Gmail:
    // 1. Enable 2-Step Verification in your Google Account
    // 2. Generate an App Password: https://myaccount.google.com/apppasswords
    // 3. Use that App Password below (not your regular password)
    
    // Option 2: Use your hosting provider's SMTP
    // Check your hosting provider's documentation for SMTP settings
    
    // Option 3: Use a service like Mailtrap for testing (free)
    // Sign up at https://mailtrap.io and use their SMTP settings
    
    // Uncomment and configure ONE of the options below:
    
    // ===== OPTION 1: Gmail SMTP =====
    // IMPORTANT: To use Gmail SMTP, you need:
    // 1. Enable 2-Step Verification in your Google Account
    // 2. Generate an App Password: https://myaccount.google.com/apppasswords
    // 3. Use the App Password below (NOT your regular Gmail password)
    
    // Set to true to enable Gmail SMTP
    $use_gmail_smtp = false; // Set to true and configure credentials below
    
    // UPDATE THESE WITH YOUR GMAIL CREDENTIALS:
    $gmail_username = ''; // Your Gmail address (e.g., yourname@gmail.com)
    $gmail_app_password = ''; // Your Gmail App Password (16 characters, no spaces)
    
    if ($use_gmail_smtp && !empty($gmail_username) && !empty($gmail_app_password)) {
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.gmail.com';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 587;
        $phpmailer->SMTPSecure = 'tls';
        $phpmailer->Username = $gmail_username;
        $phpmailer->Password = $gmail_app_password;
        
        // Additional Gmail-specific settings
        $phpmailer->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        return; // Exit early if Gmail is configured
    }
    
    // ===== OPTION 2: Mailtrap (for testing) - ENABLED =====
    // Mailtrap is FREE and perfect for testing emails
    // Quick setup: https://mailtrap.io → Sign up (free) → Inboxes → SMTP Settings
    
    // Set to true to enable Mailtrap
    $use_mailtrap = true; // Currently enabled for testing
    
    // UPDATE THESE WITH YOUR MAILTRAP SMTP CREDENTIALS:
    // Get from: https://mailtrap.io → Inboxes → SMTP Settings
    $mailtrap_username = 'your-mailtrap-username'; // Mailtrap SMTP username
    $mailtrap_password = 'your-mailtrap-password'; // Mailtrap SMTP password
    
    if ($use_mailtrap && !empty($mailtrap_username) && !empty($mailtrap_password)) {
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = trim($mailtrap_username);
        $phpmailer->Password = trim($mailtrap_password);
        $phpmailer->SMTPSecure = false;
        $phpmailer->SMTPAutoTLS = false;
        return;
    }
    
    // ===== OPTION 3: Fallback - Try to send without SMTP =====
    // If no SMTP is configured, WordPress will try to use PHP mail() function
    // This may work on some servers but often fails on localhost
    // For best results, configure Mailtrap above
    
    // ===== OPTION 3: Generic SMTP (update with your provider's settings) =====
    /*
    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.your-provider.com';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 587; // or 465 for SSL
    $phpmailer->SMTPSecure = 'tls'; // or 'ssl' for port 465
    $phpmailer->Username = 'your-email@yourdomain.com';
    $phpmailer->Password = 'your-password';
    */
    
    // For now, we'll try to use the default mail() function
    // If that doesn't work, uncomment one of the options above
    
    // Set From email and name
    $admin_email = get_option('admin_email');
    if (!empty($admin_email)) {
        $phpmailer->From = $admin_email;
        $phpmailer->FromName = get_bloginfo('name');
    }
    
    // Enable error logging (set SMTPDebug to 2 for detailed debugging)
    // Enable debugging to see what's happening
    $phpmailer->SMTPDebug = 0; // 0 = off, 1 = client, 2 = client and server (set to 2 for debugging)
    $phpmailer->Debugoutput = function($str, $level) {
        // Log to error log
        error_log("SMTP Debug ($level): $str");
        // Also log to a file for easier debugging
        $log_file = WP_CONTENT_DIR . '/debug-smtp.log';
        @file_put_contents($log_file, date('Y-m-d H:i:s') . " [$level] $str\n", FILE_APPEND);
    };
}
add_action('phpmailer_init', 'flatsome_child_configure_smtp');

// Handle contact form submission
function flatsome_child_handle_contact_form() {
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
    $to = 'vance@yopmail.com'; // Send to specified email (testing)
    $subject = 'New Contact Form Submission: Start a Project';
    
    $email_body = "New contact form submission from " . get_bloginfo('name') . "\n\n";
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
    
    if (!empty($message)) {
        $email_body .= "\nMessage:\n$message\n";
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
        wp_send_json_success(array('message' => 'Thank you! Your message has been sent.'));
    } else {
        // Show detailed error message for debugging
        $error_message = 'There was an error sending your message.';
        
        // Include error details for debugging
        if (!empty($mail_error)) {
            $error_message .= ' Error details: ' . $mail_error;
        } else {
            $error_message .= ' No error details available.';
        }
        
        // Add helpful instructions
        $error_message .= ' Please configure SMTP settings in functions.php (Mailtrap recommended for testing).';
        
        // Log full error for debugging
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('Email sending failed. Error: ' . $mail_error);
            error_log('PHPMailer ErrorInfo: ' . (isset($phpmailer) && is_object($phpmailer) ? $phpmailer->ErrorInfo : 'N/A'));
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