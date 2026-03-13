<?php
/**
 * Template Name: Contact Page
 * The template for displaying the contact page.
 *
 * @package Flatsome Child
 */

get_header();
do_action('flatsome_before_page');
?>

<style>
    body {
        background-color: #2a2a2a !important;
    }
    html {
        scroll-behavior: smooth;
    }
</style>

<div id="content" class="content-area contact-page-wrapper" role="main">
    <div class="contact-page-container">
        <div class="contact-page-content">
            <!-- Left Section: Contact Information -->
            <div class="contact-info-section">
                <div class="contact-info-group">
                    <h3 class="contact-section-heading">GENERAL ENQUIRIES</h3>
                    <p class="contact-info-text">
                        <a href="https://wa.me/840386016979" target="_blank" rel="noopener">whatapp : +840386016979</a>
                    </p>
                </div>
                
                <div class="contact-info-group">
                    <h3 class="contact-section-heading">NEW PROJECTS</h3>
                    <p class="contact-info-text">
                        <a href="mailto:info@atpcgi.com">info@atpcgi.com</a>
                    </p>
                </div>
            </div>
            
            <!-- Right Section: Contact Form -->
            <div class="contact-form-section" id="contact-form-section">
                <h2 class="contact-form-heading">NEW PROJECT ENQUIRIES</h2>
                
                <form id="contact-form" method="POST" action="" class="contact-form">
                    <?php wp_nonce_field('contact_form_submit', 'contact_form_nonce'); ?>
                    <div class="contact-form-group">
                        <input type="text" name="name" class="contact-form-input" placeholder="Name" required>
                    </div>
                    
                    <div class="contact-form-group">
                        <input type="email" name="email" class="contact-form-input" placeholder="Email" required>
                    </div>
                    
                    <div class="contact-form-group">
                        <input type="text" name="company" class="contact-form-input" placeholder="Company" required>
                    </div>
                    
                    <div class="contact-form-group">
                        <input type="tel" name="phone" class="contact-form-input" placeholder="Phone" required>
                    </div>
                    
                    <div class="contact-form-interests">
                        <label class="contact-form-interests-label">I am interested in...</label>
                        <div class="contact-form-checkboxes">
                            <!-- Left Column -->
                            <div class="contact-form-checkbox-group">
                                <input type="checkbox" id="interest-1" name="interests[]" value="Architectural renders" class="contact-form-checkbox">
                                <label for="interest-1" class="contact-form-checkbox-label">Architectural renders</label>
                            </div>
                            <div class="contact-form-checkbox-group">
                                <input type="checkbox" id="interest-3" name="interests[]" value="Film" class="contact-form-checkbox">
                                <label for="interest-3" class="contact-form-checkbox-label">Film</label>
                            </div>
                            <div class="contact-form-checkbox-group">
                                <input type="checkbox" id="interest-5" name="interests[]" value="3D product renders" class="contact-form-checkbox">
                                <label for="interest-5" class="contact-form-checkbox-label">3D product renders</label>
                            </div>
                            <!-- Right Column -->
                            <div class="contact-form-checkbox-group">
                                <input type="checkbox" id="interest-2" name="interests[]" value="CGI animation" class="contact-form-checkbox">
                                <label for="interest-2" class="contact-form-checkbox-label">CGI animation</label>
                            </div>
                            <div class="contact-form-checkbox-group">
                                <input type="checkbox" id="interest-4" name="interests[]" value="Virtual reality" class="contact-form-checkbox">
                                <label for="interest-4" class="contact-form-checkbox-label">Virtual reality</label>
                            </div>
                            <div class="contact-form-checkbox-group">
                                <input type="checkbox" id="interest-6" name="interests[]" value="Interior styling" class="contact-form-checkbox">
                                <label for="interest-6" class="contact-form-checkbox-label">Interior styling</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-form-group">
                        <textarea name="message" class="contact-form-textarea" placeholder="Your message" required></textarea>
                    </div>
                    
                    <p class="contact-form-privacy">By clicking Submit, you agree to our privacy policy.</p>
                    
                    <div class="contact-form-recaptcha" id="recaptcha-container">
                        <div class="g-recaptcha" data-sitekey=""></div>
                    </div>
                    
                    <button type="submit" class="contact-form-submit" disabled>Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
do_action('flatsome_after_page');
get_footer();
?>
