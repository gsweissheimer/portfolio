<?php 
/* Site Pnid - 2019 */
/* Modulo slide - Incluir nas páginas respetivas */

?>
<style>

#slide img {
  vertical-align: middle;
}

/* Position the image container (needed to position the left and right arrows) */
#slide .container {
  position: relative;
  display: flex;
  margin: auto;
  justify-content: center;
  
}

/* Hide the images by default */
#slide .mySlides {
  display: none;
  width: 800px;
  margin-right: 100px;
}

/* Add a pointer when hovering over the thumbnail images */
#slide .cursor {
  cursor: pointer;
}

/* Next & previous buttons */
#slide.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 40%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
#slide .next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
#slide .prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}


/* Container for image text */
#slide .caption-container {
  text-align: center;
  background-color: #222;
  padding: 2px 16px;
  color: white;
}

#slide .row{
  width: 200px;
    height: unset;
    display: grid;
    align-items: center;
    justify-content: center;
    margin: 0;
}

#slide .row:after {
  content: "";
  display: table;
  clear: both;
}

/* Six columns side by side */
#slide .column {
  float: left;
  width: 100%;
}

/* Add a transparency effect for thumnbail images */
#slide .demo {
  opacity: 0.6;
}

#slide .active,
.demo:hover {
  opacity: 1;
}

@media (min-width: 700px) and (max-width: 1400px) {
  #slide .mySlides {
    margin-right: 0px;
}

#slide {
    padding: 100px 3%;
}

}

@media (max-width: 699px) {
    #slide .mySlides {
    width: unset;
    margin-right: 0;
    }

    #slide .row {
    width: unset;
    padding: 0 4%;
    display: flex;}

    #slide .container {
    display: block;
    }

    #slide .column {
    width: calc(100% /3);
}

}

</style>

<article id="slide">

<?php 
 $html='
 <div class="container">
  <div class="mySlides">
    <img src="{{img}}" style="width:100%">
  </div>

  <div class="mySlides">
    <img src="{{img_2}}" style="width:100%">
  </div>

  <div class="mySlides">
    <img src="{{img_3}}" style="width:100%">
  </div>
    

  <div class="row">
    <div class="column">
      <img class="demo cursor" src="{{img}}" style="width:100%" onclick="currentSlide(1)" alt="">
    </div>
    <div class="column">
      <img class="demo cursor" src="{{img_2}}" style="width:100%" onclick="currentSlide(2)" alt="">
    </div>
    <div class="column">
      <img class="demo cursor" src="{{img_3}}" style="width:100%" onclick="currentSlide(3)" alt="">
    </div>
  
  </div>
</div>';
                          
$caso = $_GET['clinica'];
echo(funGetAdvancedBanners('clinica', $html, true, $caso));?>  
<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}
</script>
</article>
