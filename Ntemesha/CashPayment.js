function validateForm() {
    var nameInput = document.getElementById("name");
    var emailInput = document.getElementById("email");
    var citySelect = document.getElementById("city");
    var uploadInput = document.getElementById("upload");
    var form = document.getElementById("paymentForm");
    var errorMessages = [];
    var error = false;

    // Clear previous error messages
    var previousErrorAlert = document.getElementById("errorAlert");
    if (previousErrorAlert) {
        previousErrorAlert.remove();
    }

    // Validate Name
    if (nameInput.value === "") {
        errorMessages.push("Name cannot be empty");
        error = true;
    } else if (!/^[a-zA-Z\s]*$/.test(nameInput.value)) {
        errorMessages.push("Name must contain only alphabetical characters");
        error = true;
    }

    // Validate Email
    if (emailInput.value === "") {
        errorMessages.push("Email cannot be empty");
        error = true;
    } else if (!/\S+@\S+\.\S+/.test(emailInput.value)) {
        errorMessages.push("Email must be in correct format");
        error = true;
    }

    // Validate City
    if (citySelect.value === "") {
        errorMessages.push("Please select a city");
        error = true;
    }

    // Validate Upload
    if (uploadInput.files.length === 0) {
        errorMessages.push("Please upload an image");
        error = true;
    }

    if (error) {
        showErrorAlert(errorMessages);
        return false;
    } else {
        form.submit();
    }
}

function showErrorAlert(messages) {
    var errorMessage = "Please fix the following errors:\n\n";
    errorMessage += messages.join("\n");
    alert(errorMessage);
}
