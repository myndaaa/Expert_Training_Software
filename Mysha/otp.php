<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="description" content="Basic HTML elements" />
    <meta name="keywords" content="HTML5, tags" />
    <meta name="author" content="mysha" />
    <title>Expert Training Management Portal</title>
    <link rel="stylesheet" href="verification.css" />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
  </head>

  <body>
    <div class="container">
      <header>
        <i class="bx bxs-check-shield"></i>
      </header>
      <h4>Enter Email to Receive OTP Code</h4>
      <form id="email-form" action="#">
        <input type="email" placeholder="Enter Email" required />
        <button type="submit">Send OTP</button>
      </form>
      <h4>Enter OTP Code</h4>
      <form id="otp-form" action="abc.html" method="GET">
        <div class="input-field">
          <input type="number" name="digit1" required />
          <input type="number" name="digit2" required disabled />
          <input type="number" name="digit3" required disabled />
          <input type="number" name="digit4" required disabled />
        </div>
        <button type="submit" disabled>Verify OTP</button>
      </form>
    </div>

    <script src="verification.js"></script>
  </body>
</html>