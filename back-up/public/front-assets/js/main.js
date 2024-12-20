// WOW.js initialization
new WOW({
  boxClass: 'wow',
  animateClass: 'animated',
  offset: 90,
  mobile: false,
  live: true
}).init();

// document.querySelector('.topbar-toggler').addEventListener('click', function(){
//   document.documentElement.classList.toggle('topbar_open');
// })
document.querySelector('.nav-toggle').addEventListener('click', function(){
  document.documentElement.classList.toggle('nav_open');
})
$('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  fade: true,
  asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
  slidesToShow: 7,
  slidesToScroll: 1,
  asNavFor: '.slider-for',
  dots: false,
  focusOnSelect: true,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    }
  ]
});
$('.master-slider').slick({
  dots: false,
  infinite: false,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});
$('.dashboard-slider').slick({
  dots: false,
  infinite: false,
  speed: 1000,
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true
});
// Initialize the Slick Slider
$('.testimonial-wrapper').slick({
  dots: true,
  infinite: true,
  speed: 1000,
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true
});

// Gallery tabs code
document.addEventListener('DOMContentLoaded', function() {
  function switchTab(containerSelector, targetPaneId) {
      document.querySelectorAll(containerSelector + ' .tab-pane').forEach(function(tabPane) {
          tabPane.classList.remove('active');
      });
      document.getElementById(targetPaneId).classList.add('active');
      
      // Refresh Slick Slider if needed
      if (containerSelector === '.privacy-testimonial') {
          $('.testimonial-wrapper').slick('setPosition');
      }
  }

  function setupRadioButtons(containerSelector, radioClass, tabMap) {
      document.querySelectorAll(radioClass).forEach(function(radioButton) {
          radioButton.addEventListener('change', function() {
              if (this.checked) {
                  switchTab(containerSelector, tabMap[this.id]);
              }
          });
      });
  }

  // Setup for Gallery Radios
  setupRadioButtons('.gallery', '.gallery-radios', { 'test1': 'messages', 'test2': 'settings' });

  // Setup for Privacy Testimonials
  setupRadioButtons('.privacy-testimonial', '.testimony', { 'everyone': 'home', 'connections': 'profile' });
});

var loadFile = function(event) {
  var image = document.getElementById('profileImage');
  image.src = URL.createObjectURL(event.target.files[0]);
};
$('.toggle').click(function(){
  $('.user-menu').slideToggle();
})