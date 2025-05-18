document.addEventListener('DOMContentLoaded', function () {
    const editBtn = document.getElementById('editBtn');
    const saveBtn = document.getElementById('saveBtn');
    const inputs = document.querySelectorAll('.profile-details input, .profile-details textarea');

    editBtn.addEventListener('click', () => {
        inputs.forEach(input => input.disabled = false);
        saveBtn.style.display = 'inline-block';
    });
});
