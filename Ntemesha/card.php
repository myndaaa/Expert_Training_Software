<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/styles.css" />
  <title>Document</title>
</head>
<nav>
  <ul>
    <li class="">
      <a class="" href="#">
        <img src="images/icons8-questions-48.png" alt="Icon" width="30" height="30" class="" />
        Request
      </a>
    </li>
    <li class="">
      <a class="" href="#">
        <img src="images/icons8-idea-48 (1).png" alt="Icon" width="30" height="30" class="" />
        Suggestion
      </a>
    </li>
    <li class="">
      <a class="" href="#">
        <img src="images/icons8-iphone-spinner-48.png" alt="Icon" width="30" height="30" class="" />
        Processing
      </a>
    </li>
    <li class="">
      <a class="" href="#">
        <img src="images/icons8-online-payment-48.png" alt="Icon" width="30" height="30" class="" />
        Payment
      </a>
    </li>
    <li class="">
      <a class="" href="#">
        <img src="images/icons8-chat-message-96 (1).png" alt="Icon" width="30" height="30" class="" />
        Communication
      </a>
    </li>
  </ul>
</nav>

<body>
  <div class="container-wrapper">
    <div class="container">
      <div class="form-wrapper">
        <h1>Payment Form</h1>
        <form id="paymentForm" action="update_payments.php" method="post">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
          <label for="cardInfo">Card number:</label>
          <input type="text" id="cardInfo" name="cardInfo" required>
          <span id="cardInfoError" class="error-message">Please enter a valid card information (8-12 digits with no spacing).</span>

          <label for="expiryDate">Expiry Date:</label>
          <select id="expiryDate" name="expiryDate" required>
            <option value="">Month</option>
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
          </select>
          <input type="number" id="expiryYear" name="expiryYear" placeholder="Year" required>
          <span id="expiryError" class="error-message">Please select a valid expiry date.</span>

          <label for="cvc">CVC:</label>
          <input type="number" id="cvc" name="cvc" required>
          <span id="cvcError" class="error-message">Please enter a valid cvc number (3-4 digits).</span>

          <label for="nameOnCard">Name on Card:</label>
          <input type="text" id="nameOnCard" name="nameOnCard" required>
          <span id="nameOnCardError" class="error-message">Please enter a valid name on card (3-50 letters).</span>

          <label for="city">City:</label>
          <select id="city" name="city" required>
            <option value="">Select a city</option>
            <option value="Kuching">Kuching</option>
            <option value="Miri">Miri</option>
            <option value="Sibu">Sibu</option>
            <option value="Bintulu">Bintulu</option>
          </select>
          <span id="cityError" class="error-message">Please select a city.</span>

          <button type="button" class="pay-now-button" onclick="submitForm(event)">Pay Now</button>
        </form>


        <p class="cash-option">Or <a href="cash.php" class="cash-option2">pay with Cash</a></p>
      </div>

    </div>

    <div class="container">
      <div class="form-wrapper">
        <h1>Container 2</h1>
        <p>This is the second container on the right.</p>
      </div>
    </div>
  </div>
  <script src="paymentForm.js"></script>

</body>

</html>