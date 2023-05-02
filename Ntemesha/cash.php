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
          <img
            src="images/icons8-questions-48.png"
            alt="Icon"
            width="30"
            height="30"
            class=""
          />
          Request
        </a>
      </li>
      <li class="">
        <a class="" href="#">
          <img
            src="images/icons8-idea-48 (1).png"
            alt="Icon"
            width="30"
            height="30"
            class=""
          />
          Suggestion
        </a>
      </li>
      <li class="">
        <a class="" href="#">
          <img
            src="images/icons8-iphone-spinner-48.png"
            alt="Icon"
            width="30"
            height="30"
            class=""
          />
          Processing
        </a>
      </li>
      <li class="">
        <a class="" href="#">
          <img
            src="images/icons8-online-payment-48.png"
            alt="Icon"
            width="30"
            height="30"
            class=""
          />
          Payment
        </a>
      </li>
      <li class="">
        <a class="" href="#">
          <img
            src="images/icons8-chat-message-96 (1).png"
            alt="Icon"
            width="30"
            height="30"
            class=""
          />
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
                <form id="paymentForm" method="post" action="cash_payments.php" enctype="multipart/form-data">
                  <label for="name">Name:</label>
                  <input type="text" id="name" name="name">
                  <label for="email">Confirm Email</label>
                  <input type="email" id="email" name="email" required>
                  <label for="city">Select City</label>
                  <select id="city" name="city">
                      <option value="kuching">Kuching</option>
                      <option value="miri">Miri</option>
                      <option value="sibu">Sibu</option>
                      <option value="bintulu">Bintulu</option>
                  </select>
                  <label for="upload">Upload Now</label>
                  <input type="file" id="upload" name="upload">
                  <label for="city">City:</label>
                  <button type="button" class="pay-now-button" onclick="validateForm()">Pay Now</button>
              </form>
                  <p class="card-option">Or <a href="card.php" class="cash-option2">pay with Card</a></p>
              </div>

        </div>
        <div class="container">
            <div class="form-wrapper">
                <h1>Container 2</h1>
                <p>This is the second container on the right.</p>
            </div>
        </div>
        <script src="CashPayment.js"></script>
  </body>
</html>
