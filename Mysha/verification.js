const emailForm = document.querySelector("#email-form");
const otpForm = document.querySelector("#otp-form");
const emailInput = emailForm.querySelector("input");
const otpInputs = otpForm.querySelectorAll("input");
const submitButton = otpForm.querySelector("button[type='submit']");

// focus the email input on window load
window.addEventListener("load", () => emailInput.focus());

emailForm.addEventListener("submit", (e) => {
  e.preventDefault();
  // generate a random 4-digit OTP code
  const otpCode = Math.floor(1000 + Math.random() * 9000);
  // construct the message to send via email
  const message = `Your OTP code is: ${otpCode}`;

  // send the message to the email address using PHP
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "send_email.php");
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (xhr.status === 200) {
      // enable the OTP inputs and submit button
      otpInputs.forEach((input) => {
        input.removeAttribute("disabled");
      });
      submitButton.removeAttribute("disabled");

      // focus the first OTP input
      otpInputs[0].focus();

      // when the OTP form is submitted, check if the entered OTP code matches the generated code
      otpForm.addEventListener("submit", (e) => {
        e.preventDefault();
        const enteredCode =
          otpInputs[0].value +
          otpInputs[1].value +
          otpInputs[2].value +
          otpInputs[3].value;

        if (enteredCode === otpCode.toString()) {
          // redirect to the "abc.html" page
          window.location.href = "abc.html";
        } else {
          alert("Invalid OTP code. Please try again.");
        }
      });
    } else {
      console.error("HTTP error", xhr.status);
      alert("Error sending email. Please try again.");
    }
  };
  xhr.send(`email=${emailInput.value}&message=${message}`);
});
