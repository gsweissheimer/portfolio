$(document).ready(function(){

//alert('testando JQUERY');

  $(document).on('change', '#produtos2', function(event) {
         
   var selector = $(this).find(':selected').attr('data-filter');
        $(".projects_inner, .project_full_inner, .blog_inner_fillter, .blog_ms_inner").isotope({
         filter: selector,
         animationOptions: {
             duration: 450,
             easing: "linear",
             queue: false,
         }
     });
     return false;
    

  });

});