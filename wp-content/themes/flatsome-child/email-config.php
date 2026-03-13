<?php
/**
 * Email Configuration File
 * 
 * This file contains all email-related configuration settings.
 * Update the settings below to configure SMTP for sending emails.
 * 
 * IMPORTANT: After making changes, test the contact form to ensure emails are sending correctly.
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Email Configuration Settings
 * 
 * Choose ONE of the following SMTP options by setting $email_config['method']:
 * - 'mailtrap'  : For testing (recommended for localhost)
 * - 'gmail'    : For production using Gmail SMTP
 * - 'generic'  : For production using your hosting provider's SMTP
 * - 'default'   : Use WordPress default mail() function (may not work on localhost)
 */
$email_config = array(
    // SMTP Method: 'mailtrap', 'gmail', 'generic', or 'default'
    'method' => 'default',
    
    // Recipient email address for contact form submissions
    'contact_form_recipient' => 'info@atpcgi.com',
    
    // From email address (will use WordPress admin email if empty)
    'from_email' => '',
    
    // From name (will use WordPress site name if empty)
    'from_name' => '',
    
    // ============================================
    // MAILTRAP CONFIGURATION (For Testing)
    // ============================================
    // Sign up for free at: https://mailtrap.io
    // Get credentials from: Inboxes → SMTP Settings
    'mailtrap' => array(
        'host' => 'smtp.mailtrap.io',
        'port' => 2525,
        'username' => 'your-mailtrap-username',
        'password' => 'your-mailtrap-password',
        'secure' => false, // false for port 2525
    ),
    
    // ============================================
    // GMAIL SMTP CONFIGURATION (For Production)
    // ============================================
    // IMPORTANT: To use Gmail SMTP:
    // 1. Enable 2-Step Verification in your Google Account
    // 2. Generate an App Password: https://myaccount.google.com/apppasswords
    // 3. Use the App Password below (NOT your regular Gmail password)
    'gmail' => array(
        'host' => 'smtp.gmail.com',
        'port' => 587,
        'username' => 'your-email@gmail.com',
        'password' => 'your-app-password', // 16-character App Password
        'secure' => 'tls', // 'tls' for port 587
    ),
    
    // ============================================
    // GENERIC SMTP CONFIGURATION (For Production)
    // ============================================
    // Use your hosting provider's SMTP settings
    // Common ports: 587 (TLS), 465 (SSL), 25 (unencrypted)
    'generic' => array(
        'host' => 'smtp.your-provider.com',
        'port' => 587,
        'username' => 'your-email@yourdomain.com',
        'password' => 'your-password',
        'secure' => 'tls', // 'tls' for port 587, 'ssl' for port 465
    ),
    
    // ============================================
    // DEBUG SETTINGS
    // ============================================
    'debug' => array(
        'enabled' => false, // Set to true to enable SMTP debugging
        'level' => 0, // 0 = off, 1 = client messages, 2 = client and server messages
        'log_file' => WP_CONTENT_DIR . '/debug-smtp.log', // Log file path
    ),
);

/**
 * Apply SMTP Configuration to PHPMailer
 * 
 * This function is called by the phpmailer_init hook in functions.php
 * 
 * @param PHPMailer $phpmailer The PHPMailer instance
 */
function apply_email_config($phpmailer) {
    global $email_config;
    
    // Only configure if PHPMailer object exists
    if (!is_object($phpmailer)) {
        return;
    }
    
    $method = isset($email_config['method']) ? $email_config['method'] : 'default';
    
    // Configure SMTP based on selected method
    switch ($method) {
        case 'mailtrap':
            if (!empty($email_config['mailtrap']['username']) && 
                !empty($email_config['mailtrap']['password']) &&
                $email_config['mailtrap']['username'] !== 'your-mailtrap-username') {
                
                $phpmailer->isSMTP();
                $phpmailer->Host = $email_config['mailtrap']['host'];
                $phpmailer->SMTPAuth = true;
                $phpmailer->Port = $email_config['mailtrap']['port'];
                $phpmailer->Username = trim($email_config['mailtrap']['username']);
                $phpmailer->Password = trim($email_config['mailtrap']['password']);
                $phpmailer->SMTPSecure = $email_config['mailtrap']['secure'];
                $phpmailer->SMTPAutoTLS = false;
                
                // Set From email and name
                set_email_from($phpmailer);
                
                // Configure debugging
                configure_smtp_debug($phpmailer);
                
                return;
            }
            break;
            
        case 'gmail':
            if (!empty($email_config['gmail']['username']) && 
                !empty($email_config['gmail']['password']) &&
                $email_config['gmail']['username'] !== 'your-email@gmail.com') {
                
                $phpmailer->isSMTP();
                $phpmailer->Host = $email_config['gmail']['host'];
                $phpmailer->SMTPAuth = true;
                $phpmailer->Port = $email_config['gmail']['port'];
                $phpmailer->SMTPSecure = $email_config['gmail']['secure'];
                $phpmailer->Username = trim($email_config['gmail']['username']);
                $phpmailer->Password = trim($email_config['gmail']['password']);
                
                // Gmail-specific SSL settings
                $phpmailer->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                
                // Set From email and name
                set_email_from($phpmailer);
                
                // Configure debugging
                configure_smtp_debug($phpmailer);
                
                return;
            }
            break;
            
        case 'generic':
            if (!empty($email_config['generic']['host']) && 
                !empty($email_config['generic']['username']) && 
                !empty($email_config['generic']['password']) &&
                $email_config['generic']['host'] !== 'smtp.your-provider.com') {
                
                $phpmailer->isSMTP();
                $phpmailer->Host = $email_config['generic']['host'];
                $phpmailer->SMTPAuth = true;
                $phpmailer->Port = $email_config['generic']['port'];
                $phpmailer->SMTPSecure = $email_config['generic']['secure'];
                $phpmailer->Username = trim($email_config['generic']['username']);
                $phpmailer->Password = trim($email_config['generic']['password']);
                
                // Set From email and name
                set_email_from($phpmailer);
                
                // Configure debugging
                configure_smtp_debug($phpmailer);
                
                return;
            }
            break;
            
        case 'default':
        default:
            // Use WordPress default mail() function
            // Set From email and name
            set_email_from($phpmailer);
            
            // Configure debugging
            configure_smtp_debug($phpmailer);
            break;
    }
}

/**
 * Set From email and name
 * 
 * @param PHPMailer $phpmailer The PHPMailer instance
 */
function set_email_from($phpmailer) {
    global $email_config;
    
    $from_email = !empty($email_config['from_email']) 
        ? $email_config['from_email'] 
        : get_option('admin_email');
    
    $from_name = !empty($email_config['from_name']) 
        ? $email_config['from_name'] 
        : get_bloginfo('name');
    
    if (!empty($from_email)) {
        $phpmailer->From = $from_email;
        $phpmailer->FromName = $from_name;
    }
}

/**
 * Configure SMTP Debugging
 * 
 * @param PHPMailer $phpmailer The PHPMailer instance
 */
function configure_smtp_debug($phpmailer) {
    global $email_config;
    
    if (isset($email_config['debug']['enabled']) && $email_config['debug']['enabled']) {
        $phpmailer->SMTPDebug = isset($email_config['debug']['level']) 
            ? $email_config['debug']['level'] 
            : 0;
        
        $log_file = isset($email_config['debug']['log_file']) 
            ? $email_config['debug']['log_file'] 
            : WP_CONTENT_DIR . '/debug-smtp.log';
        
        $phpmailer->Debugoutput = function($str, $level) use ($log_file) {
            // Log to WordPress error log
            error_log("SMTP Debug ($level): $str");
            
            // Also log to file for easier debugging
            if (!empty($log_file)) {
                @file_put_contents($log_file, date('Y-m-d H:i:s') . " [$level] $str\n", FILE_APPEND);
            }
        };
    } else {
        $phpmailer->SMTPDebug = 0;
    }
}

/**
 * Get Contact Form Recipient Email
 * 
 * @return string The recipient email address
 */
function get_contact_form_recipient() {
    global $email_config;
    return isset($email_config['contact_form_recipient']) 
        ? $email_config['contact_form_recipient'] 
        : 'info@atpcgi.com';
}
