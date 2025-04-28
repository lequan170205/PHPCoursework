document.getElementById('module_name').addEventListener('input', function() {
    const module = this.value;
    const error = document.getElementById('module-error');
    error.textContent = module.length < 3 ? 'Module name must be at least 3 characters' : '';
});