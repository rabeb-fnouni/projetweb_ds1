/**
 * ESSECT Clubs - Form Validation
 * Client-side validation for forms
 */

document.addEventListener('DOMContentLoaded', function() {
    // Form validation for login form
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', validateLoginForm);
    }

    // Form validation for registration form
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', validateRegisterForm);
    }
});

function validateLoginForm(event) {
    // Implement login form validation logic here
    // Example: Prevent submission if validation fails
    event.preventDefault();
    const email = document.getElementById('loginEmail');
    const password = document.getElementById('loginPassword');
    
    if (!email.value || !password.value) {
        alert('Veuillez remplir tous les champs.');
        return false;
    }
    return true;
}

function validateRegisterForm(event) {
    // Implement registration form validation logic here
    // Example: Prevent submission if validation fails
    event.preventDefault();
    const name = document.getElementById('name');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm_password');
    
    if (!name.value || !email.value || !password.value || !confirmPassword.value) {
        alert('Veuillez remplir tous les champs.');
        return false;
    }
    if (password.value !== confirmPassword.value) {
        alert('Les mots de passe ne correspondent pas.');
        return false;
    }
    return true;
}

    // Form validation for registration form