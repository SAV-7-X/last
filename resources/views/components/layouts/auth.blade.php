<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Luxury Furniture</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap">
    <style>
        :root {
            --primary: #C8A97E;
            --primary-dark: #B69660;
            --secondary: #4A6B8A;
            --light: #F8F9FA;
            --dark: #343A40;
            --gray-light: #E9ECEF;
            --gray: #ADB5BD;
        }

        body {
            background-color: var(--light);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--dark);
            /* overflow: hidden; */
            background-image: linear-gradient(to right bottom, rgba(248, 249, 250, 0.8), rgba(233, 236, 239, 0.9)), url('/api/placeholder/1400/900');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .login-container {
            max-width: 1200px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        .login-img-container {
            padding: 0;
            position: relative;
            min-height: 100%;
            overflow: hidden;
        }

        .login-img {
            object-fit: cover;
            height: 100%;
            width: 100%;
            transition: all 1.2s ease;
        }
        
        .login-img:hover {
            transform: scale(1.05);
        }

        .login-form-container {
            background-color: white;
            padding: 3.5rem 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .pattern-overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-image: radial-gradient(var(--gray-light) 2px, transparent 2px);
            background-size: 25px 25px;
            opacity: 0.3;
            z-index: 0;
        }

        .form-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            margin-bottom: 0.5rem;
            letter-spacing: 0.5px;
            position: relative;
            z-index: 1;
            color: var(--dark);
        }

        .accent-text {
            color: var(--primary);
        }

        .form-floating {
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 1;
        }

        .form-floating > .form-control {
            border: 1px solid var(--gray-light);
            color: var(--dark);
            border-radius: 8px;
            height: 60px;
            padding-left: 20px;
        }

        .form-floating > .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.15rem rgba(200, 169, 126, 0.25);
        }

        .form-floating > label {
            padding-left: 20px;
            color: var(--gray);
        }

        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            color: var(--primary);
            transform: scale(0.85) translateY(-0.75rem) translateX(0.15rem);
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary {
            background-color: var(--primary);
            border: none;
            font-weight: 600;
            letter-spacing: 1px;
            padding: 0.9rem 2rem;
            position: relative;
            z-index: 1;
            transition: all 0.3s ease;
            border-radius: 8px;
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(200, 169, 126, 0.3);
        }

        .btn-primary:active {
            transform: translateY(-1px);
            box-shadow: 0 5px 10px rgba(200, 169, 126, 0.3);
        }

        .social-login {
            margin-top: 2rem;
            position: relative;
            z-index: 1;
        }

        .social-btn {
            background-color: white;
            border: 1px solid var(--gray-light);
            color: var(--dark);
            width: 46px;
            height: 46px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 0.5rem;
            transition: all 0.3s ease;
        }

        .social-btn:hover {
            background-color: var(--primary);
            color: white;
            transform: translateY(-3px);
            border-color: var(--primary);
        }

        .divider {
            color: var(--gray);
            margin: 2rem 0;
            position: relative;
            z-index: 1;
        }

        .divider::before,
        .divider::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 45%;
            height: 1px;
            background-color: var(--gray-light);
        }

        .divider::before {
            left: 0;
        }

        .divider::after {
            right: 0;
        }

        .divider-text {
            background-color: white;
            padding: 0 15px;
            position: relative;
            font-size: 0.8rem;
            letter-spacing: 1px;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            color: var(--gray);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .password-toggle:hover {
            color: var(--primary);
        }

        .password-wrapper {
            position: relative;
        }

        .form-footer {
            margin-top: 2rem;
            text-align: center;
            position: relative;
            z-index: 1;
            font-size: 0.95rem;
        }

        .form-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .form-footer a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .login-animation {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.5s forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Add staggered animations to form elements */
        .form-title {
            animation-delay: 0.2s;
        }

        .form-subtitle {
            animation-delay: 0.4s;
        }

        #email {
            animation-delay: 0.6s;
        }

        #password {
            animation-delay: 0.8s;
        }

        .form-check, .forgot-password {
            animation-delay: 1s;
        }

        .btn-primary {
            animation-delay: 1.2s;
        }

        .divider {
            animation-delay: 1.4s;
        }

        .social-login {
            animation-delay: 1.6s;
        }

        .form-footer {
            animation-delay: 1.8s;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(200, 169, 126, 0.8) 0%, rgba(74, 107, 138, 0.8) 100%);
            mix-blend-mode: multiply;
            opacity: 0.3;
            transition: opacity 0.3s ease;
        }

        .login-img-container:hover .image-overlay {
            opacity: 0.5;
        }

        .img-text-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            padding: 2rem;
            width: 100%;
            z-index: 2;
            background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 100%);
        }

        .img-text-overlay h3 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: white;
            margin-bottom: 0.5rem;
        }

        .badge-premium {
            background-color: var(--primary);
            color: white;
            font-size: 0.7rem;
            padding: 0.35rem 0.7rem;
            border-radius: 4px;
            margin-right: 0.5rem;
            letter-spacing: 0.5px;
            font-weight: 600;
            display: inline-block;
            transform: translateY(-1px);
        }

        .invalid-feedback {
            font-size: 0.8rem;
            font-weight: 500;
        }

        /* Responsive styles */
        @media (max-width: 991.98px) {
            .login-img-container {
                height: 300px;
            }
        }

        @media (max-width: 767.98px) {
            .login-container {
                margin: 1rem;
            }
            
            .login-form-container {
                padding: 2rem 1.5rem;
            }
        }

        /* Toast styling */
        .toast {
            background-color: white;
            border-left: 4px solid var(--primary);
        }

        .toast-header {
            background-color: white;
            color: var(--dark);
            border-bottom: 1px solid var(--gray-light);
        }

        .toast-body {
            color: var(--dark);
        }
    </style>
</head>
<body>
  {{$slot}}
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password visibility toggle
            const passwordToggle = document.getElementById('passwordToggle');
            const passwordInput = document.getElementById('password');
            
            passwordToggle.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Toggle icon
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
            
            // Form validation
            const loginForm = document.getElementById('loginForm');
            
            loginForm.addEventListener('submit', function(event) {
                event.preventDefault();
                
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                let isValid = true;
                
                // Simple validation
                if (!email) {
                    showError('email', 'Email is required');
                    isValid = false;
                } else if (!isValidEmail(email)) {
                    showError('email', 'Please enter a valid email');
                    isValid = false;
                } else {
                    clearError('email');
                }
                
                if (!password) {
                    showError('password', 'Password is required');
                    isValid = false;
                } else {
                    clearError('password');
                }
                
                if (isValid) {
                    // In a real application, this would be where you'd handle the form submission
                    // For now, let's simulate a successful login
                    const button = document.querySelector('.btn-primary');
                    const originalText = button.innerHTML;
                    
                    button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Signing in...';
                    button.disabled = true;
                    
                    setTimeout(() => {
                        showNotification('Success! Logging you in...');
                        
                        setTimeout(() => {
                            button.innerHTML = originalText;
                            button.disabled = false;
                        }, 2000);
                    }, 1500);
                }
            });
            
            function isValidEmail(email) {
                const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(String(email).toLowerCase());
            }
            
            function showError(inputId, message) {
                const input = document.getElementById(inputId);
                let errorDiv = input.parentElement.querySelector('.invalid-feedback');
                
                input.classList.add('is-invalid');
                
                if (!errorDiv) {
                    errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback';
                    input.parentElement.appendChild(errorDiv);
                }
                
                errorDiv.textContent = message;
            }
            
            function clearError(inputId) {
                const input = document.getElementById(inputId);
                input.classList.remove('is-invalid');
            }
            
            function showNotification(message) {
                // Create notification element
                const notification = document.createElement('div');
                notification.className = 'position-fixed bottom-0 end-0 p-3';
                notification.style.zIndex = '5';
                
                notification.innerHTML = `
                    <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <i class="fas fa-check-circle me-2 text-success"></i>
                            <strong class="me-auto">Notification</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            ${message}
                        </div>
                    </div>
                `;
                
                document.body.appendChild(notification);
                
                // Remove after 3 seconds
                setTimeout(() => {
                    notification.remove();
                }, 3000);
            }
        });
    </script>
</body>
</html>