
// Form submission handler
function submitForm(event) {
    event.preventDefault(); // Prevent form submission
  
    // Perform form validation
    let email = document.getElementById("email").value;
    let cardInfo = document.getElementById("cardInfo").value;
    let nameOnCard = document.getElementById("nameOnCard").value;
    let city = document.getElementById("city").value;
  
    let isValid = true;
    let errorMessage = ""; // Error message string
  
    // Email validation
    if (!validateEmail(email)) {
      errorMessage += "Invalid email\n";
      isValid = false;
    }
  
    // Card information validation
    if (!validateCardInfo(cardInfo)) {
      errorMessage += "Card information must be 8 to 10 digit numbers\n";
      isValid = false;
    }
  
    // Name on card validation
    if (!validateNameOnCard(nameOnCard)) {
      errorMessage += "Name on card must be between 3 and 50 letters\n";
      isValid = false;
    }
  
    // City validation
    if (city === "") {
      errorMessage += "City is required\n";
      isValid = false;
    }
  
    if (isValid) {
      // Submit the form if all inputs are valid
      document.getElementById("paymentForm").submit();
    } else {
      // Display error messages in a popup
      alert(errorMessage);
    }
  }
  
  // Email validation using regular expression
  function validateEmail(email) {
    // Regular expression for email validation
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }
  
  // Card information validation using regular expression
  function validateCardInfo(cardInfo) {
    // Regular expression for card information validation
    let cardInfoRegex = /^\d{8,10}$/;
    return cardInfoRegex.test(cardInfo);
  }
  
  // Name on card validation using regular expression
  function validateNameOnCard(nameOnCard) {
    // Regular expression for name on card validation
    let nameOnCardRegex = /^.{3,50}$/;
    return nameOnCardRegex.test(nameOnCard);
  }