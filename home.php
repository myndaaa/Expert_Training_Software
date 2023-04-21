<?php
$connection = new mysqli('localhost', 'root', '', 'expert-db');
if ($connection->connect_error) {
  die("Coudn't connnect to database!");
}


$popupResult = $connection->query('SELECT * FROM popup');

$popup = array(1 => 'image/image1.png', 2 => 'Name default', 3 => '<h2>10<sup>%</sup><span>off</span></h2><p>DESCRIPTION default</p>');

if ($popupResult->num_rows != 0) {
  $rows = mysqli_fetch_all($popupResult);
  $random = 0;
  if ($popupResult->num_rows > 0) {
    $random = rand(0, $popupResult->num_rows - 1);
  }

  $popup = $rows[$random];
}


$imageSliderResult = $connection->query('SELECT * FROM imageslider');

//die(var_dump($imageSliderResult->fetch_assoc()));
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https: //stackpath. bootstrapcdn.com/bootstrap/4-3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="./sty.css">
  <script src="script.js"></script>

  <title>Document</title>
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

  <div id="sec2">
    <div class="container">
      <div id="slide">
        <?php
        if ($imageSliderResult->num_rows != 0) {
          $row = $imageSliderResult->fetch_assoc();
          while ($row) {
            $path = $row['path'];
            $name = $row['name'];
            $description = $row['description'];
            echo '<div class="item" style="background-image: url(' . $path . ');">';
            echo '<div class="content">';
            echo '<div class="name">' . $name . '</div><div class="des">' . $description . '</div><button>See more</button></div></div>';
            $row = $imageSliderResult->fetch_assoc();
          }
        } else {
          echo '<div class="item" style="background-image: url(images/cover.jpg);">
               <div class="content">
                   <div class="name">LUNDEV</div>
                   <div class="des">Tinh ru anh di chay pho, chua kip chay pho thi anhchay mat tieu</div>
                   <button>See more</button>
               </div>
            </div>';
        }

        ?>
        <div class="buttons">
          <button id="prev"><i class="fa-solid fa-angle-left"></i></button>
          <button id="next"><i class="fa-solid fa-angle-right"></i></button>
        </div>
      </div>


    </div>





    <div class="popup">
      <div class="contentBox">
        <div class="cross_button"></div>
        <div class="imgbox">
          <img src="<?php echo $popup[1] ?>" alt="Promotion Pic">
        </div>
        <div class="announcement">
          <div class="annun">
            <h3><span> <?php echo $popup[2] ?> </span></h3>


            <?php echo $popup[3] ?>


            <a href="#!">Get the Deal</a>
          </div>
        </div>
      </div>
    </div>

    <script>
      const popup = document.querySelector('.popup');
      const close = document.querySelector('.cross_button');

      window.onload = function() {
        setTimeout(function() {
          popup.style.display = "block";

        }, 2000)
      }

      close.addEventListener('click', () => {
        popup.style.display = "none";

      })
    </script>











  </div>

  <script src="script.js"></script>









  <!--footer-->

  <footer>

    <a href="home.html" title="Our Homepage">
      <h1 class="logo"><span class="kw" translate="no">EXPERT</span></h1>
    </a>

    <div class="details" id="contact_order">

      <div class="footer_menu">

        <ul>
          <li><strong class="minimenu"><span class="kw" translate="no">EXPERT</span></strong></li>
          <li><a href="home.php" class="flinks">Home Page</a></li>
          <li><a href=#feed class="flinks">FeedBack</a></li>
          <li><a href="test.php" class="flinks">Testimonials</a></li>
        </ul>

        <ul>
          <li><strong class="minimenu">Contacts</strong></li>
          <li>
            <p><a href="https://www.facebook.com/CutLet-100551645477090" target="_blank"><img src="images/facebook_icon.png" title="Visit Us on Facebook" alt="Our Facebook Link" /></a> &nbsp;
              <a href="https://wa.me/qr/74LHPZBMWYZ6K1" target="_blank"><img src="images/whatsapp_icon.png" alt="Our whatsapp number" title="Contact Us on Whatsapp" /></a> &nbsp;
              <a href="mailto:101230484@students.swinburne.edu.my" target="_blank"><img src="images/gmail_icon.png" alt="Our gmail address" height="48" width="44" title="Contact Us via Email" /></a> &nbsp;
              <a href="https://www.instagram.com/CutLet-100551645477090" target="_blank"><img src="images/instagram_icon.png" alt="Our Instagram Link" title="check Us on Instagram" /></a>
            </p> &nbsp;
          </li>
          <li></li>
          <li></li>
        </ul>

        <ul>
          <li> <strong class="minimenu">About Us</strong> </li>
          <li> <a href="aboutme.html" class="flinks">Author's Detail</a><br><br><br></li>
        </ul>


      </div>



      <!--Enhancement Google map tab linking referred to Youtube Channel:- "Geek Tutorials" link:- https://www.youtube.com/watch?v=KIC0OK9nKXY -->
      <div class="mapping" id="maps">
        <h2>Our Address:</h2>
        <p><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.4026724120695!2d110.35643741457282!3d1.5263408988868885!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31fba70d915f6b2f%3A0x4a6fa38ac11b2e5b!2s296%2C%20Lorong%20Tabuan%20Dayak%206%2C%20King%20Centre%2C%2093350%20Kuching%2C%20Sarawak!5e0!3m2!1sen!2smy!4v1617047646830!5m2!1sen!2smy" height="300" loading="eager"></iframe></p>
      </div>

      <div class="main" id="feed">
        <div class="content">
          <h2>Feedback</h2>
          <p>Feel Free to get in touch with us!</p>
          <form id='enqForm' name='enqForm' method="POST">
            <input type="text" placeholder="Your Name" id='enqName' name='enqName'>
            <input type="email" placeholder="Your Email" id='enqEmail' name='enqEmail'>
            <textarea name="enqText" id="enqText" cols="19" rows="4" placeholder="Type Your Message here" id='enqText' name='enqText'></textarea>
            <input type="submit" value="Send" id='enqSubmit'>
          </form>
        </div>
        <div class="sub">
          <div class="sub-content">
            <h1>EXPERT</h1>

            <p><i class="fas fa-map-marker-alt"></i> We Value Your </p>
            <p><i class="fas fa-map-marker-alt"></i>Valuable </p>
            <p><i class="fas fa-map-marker-alt"></i>FEED BACK </p>

          </div>
        </div>
      </div>

      <div class="scrollbtn">
        <a href="#"> <i class="fas fa-arrow-up"></i> </a>
      </div>




      <script src="script.js"></script>


      <div class="tag_line">
        <h3>2023 Expert Sdn. Bhd. All Rights Reserved.</h3>
      </div>
  </footer>

  <script>
    form = document.getElementById('enqForm');
    form.addEventListener('submit',
      function(event) {
        event.preventDefault();
        var fd = new FormData(form);
        var postReq = new XMLHttpRequest();
        postReq.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var responseText = JSON.parse(postReq.responseText);
            if (responseText.success == 1) {
              alert("Feedback sent!");
              form.reset();
            } else if (responseText.success == 3) {
              alert("Couldn't send feedback!");
            } else {
              alert("Empty fields, feedback");
            }
          }
        };
        postReq.open("POST", 'enquiry_form_backend.php', true);
        postReq.send(fd);

      });
  </script>



</body>

</html>