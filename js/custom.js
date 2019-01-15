

jQuery(document).ready(function($) {
// Reviews Popup
  $('.reviewshortcode').children('div').addClass('hide');
  
  // Open reviews popup
  $('.rev-trigger').click(function() {
    $('.rev-popup, .rev-popup-wrap, body').addClass('open');
  });
  $('.rev-popup-wrap .popup-close.top-close').click(function() {
    $('.rev-popup, .rev-popup-wrap, body').removeClass('open');
  })
  
  // Open & close form
  $('.rev-write-trigger').click(function(){
    $('.reviews-form').slideToggle();
    $('.form-holder').toggleClass('open');
  });
  $('.reviews-form .popup-close').click(function() {
    $(this).parents('.reviews-form').slideUp();
    $('.form-holder').removeClass('open');
  });
  $('.reviews-form .acf-button.button').click(function(){
    var star_value = $('.reviews-form .select2-hidden-accessible').val();  
    var recaptThere = $('.reviews-form .acf-field-recaptcha input[name="acf[field_'your-field-name']').attr('value');  
    
    if (star_value == 5 && recaptThere != false) {  
      window.open('https://your-thankyou-url/', 'popUpWindow', 'height=600,width=600,scrollbars=yes,menubar=no'); // displayed as popup window
    } else if (star_value == 5 && recaptThere == false) {
    } else {
      $('.reviews-form').slideUp();      
      $('.form-holder .thanks').slideToggle();     
    }
  });
  $("label[for='acf-_post_title']").text('Name'); 
  
  // Close Reviews popup
  $('.thanks .thanks-close').click(function(){
    $('.rev-popup, .rev-popup-wrap, body').removeClass('open'); 
  });

  // Isotope layout
  var $grid = $('.reviews-holder')
  $grid.isotope({
    itemSelector: '.review-single',
    layoutMode: 'vertical',
  });
  
  $(document).click(function() {
    $('.rev-popup, .rev-popup-wrap, body').removeClass('open');
  });
  $(".rev-popup-wrap, .rev-trigger").click(function(e) {
    e.stopPropagation();
  });
  
  // Position 
  function checkOffset() {
    if($('.rev-trigger-outer').length) {
    if($('.rev-trigger-outer').offset().top + jQuery('.rev-trigger-outer').height() >= $('#divID').offset().top - 10) 
    $('.rev-trigger-outer').addClass('stop');
    
    if($(document).scrollTop() + window.innerHeight < $('#divID').offset().top) 
      $('.rev-trigger-outer').removeClass('stop');
    }
  }  

  $(document).scroll(function() {
    checkOffset();
  }); 
  });
  
 
  
