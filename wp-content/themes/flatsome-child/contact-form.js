(function() {
    'use strict';
    
    // Check if we're on the contact page
    const isContactPage = document.querySelector('.contact-page-wrapper') !== null;
    
    // ============================================
    // SHARED VALIDATION AND SUBMISSION LOGIC
    // ============================================
    
    /**
     * Validates a single form field
     * @param {HTMLElement} field - The input field to validate
     * @returns {Object} - { isValid: boolean, error: string }
     */
    function validateField(field) {
        const value = field.value.trim();
        const type = field.type;
        const name = field.name;
        const required = field.hasAttribute('required');
        
        // Check if required field is empty
        if (required && !value) {
            return {
                isValid: false,
                error: 'This field is required'
            };
        }
        
        // Email validation
        if (type === 'email' && value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                return {
                    isValid: false,
                    error: 'Please enter a valid email address'
                };
            }
        }
        
        // Phone validation (basic)
        if (type === 'tel' && value && required) {
            const phoneRegex = /^[\d\s\-\+\(\)]+$/;
            if (!phoneRegex.test(value)) {
                return {
                    isValid: false,
                    error: 'Please enter a valid phone number'
                };
            }
        }
        
        return { isValid: true, error: '' };
    }
    
    /**
     * Validates entire form
     * @param {HTMLFormElement} form - The form to validate
     * @returns {Object} - { isValid: boolean, errors: Array }
     */
    function validateForm(form) {
        const errors = [];
        const fields = form.querySelectorAll('input[required], textarea[required]');
        let isValid = true;
        
        fields.forEach(field => {
            const validation = validateField(field);
            if (!validation.isValid) {
                isValid = false;
                errors.push({
                    field: field,
                    error: validation.error
                });
            }
        });
        
        // Also check message textarea (might not have required attribute but should be required)
        const messageField = form.querySelector('textarea[name="message"]');
        if (messageField && !messageField.value.trim()) {
            isValid = false;
            errors.push({
                field: messageField,
                error: 'This field is required'
            });
        }
        
        return { isValid, errors };
    }
    
    /**
     * Updates submit button state based on form validity
     * @param {HTMLFormElement} form - The form to check
     */
    function updateSubmitButtonState(form) {
        const submitBtn = form.querySelector('.contact-form-submit');
        if (!submitBtn) return;
        
        const requiredFields = form.querySelectorAll('input[required], textarea[required]');
        const messageField = form.querySelector('textarea[name="message"]');
        let allFilled = true;
        
        // Check all required fields
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                allFilled = false;
            }
        });
        
        // Check message field (always required)
        if (messageField && !messageField.value.trim()) {
            allFilled = false;
        }
        
        // Validate form if all fields are filled
        if (allFilled) {
            const validation = validateForm(form);
            submitBtn.disabled = !validation.isValid;
        } else {
            submitBtn.disabled = true;
        }
    }
    
    /**
     * Shows a message to the user
     * @param {HTMLElement} form - The form element
     * @param {string} message - The message to show
     * @param {string} type - 'success' or 'error'
     */
    function showMessage(form, message, type) {
        // Remove existing messages
        const existingMessage = form.querySelector('.contact-form-message');
        if (existingMessage) {
            existingMessage.remove();
        }
        
        // Create message element
        const messageEl = document.createElement('div');
        messageEl.className = `contact-form-message contact-form-message-${type}`;
        messageEl.textContent = message;
        
        // Insert before submit button
        const submitBtn = form.querySelector('.contact-form-submit');
        if (submitBtn) {
            submitBtn.parentNode.insertBefore(messageEl, submitBtn);
        } else {
            form.appendChild(messageEl);
        }
        
        // Scroll to message if needed
        messageEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        
        // Auto-remove success messages after 5 seconds
        if (type === 'success') {
            setTimeout(() => {
                if (messageEl.parentNode) {
                    messageEl.remove();
                }
            }, 5000);
        }
    }
    
    /**
     * Shared form submission handler
     * @param {Event} e - The submit event
     * @param {HTMLFormElement} form - The form being submitted
     * @param {Function} onSuccess - Optional callback on success
     */
    function handleFormSubmit(e, form, onSuccess) {
        e.preventDefault();
        
        // Validate form
        const validation = validateForm(form);
        if (!validation.isValid) {
            showMessage(form, 'Please fill in all required fields correctly.', 'error');
            // Focus first invalid field
            if (validation.errors.length > 0) {
                validation.errors[0].field.focus();
            }
            return;
        }
        
        const submitBtn = form.querySelector('.contact-form-submit');
        const originalText = submitBtn ? submitBtn.textContent : 'Submit';
        
        // Show loading state
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Submitting...';
            submitBtn.classList.add('is-loading');
        }
        
        // Remove any existing messages
        const existingMessage = form.querySelector('.contact-form-message');
        if (existingMessage) {
            existingMessage.remove();
        }
        
        // Get form data
        const formData = new FormData(form);
        formData.append('action', 'submit_contact_form');
        
        // Send to WordPress AJAX handler
        const ajaxUrl = contactFormAjax && contactFormAjax.ajaxurl ? contactFormAjax.ajaxurl : '/wp-admin/admin-ajax.php';
        
        fetch(ajaxUrl, {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        })
        .then(response => {
            // Check if response is ok
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.status);
            }
            // Try to parse JSON
            return response.text().then(text => {
                try {
                    return JSON.parse(text);
                } catch (e) {
                    console.error('Response was not valid JSON:', text);
                    throw new Error('Invalid response from server');
                }
            });
        })
        .then(data => {
            if (data && data.success) {
                showMessage(form, data.message || 'Thank you! Your message has been sent.', 'success');
                form.reset();
                
                // Reset reCAPTCHA if present
                if (typeof grecaptcha !== 'undefined') {
                    grecaptcha.reset();
                }
                
                // Call success callback (e.g., close modal)
                if (onSuccess && typeof onSuccess === 'function') {
                    onSuccess();
                }
                
                // Update submit button state
                updateSubmitButtonState(form);
            } else {
                const errorMsg = (data && data.data && data.data.message) ? data.data.message : 
                                (data && data.message) ? data.message : 
                                'There was an error. Please try again.';
                showMessage(form, errorMsg, 'error');
            }
            
            // Reset button state
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
                submitBtn.classList.remove('is-loading');
            }
        })
        .catch(error => {
            console.error('Form submission error:', error);
            console.error('AJAX URL:', ajaxUrl);
            showMessage(form, 'There was an error connecting to the server. Please check your connection and try again.', 'error');
            
            // Reset button state
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
                submitBtn.classList.remove('is-loading');
            }
            
            // Reset reCAPTCHA if present
            if (typeof grecaptcha !== 'undefined') {
                grecaptcha.reset();
            }
        });
    }
    
    // ============================================
    // CONTACT PAGE FORM INITIALIZATION
    // ============================================
    
    function initializeContactPageForm() {
        const pageForm = document.getElementById('contact-form');
        if (!pageForm) return;
        
        // Make message field required
        const messageField = pageForm.querySelector('textarea[name="message"]');
        if (messageField && !messageField.hasAttribute('required')) {
            messageField.setAttribute('required', 'required');
        }
        
        // Add real-time validation
        const fields = pageForm.querySelectorAll('input, textarea');
        fields.forEach(field => {
            field.addEventListener('input', () => {
                updateSubmitButtonState(pageForm);
            });
            
            field.addEventListener('blur', () => {
                const validation = validateField(field);
                if (!validation.isValid) {
                    field.classList.add('has-error');
                } else {
                    field.classList.remove('has-error');
                }
            });
        });
        
        // Initial button state
        updateSubmitButtonState(pageForm);
        
        // Form submission
        pageForm.addEventListener('submit', (e) => {
            handleFormSubmit(e, pageForm);
        });
        
        // Check if reCAPTCHA is loaded and configure it
        if (typeof grecaptcha !== 'undefined' && window.contactFormRecaptchaKey) {
            const recaptchaContainer = document.getElementById('recaptcha-container');
            if (recaptchaContainer) {
                const recaptchaDiv = recaptchaContainer.querySelector('.g-recaptcha');
                if (recaptchaDiv && window.contactFormRecaptchaKey !== 'YOUR_RECAPTCHA_SITE_KEY') {
                    recaptchaDiv.setAttribute('data-sitekey', window.contactFormRecaptchaKey);
                }
            }
        }
    }
    
    // ============================================
    // FLOATING FORM FUNCTIONALITY
    // ============================================
    
    function createTriggerButton() {
        // Only create if not on contact page
        if (isContactPage) return;
        
        const trigger = document.createElement('div');
        trigger.className = 'contact-form-trigger';
        trigger.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/>
                <path d="M7 9h2v2H7zm4 0h2v2h-2zm4 0h2v2h-2z"/>
            </svg>
            <span class="contact-form-trigger-text">Start a project</span>
        `;
        document.body.appendChild(trigger);
        
        trigger.addEventListener('click', function() {
            const overlay = document.getElementById('contact-form-overlay');
            if (overlay) {
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        });
    }
    
    function createContactForm() {
        // Only create if not on contact page
        if (isContactPage) return;
        
        const overlay = document.createElement('div');
        overlay.id = 'contact-form-overlay';
        overlay.className = 'contact-form-overlay';
        overlay.innerHTML = `
            <div class="contact-form-container">
                <button class="contact-form-close" aria-label="Close">×</button>
                <h2 class="contact-form-title">Start a project</h2>
                <form id="contact-form-floating" method="POST" action="" class="contact-form">
                    <div class="contact-form-group">
                        <label class="contact-form-label">Name</label>
                        <input type="text" name="name" class="contact-form-input" placeholder="Name" required>
                    </div>
                    
                    <div class="contact-form-group">
                        <label class="contact-form-label">Email</label>
                        <input type="email" name="email" class="contact-form-input" placeholder="Email" required>
                    </div>
                    
                    <div class="contact-form-group">
                        <label class="contact-form-label">Company</label>
                        <input type="text" name="company" class="contact-form-input" placeholder="Company" required>
                    </div>
                    
                    <div class="contact-form-group">
                        <label class="contact-form-label">Phone</label>
                        <input type="tel" name="phone" class="contact-form-input" placeholder="Phone" required>
                    </div>
                    
                    <div class="contact-form-interests">
                        <label class="contact-form-interests-label">I am interested in...</label>
                        <div class="contact-form-checkboxes">
                            <div class="contact-form-checkbox-group">
                                <input type="checkbox" id="interest-float-1" name="interests[]" value="Architectural renders" class="contact-form-checkbox">
                                <label for="interest-float-1" class="contact-form-checkbox-label">Architectural renders</label>
                            </div>
                            <div class="contact-form-checkbox-group">
                                <input type="checkbox" id="interest-float-2" name="interests[]" value="CGI animation" class="contact-form-checkbox">
                                <label for="interest-float-2" class="contact-form-checkbox-label">CGI animation</label>
                            </div>
                            <div class="contact-form-checkbox-group">
                                <input type="checkbox" id="interest-float-3" name="interests[]" value="Film" class="contact-form-checkbox">
                                <label for="interest-float-3" class="contact-form-checkbox-label">Film</label>
                            </div>
                            <div class="contact-form-checkbox-group">
                                <input type="checkbox" id="interest-float-4" name="interests[]" value="Virtual reality" class="contact-form-checkbox">
                                <label for="interest-float-4" class="contact-form-checkbox-label">Virtual reality</label>
                            </div>
                            <div class="contact-form-checkbox-group">
                                <input type="checkbox" id="interest-float-5" name="interests[]" value="3D product renders" class="contact-form-checkbox">
                                <label for="interest-float-5" class="contact-form-checkbox-label">3D product renders</label>
                            </div>
                            <div class="contact-form-checkbox-group">
                                <input type="checkbox" id="interest-float-6" name="interests[]" value="Interior styling" class="contact-form-checkbox">
                                <label for="interest-float-6" class="contact-form-checkbox-label">Interior styling</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-form-group">
                        <label class="contact-form-label">Your message</label>
                        <textarea name="message" class="contact-form-textarea" placeholder="Your message" required></textarea>
                    </div>
                    
                    <p class="contact-form-privacy">By clicking Submit, you agree to our <a href="#" target="_blank">privacy policy</a>.</p>
                    
                    <div class="contact-form-recaptcha" id="recaptcha-container-float" style="display: none;">
                        <div class="g-recaptcha" data-sitekey=""></div>
                    </div>
                    
                    <button type="submit" class="contact-form-submit" disabled>Submit</button>
                    <div style="clear: both;"></div>
                </form>
            </div>
        `;
        document.body.appendChild(overlay);
        
        // Close button functionality
        const closeBtn = overlay.querySelector('.contact-form-close');
        closeBtn.addEventListener('click', closeForm);
        
        // Close on overlay click (outside form)
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) {
                closeForm();
            }
        });
        
        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && overlay.classList.contains('active')) {
                closeForm();
            }
        });
        
        // Initialize floating form
        const floatingForm = document.getElementById('contact-form-floating');
        if (floatingForm) {
            // Add real-time validation
            const fields = floatingForm.querySelectorAll('input, textarea');
            fields.forEach(field => {
                field.addEventListener('input', () => {
                    updateSubmitButtonState(floatingForm);
                });
                
                field.addEventListener('blur', () => {
                    const validation = validateField(field);
                    if (!validation.isValid) {
                        field.classList.add('has-error');
                    } else {
                        field.classList.remove('has-error');
                    }
                });
            });
            
            // Initial button state
            updateSubmitButtonState(floatingForm);
            
            // Form submission
            floatingForm.addEventListener('submit', (e) => {
                handleFormSubmit(e, floatingForm, closeForm);
            });
            
            // Check if reCAPTCHA is loaded and configure it
            if (typeof grecaptcha !== 'undefined' && window.contactFormRecaptchaKey) {
                const recaptchaContainer = document.getElementById('recaptcha-container-float');
                if (recaptchaContainer) {
                    const recaptchaDiv = recaptchaContainer.querySelector('.g-recaptcha');
                    if (recaptchaDiv && window.contactFormRecaptchaKey !== 'YOUR_RECAPTCHA_SITE_KEY') {
                        recaptchaDiv.setAttribute('data-sitekey', window.contactFormRecaptchaKey);
                        recaptchaContainer.style.display = 'block';
                    }
                }
            }
        }
    }
    
    function closeForm() {
        const overlay = document.getElementById('contact-form-overlay');
        if (overlay) {
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    }
    
    // ============================================
    // INITIALIZATION
    // ============================================
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            if (isContactPage) {
                initializeContactPageForm();
            } else {
                createTriggerButton();
                createContactForm();
            }
        });
    } else {
        if (isContactPage) {
            initializeContactPageForm();
        } else {
            createTriggerButton();
            createContactForm();
        }
    }
})();
