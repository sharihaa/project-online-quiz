function redirectToVerification() {
    // Get user email and password from the form
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    // Save to localStorage (for demo only)
    localStorage.setItem("userEmail", email);
    localStorage.setItem("userPassword", password);

    alert("Registration successful! Redirecting to email verification...");

    // Redirect to verification page
    window.location.href = "email_verification.html";
}

function validateForm() {
    const errors = [];

    // Retrieve form inputs
    const id = document.getElementById("id").value.trim();
    const fname = document.getElementById("fname").value.trim();
    const lname = document.getElementById("lname").value.trim();
    const departments = document.querySelectorAll('input[name="department"]:checked');
    const dob = document.getElementById("dob").value.trim();
    const gender = document.querySelector('input[name="gender"]:checked');
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();
    const skills = document.getElementById("skills").value.trim();
    const address = document.getElementById("address").value.trim();

    // Validate required fields
    if (!id) errors.push("ID is required.");
    if (!fname) errors.push("First name is required.");
    if (!lname) errors.push("Last name is required.");
    if (departments.length === 0) errors.push("At least one department must be selected.");
    if (!dob) errors.push("Date of birth is required.");
    if (!gender) errors.push("Gender is required.");
    if (!email || !validateEmail(email)) errors.push("A valid email is required.");
    if (!password) errors.push("Password is required.");
    if (!skills) errors.push("Skills are required.");
    if (!address) errors.push("Address is required.");

    // Display errors or submit the form
    if (errors.length > 0) {
        alert("Validation Errors:\n" + errors.join("\n"));
        return false; // Prevent form submission
    }

    alert("Form submitted successfully!");
    return true; // Allow form submission
}

// Helper function to validate email format
function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}