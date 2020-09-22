$(document).ready(function(){

//alert('testando JQUERY');

  $(document).on('change', '#produtos', function(event) {
         
    var selector = $(this).find(':selected').attr('data-filter');     
     $('.fillter_slider').fadeOut(300);
     $('.fillter_slider').fadeIn(300);
     setTimeout(function() {
     	$('.fillter_slider .owl-item').hide();
     	$(selector).closest('.fillter_slider .owl-item').show();
     }, 300);
     return false;

  });

});

