// Main Script File

document.addEventListener('DOMContentLoaded', function () {
    console.log('Quiz Management System Loaded');

    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function (alert) {
        setTimeout(function () {
            let bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });

    // Form Validation helper (Bootstrap)
    var forms = document.querySelectorAll('.needs-validation');
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
});
