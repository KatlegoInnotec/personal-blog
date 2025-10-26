// Auth page JS: toggles forms, validates inline, and shows messages
(function () {
    function showForm(formType, button) {
        document.querySelectorAll('.auth-forms .toggle-btn').forEach(btn => btn.classList.remove('active'));
        if (button) button.classList.add('active');

        const login = document.getElementById('loginForm');
        const register = document.getElementById('registerForm');
        if (formType === 'login') {
            login?.classList.add('active');
            register?.classList.remove('active');
        } else {
            register?.classList.add('active');
            login?.classList.remove('active');
        }

        hideAuthMessage();
    }

    window.authBlog = { showForm };

    document.addEventListener('DOMContentLoaded', function () {
        const forms = document.querySelectorAll('.auth-forms form');
        const fieldLabels = {
            email: 'Email',
            username: 'Username',
            name: 'Full name',
            password: 'Password',
            loginpassword: 'Password'
        };

        forms.forEach(form => {
            form.addEventListener('submit', function (e) {
                // Only validate client-side; if validation passes, allow native submission
                const inputs = this.querySelectorAll('input[required], textarea[required]');
                let valid = true;
                const errors = [];

                inputs.forEach(input => {
                    removeInlineError(input);
                    const rawName = input.name || input.id || 'field';
                    const label = fieldLabels[rawName] || (rawName.charAt(0).toUpperCase() + rawName.slice(1));
                    const value = input.value ? input.value.trim() : '';

                    if (!value) {
                        valid = false;
                        addInlineError(input, 'This field is required');
                        errors.push(label + ' is required');
                        return;
                    }

                    if (input.type === 'email') {
                        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!re.test(value)) {
                            valid = false;
                            addInlineError(input, 'Please enter a valid email');
                            errors.push(label + ' is not a valid email');
                            return;
                        }
                    }

                    if (rawName === 'password' || rawName === 'loginpassword') {
                        if (value.length < 6) {
                            valid = false;
                            addInlineError(input, 'Password must be at least 6 characters');
                            errors.push(label + ' is too short');
                            return;
                        }
                    }

                    input.style.borderColor = '#e2e8f0';
                });

                if (!valid) {
                    e.preventDefault();
                    showAuthMessage(errors.join('; '), 'error');
                } else {
                    // allow native submit to proceed so server can authenticate and redirect
                    showAuthMessage('Submitting...', 'success');
                }
            });
        });

        // Activate first toggle button if none active
        const activeBtn = document.querySelector('.auth-forms .toggle-btn.active') || document.querySelector('.auth-forms .toggle-btn');
        if (activeBtn) activeBtn.classList.add('active');

        // helper functions
        function addInlineError(input, msg) {
            removeInlineError(input);
            input.style.borderColor = '#e53e3e';
            const span = document.createElement('span');
            span.className = 'field-error';
            span.textContent = msg;
            input.parentNode.insertBefore(span, input.nextSibling);
        }

        function removeInlineError(input) {
            const next = input.nextElementSibling;
            if (next && next.classList && next.classList.contains('field-error')) next.remove();
        }

        function showAuthMessage(text, type) {
            const container = document.getElementById('authMessage');
            const box = document.getElementById('authMessageBox');
            if (!container || !box) return;
            box.textContent = text;
            box.classList.remove('success', 'error');
            if (type === 'success') box.classList.add('success');
            if (type === 'error') box.classList.add('error');
            container.hidden = false;
            clearTimeout(window._authMsgTimeout);
            window._authMsgTimeout = setTimeout(() => hideAuthMessage(), 3000);
        }

        function hideAuthMessage() {
            const container = document.getElementById('authMessage');
            if (container) container.hidden = true;
        }
    });
})();