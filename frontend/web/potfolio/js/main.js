
    $(document).ready(function(){
      // Add smooth scrolling to all links
      $("a").on('click', function(event) {
    
        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
          // Prevent default anchor click behavior
          event.preventDefault();
    
          // Store hash
          var hash = this.hash;
    
          // Using jQuery's animate() method to add smooth page scroll
          // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 800, function(){
       
            // Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = hash;
          });
        } // End if
      });
    });
    



$(document).ready(function(){


$(window).scroll(function(){
    if(this.scrollY > 20 ){
        $('.navbar').addClass("sticky");
    }else{
        $('.navbar').removeClass("sticky");
    }
    if(this.scrollY > 500){
        $('.scroll-up-btn').addClass('show');
    }
    else{
        $('.scroll-up-btn').removeClass('show');
    }
});

// slide-up script

$('.scroll-up-btn').click(function(){
    $('body').animate({screenTop: 0});
});

// typing animation 

var typed=new Typed(".typing",{
    strings:[ "Web Coder", "Developer","Blogger","Designer"],
    typeSpeed:100,
    backSpeed:60,
    loop:true

})


var typed=new Typed(".typing-2",{
    strings:[ "Web Coder", "Developer","Blogger","Designer"],
    typeSpeed:100,
    backSpeed:60,
    loop:true

})
// toggle menu/ navbar script

$('.menu-btn').click(function(){
    $(".navbar .menu").toggleClass("active");
    $(".menu-btn i").toggleClass("active");
})

// owl carousel script

$('.carousel').owlCarousel({
    margin:20,
    loop:true,
    autoplayTimeOut:2000,
    autoplayHoverPause:true,
    responsive: {
        0:{
            items:1,
            nav:false
        },

        600:{
            items:2,
            nav:false
        },

        1000:{
            items:3,
            nav:false
        }

    }

});
});