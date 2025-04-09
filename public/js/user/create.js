/**
 * User Create Page JavaScript
 * Handles form interactions, field visibility, and UI feedback
 */

// Toggle store field visibility based on selected role
function setupRoleStoreToggle() {
    const roleSelect = document.getElementById("role");
    const storeField = document.getElementById("store_id");
    const storeContainer = storeField.closest(".col-md-6");

    function toggleStoreField() {
        if (roleSelect.value === "1") {
            storeField.removeAttribute("required");
            storeContainer.style.display = "none"; // Hide store field for admin
        } else {
            storeField.setAttribute("required", "required");
            storeContainer.style.display = "block"; // Show store field for regular users
        }
    }

    // Run on page load (to accommodate old() values if validation failed)
    toggleStoreField();

    // Run each time user changes the role
    roleSelect.addEventListener("change", toggleStoreField);
}

// Toggle password visibility
function setupPasswordToggle() {
    const togglePassword = document.getElementById("togglePassword");
    const passwordInput = document.getElementById("password");
    const toggleIcon = document.getElementById("toggleIcon");

    if (togglePassword) {
        togglePassword.addEventListener("click", function () {
            const type =
                passwordInput.getAttribute("type") === "password"
                    ? "text"
                    : "password";
            passwordInput.setAttribute("type", type);
            toggleIcon.classList.toggle("bi-eye");
            toggleIcon.classList.toggle("bi-eye-slash");
        });
    }
}

// Toggle email section visibility on mobile
function setupEmailSectionToggle() {
    const toggleEmailsBtn = document.getElementById("toggleEmailsBtn");
    const emailSection = document.getElementById("email-section");

    if (toggleEmailsBtn) {
        toggleEmailsBtn.addEventListener("click", function () {
            if (
                emailSection.style.display === "none" ||
                emailSection.style.display === ""
            ) {
                emailSection.style.display = "block";
                emailSection.classList.add("fade-in");
                toggleEmailsBtn.innerHTML =
                    '<i class="bi bi-eye-slash me-2"></i>Sembunyikan Email Terdaftar';
            } else {
                emailSection.style.display = "none";
                toggleEmailsBtn.innerHTML =
                    '<i class="bi bi-eye me-2"></i>Lihat Email Terdaftar';
            }
        });
    }
}

// Setup form submission and validation feedback
function setupFormHandling() {
    const form = document.querySelector("form");

    if (form) {
        form.addEventListener("submit", function (event) {
            // Form validation code would go here if needed
            // For demonstration, we'll show a toast on form submission in a real app
            // You might want to trigger this only after successful submission
            /*
            const successToast = document.getElementById('successToast');
            if (successToast) {
                const toast = new bootstrap.Toast(successToast);
                toast.show();
            }
            */
        });
    }
}

// Initialize all components when the DOM is ready
document.addEventListener("DOMContentLoaded", function () {
    setupRoleStoreToggle();
    setupPasswordToggle();
    setupEmailSectionToggle();
    setupFormHandling();
});
