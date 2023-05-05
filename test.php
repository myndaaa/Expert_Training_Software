<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Testimonial Slider</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <!-- Stylesheet -->
  <link rel="stylesheet" href="test_style.css" />
</head>

<body>

  <div id="parent">
    <header>
      <div class="navigation">
        <div class="nav-container">
          <div class="brand">
            <a href="home.php">EXPERT</a>
          </div>
          <nav>
            <div class="nav-mobile">
              <a id="nav-toggle" href="#!"><span></span></a>
            </div>
            <ul class="nav-list">

              <li><a href="home.php">Home</a></li>
              <li><a href="#!">About</a></li>
              <li><a href="#!">Services</a>
              </li>
              <li><a href="#!">Pricing</a></li>
              <li><a href="#!">Sign in</a></li>

            </ul>
          </nav>

        </div>
      </div>
    </header>
  </div>

  <div class="wrapper">
    <div class="testimonial-container" id="testimonial-container"></div>
    <button id="prev">&lt;</button>
    <button id="next">&gt;</button>
  </div>
  <!-- Script -->
  <script src="test_script.js"></script>
</body>

</html>