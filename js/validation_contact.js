document.getElementById('name').addEventListener('input', function() {
    const name = this.value;
    const error = document.getElementById('name-error');
    error.textContent = name.length < 2 ? 'Name must be at least 2 characters' : '';
});
document.getElementById('email').addEventListener('input', function() {
    const email = this.value;
    const error = document.getElementById('email-error');
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    error.textContent = regex.test(email) ? '' : 'Invalid email format';
});
document.getElementById('message').addEventListener('input', function() {
    const message = this.value;
    const error = document.getElementById('message-error');
    error.textContent = message.length < 10 ? 'Message must be at least 10 characters' : '';
});