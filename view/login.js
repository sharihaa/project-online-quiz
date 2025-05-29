document.getElementById('loginForm').addEventListener('submit', function (e) {
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();
    let errors = [];

    if (!username) errors.push("Username is required.");
    if (!password) errors.push("Password is required.");

    if (errors.length > 0) {
        alert(errors.join('\n'));
        e.preventDefault();
    }
});
