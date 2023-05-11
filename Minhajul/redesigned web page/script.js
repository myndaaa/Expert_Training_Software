//scroll to top on refresh//
window.onbeforeunload = function() {
  window.scrollTo(0, 0);
}

jQuery(document).ready(function($) {

  $(window).load(function() {
    $('.loading').delay(2000).fadeOut('slow', function() {
      $(this).remove();
    });
    setTimeout(function() {
      $('.landing').addClass('loaded');
    }, 2000);
    setTimeout(function() {
      $('body').addClass('loaded');
    }, 2000);

  });

  window.addEventListener('load', function() {

    var one = document.querySelector('.one');
    var two = document.querySelector('.two');
    var three = document.querySelector('.three');
    delay = 2500;

    setTimeout(function() {
      $('.content-1').addClass('loaded');
    }, 2000);

    var animation = function() {
      setTimeout(function() {
        one.style.top = '50%';
      }, delay);
      setTimeout(function() {
        one.style.top = '100%';
      }, delay * 5);

      setTimeout(function() {
        two.style.top = '50%';
      }, delay * 6);
      setTimeout(function() {
        two.style.top = '100%';
      }, delay * 11);

      setTimeout(function() {
        three.style.top = '50%';
      }, delay * 12);
      setTimeout(function() {
        three.style.top = '100%';
      }, delay * 17);
    };
    animation();
    setInterval(animation, delay * 18);
  });

  window.onscroll = function() {
    if ($(this).scrollTop() > 1) {
      $('header').addClass("resize");
    } else {
      $('header').removeClass("resize");
    }
  };

  $(window).scroll(function() {
    $('.hideme').each(function(i) {
      var bottom_of_object = $(this).offset().top + $(this).outerHeight();
      var bottom_of_window = $(window).scrollTop() + $(window).height();
      if (bottom_of_window > bottom_of_object) {
        $(this).animate({
          'opacity': '1'
        }, 1250);
      }
    });
  });

  $(".mouseScroll").click(function() {
    $('html, body').animate({
      scrollTop: $(".about").offset().top - 150
    }, 800);
  });

  window.onload = function() {
    $('.button_container').click(function() {
      $('.button_container').toggleClass('active');
      $('.overlay').toggleClass('open');
      $('body').toggleClass('active');
    });
  }

});



























const cookieBox = document.querySelector(".wrapper"),
buttons = document.querySelectorAll(".button");

const executeCodes = () => {
//if cookie contains codinglab it will be returned and below of this code will not run
if (document.cookie.includes("codinglab")) return;
cookieBox.classList.add("show");

buttons.forEach((button) => {
  button.addEventListener("click", () => {
    cookieBox.classList.remove("show");

    //if button has acceptBtn id
    if (button.id == "acceptBtn") {
      //set cookies for 1 month. 60 = 1 min, 60 = 1 hours, 24 = 1 day, 30 = 30 days
      document.cookie = "cookieBy= codinglab; max-age=" + 60 * 60 * 24 * 30;
    }
  });
});
};

//executeCodes function will be called on webpage load
window.addEventListener("load", executeCodes);



























const form = document.getElementById("form");
const username = document.getElementById("username");
const email = document.getElementById("email");
const password = document.getElementById("password");
const password2 = document.getElementById("password2");

function showError(input, message) {
  const formControl = input.parentElement;
  formControl.className = "form-control error";
  let small = formControl.querySelector("small");
  small.innerText = message;
}

function showSuccess(input) {
  const formControl = input.parentElement;
  formControl.className = "form-control success";
}

function checkEmail(input) {
  const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if (re.test(input.value)) {
    showSuccess(input);
  } else {
    showError(input, "Email is not valid");
  }
}

function checkRequired(inputArr) {
  inputArr.forEach(function(input) {
    if (input.value === "") {
      showError(input, `${getFieldName(input)} is required`);
    } else {
      showSuccess(input);
    }
  });
}

function checkPasswordsMatch(password1, password2) {
  if (password1.value !== password2.value) {
    showError(password2, "Password do not match");
  }
}

function checkLength(input, min, max) {
  if (input.value.length <= min) {
    showError(
      input,
      `${getFieldName(input)} must be more than ${min} characters`
    );
  } else if (input.value.length >= max) {
    showError(
      input,
      `${getFieldName(input)} must be less than ${max} characters`
    );
  } else {
    showSuccess(input);
  }
}

function getFieldName(input) {
  return input.id.charAt(0).toUpperCase() + input.id.slice(1);
}

form.addEventListener("submit", function(e) {
  e.preventDefault();

  checkRequired([username, email, password, password2]);
  checkLength(username, 3, 15);
  checkLength(password, 6, 25);
  checkEmail(email);
  if (password2.value !== "") {
    checkPasswordsMatch(password, password2);
  }
});




















let userTexts = document.getElementsByClassName("user-text");
let userPics = document.getElementsByClassName("user-pic");

function showReview(){
  for(userPic of userPics){
      userPic.classList.remove("active-pic");
  }
  for(userText of userTexts){
      userText.classList.remove("active-text");
  }
  let i = Array.from(userPics).indexOf(event.target);

  userPics[i].classList.add("active-pic");
  userTexts[i].classList.add("active-text");
}














$(".option").click(function(){
$(".option").removeClass("active");
$(this).addClass("active");

});
