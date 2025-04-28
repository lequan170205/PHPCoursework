document.getElementById('email').addEventListener('input', function() {
    const email = this.value;
    const error = document.getElementById('email-error');
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    error.textContent = regex.test(email) ? '' : 'Invalid email format';
});