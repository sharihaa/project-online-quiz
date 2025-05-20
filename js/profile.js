document.addEventListener('DOMContentLoaded', function () {
    const editBtn = document.getElementById('editBtn');
    const saveBtn = document.getElementById('saveBtn');
    const inputs = document.querySelectorAll('.profile-details input, .profile-details textarea');
    const uploadForm = document.querySelector('.upload-form');

    editBtn.addEventListener('click', () => {
        inputs.forEach(input => input.disabled = false);
        saveBtn.style.display = 'inline-block';
        if (uploadForm) uploadForm.style.display = 'block';
    });
});
