document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('clave');
    const togglePassword = document.querySelector('.toggle-password');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Toggle eye icon
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
});