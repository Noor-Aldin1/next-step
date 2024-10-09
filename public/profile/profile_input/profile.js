// Profile Edit Functionality
document.getElementById("edit-button").addEventListener("click", function () {
    // Enable all inputs in the form
    const inputs = document.querySelectorAll(
        ".profile-form input, .profile-form textarea"
    );
    inputs.forEach(function (input) {
        input.disabled = false; // Enable inputs for editing
    });

    // Enable the Save button
    const saveButton = document.querySelector('button[type="submit"]');
    saveButton.disabled = false; // Enable save button
    saveButton.style.backgroundColor = ""; // Reset button style (optional)

    // Hide the Edit button after clicking
    this.style.display = "none";
});

// Validation for the profile form
document
    .querySelector(".profile-form")
    .addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent the form from submitting initially

        // Get form values
        const fullName = document
            .querySelector('input[name="full_name"]')
            .value.trim();
        const email = document
            .querySelector('input[name="email"]')
            .value.trim();
        const phone = document
            .querySelector('input[name="phone"]')
            .value.trim();
        const university = document
            .querySelector('input[name="university"]')
            .value.trim();
        const major = document
            .querySelector('input[name="major"]')
            .value.trim();
        const gap = document.querySelector('input[name="gap"]').value.trim();
        const age = document.querySelector('input[name="age"]').value.trim();
        const gender = document
            .querySelector('input[name="gender"]')
            .value.trim();
        const aboutMe = document
            .querySelector('textarea[name="about_me"]')
            .value.trim();
        const language = document
            .querySelector('input[name="language"]')
            .value.trim();
        const country = document
            .querySelector('input[name="country"]')
            .value.trim();
        const city = document.querySelector('input[name="city"]').value.trim();
        const linkedIn = document
            .querySelector('input[name="linkedin"]')
            .value.trim();
        const github = document
            .querySelector('input[name="github"]')
            .value.trim();

        // Validation using SweetAlert2
        if (!validateField(fullName, "Full Name", 3)) return;
        if (!validateEmailField(email)) return;
        if (!validatePhoneField(phone)) return;
        if (!validateField(university, "University")) return;
        if (!validateField(major, "Major")) return;
        if (!validateGPA(gap)) return;
        if (!validateAge(age)) return; // Modified for age validation
        if (!validateGender(gender)) return; // Added gender validation
        if (!validateAboutMe(aboutMe)) return;
        if (!validateField(language, "Language")) return;
        if (!validateField(country, "Country")) return;
        if (!validateField(city, "City")) return;

        // Optional validations for LinkedIn and GitHub
        if (linkedIn && !validateURL(linkedIn, "linkedin.com")) {
            Swal.fire(
                "Validation Error",
                "Please enter a valid LinkedIn URL.",
                "error"
            );
            return;
        }

        if (github && !validateURL(github, "github.com")) {
            Swal.fire(
                "Validation Error",
                "Please enter a valid GitHub URL.",
                "error"
            );
            return;
        }

        // If validation passes, submit the form
        Swal.fire({
            title: "Success!",
            text: "All data is valid and the form will be submitted.",
            icon: "success",
            confirmButtonText: "OK",
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit(); // Submit the form after confirmation
            }
        });
    });

// Function to validate general text fields
function validateField(value, fieldName, minLength = 1) {
    if (!value) {
        Swal.fire("Validation Error", `${fieldName} is required.`, "error");
        return false;
    }
    if (value.length < minLength) {
        Swal.fire(
            "Validation Error",
            `${fieldName} must be at least ${minLength} characters long.`,
            "error"
        );
        return false;
    }
    return true;
}

// Function to validate email field
function validateEmailField(email) {
    if (!email) {
        Swal.fire("Validation Error", "Email is required.", "error");
        return false;
    } else if (!validateEmail(email)) {
        Swal.fire(
            "Validation Error",
            "Please enter a valid email address.",
            "error"
        );
        return false;
    }
    return true;
}

// Function to validate phone field
function validatePhoneField(phone) {
    if (!phone) {
        Swal.fire("Validation Error", "Phone number is required.", "error");
        return false;
    } else if (!validatePhone(phone)) {
        Swal.fire(
            "Validation Error",
            "Please enter a valid phone number.",
            "error"
        );
        return false;
    }
    return true;
}

// Function to validate GPA
function validateGPA(gap) {
    if (!gap) {
        Swal.fire("Validation Error", "GPA is required.", "error");
        return false;
    } else if (
        isNaN(gap) &&
        !["good", "very good", "excellent", "acceptable"].includes(
            gap.toLowerCase()
        )
    ) {
        Swal.fire(
            "Validation Error",
            'GPA should be either a number or a grade like "Good", "Very Good", "Excellent", or "Acceptable".',
            "error"
        );
        return false;
    }
    return true;
}

// Function to validate age
function validateAge(age) {
    if (!age) {
        Swal.fire("Validation Error", "Age is required.", "error");
        return false;
    } else if (isNaN(age) || age < 18) {
        // Updated to check if age is below 18
        Swal.fire(
            "Validation Error",
            "You must be at least 18 years old.",
            "error"
        );
        return false;
    }
    return true;
}

// Function to validate gender
function validateGender(gender) {
    const validGenders = ["male", "female"]; // Array of accepted gender values
    if (!gender) {
        Swal.fire("Validation Error", "Gender is required.", "error");
        return false;
    } else if (!validGenders.includes(gender.toLowerCase())) {
        Swal.fire(
            "Validation Error",
            'Gender must be either "Male" or "Female".',
            "error"
        );
        return false;
    }
    return true;
}

// Function to validate 'About Me' section
function validateAboutMe(aboutMe) {
    if (!aboutMe) {
        Swal.fire("Validation Error", "About Me section is required.", "error");
        return false;
    } else if (aboutMe.length > 500) {
        Swal.fire(
            "Validation Error",
            "About Me must be less than 500 characters.",
            "error"
        );
        return false;
    }
    return true;
}

// Function to validate email format
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(String(email).toLowerCase());
}

// Function to validate phone number
function validatePhone(phone) {
    const re = /^[0-9\-\+]{9,15}$/;
    return re.test(phone);
}

// Function to validate URL for LinkedIn and GitHub
function validateURL(url, domain) {
    const re = new RegExp(
        "^(https?:\\/\\/)?(www\\.)?" + domain + "/[A-Za-z0-9_-]+$",
        "i"
    );
    return re.test(url);
}
