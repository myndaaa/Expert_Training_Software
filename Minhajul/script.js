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















  function message(){
    var Name = document.getElementById('name');
    var email = document.getElementById('email');
    var msg = document.getElementById('msg');
    const success = document.getElementById('success');
    const danger = document.getElementById('danger');
  
    if(Name.value === '' || email.value === '' || msg.value === ''){
        danger.style.display = 'block';
    }
    else{
        setTimeout(() => {
            Name.value = '';
            email.value = '';
            msg.value = '';
        }, 2000);
  
        success.style.display = 'block';
    }
  
  
    setTimeout(() => {
        danger.style.display = 'none';
        success.style.display = 'none';
    }, 4000);
  
  }











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




















const chatButton = document.getElementById("chat-button");
const chatContainer = document.getElementById("chatContainer");
const minimizeButton = document.getElementById("minimize-button");
const chatInput = document.getElementById("chat-input");
const chatMessages = document.getElementById("conversation-group");
const sendButton = document.getElementById("SentButton");

if (chatButton) {
    chatButton.addEventListener("click", function () {
        if (chatContainer) {
            chatContainer.classList.add("open");
            chatButton.classList.add("clicked");
        }
    });
}

if (minimizeButton) {
    minimizeButton.addEventListener("click", function () {
        if (chatContainer) {
            chatContainer.classList.remove("open");
            chatButton.classList.remove("clicked");
        }
    });
}

function createMessage(message, isUser = true) {
    const newMessage = document.createElement('div');
    newMessage.classList.add(isUser ? 'sentText' : 'botText');
    newMessage.textContent = message;
    chatMessages.appendChild(newMessage);
    return newMessage;
}

function chatbotResponse() {
    const messages = ["Hello!", "How can I assist you?", "Let me know if you have any further questions"];
    const randomIndex = Math.floor(Math.random() * messages.length);
    const message = messages[randomIndex];
    const botMessage = createMessage(message, false);
    botMessage.scrollIntoView();
}

chatInput.addEventListener("input", function (event) {
    if (event.target.value) {
        sendButton.classList.add("svgsent");
    } else {
        sendButton.classList.remove("svgsent");
    }
});

chatInput.addEventListener("keypress", function (event) {
    if (event.keyCode === 13) {
        const message = chatInput.value;
        chatInput.value = "";
        const userMessage = createMessage(message);
        userMessage.scrollIntoView();
        setTimeout(chatbotResponse, 1000);
        sendButton.classList.add("svgsent");
    }
});

if (sendButton) {
    sendButton.addEventListener("click", function () {
        const message = chatInput.value;
        chatInput.value = "";
        const userMessage = createMessage(message);
        userMessage.scrollIntoView();
        setTimeout(chatbotResponse, 1000);
        sendButton.classList.add("svgsent");
    });
}

























const shopText = document.querySelectorAll('.shop')

for(let i = 0; i < shopText.length; i++) {
  shopText[i].innerHTML = "Shop"
}
