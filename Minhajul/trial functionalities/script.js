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






























































$(".option").click(function(){
  $(".option").removeClass("active");
  $(this).addClass("active");
  
});
