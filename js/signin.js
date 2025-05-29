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
    const role = document.getElementById("role").value.trim();
    const fname = document.getElementById("fname").value.trim();
    const lname = document.getElementById("lname").value.trim();
    const username = document.getElementById("username").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();
    const dob = document.getElementById("dob").value.trim();
    const school = document.getElementById("school").value.trim();

    // Validate required fields
    if (!role) errors.push("Role is required.");
    if (!fname) errors.push("First name is required.");
    if (!lname) errors.push("Last name is required.");
    if (!username) errors.push("Username is required.");
    if (!email || !validateEmail(email)) errors.push("A valid email is required.");
   if (!password || !validatePassword(password)) {
    errors.push("Password must be at least 8 characters long, include a lowercase letter, an uppercase letter, and a number.");
    }

    if (!dob || !isAdult(dob)) {
    errors.push("You must be at least 18 years old.");
    }
    if (!school) errors.push("School or Institution Name is required.");

    // Display errors or submit the form
    if (errors.length > 0) {
        alert("Validation Errors:\n" + errors.join("\n"));
        return false; // Prevent form submission
    }

    return true; // Allow form submission
}

// Helper function to validate email format
function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}
function validatePassword(password) {
    // At least 8 characters, 1 uppercase, 1 lowercase, 1 digit
    const re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
    return re.test(password);
}

function isAdult(dob) {
    const birthDate = new Date(dob);
    const today = new Date();
    const age = today.getFullYear() - birthDate.getFullYear();
    const m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        return age - 1 >= 18;
    }
    return age >= 18;
}