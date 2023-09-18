<!DOCTYPE html>
<html lang="en">
<head>
    <title>Marvin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;500;600&family=Oswald&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/frontend/assets/css/style.css" />
    <!-- //////////SLICK_SLIDER/////////// -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>
<body>

    <header>
        <div class="container-fluid header d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
               <div class="col-md-2">
               <img src="image/headlogo.png" width="180px">
                   </div>
               <div class="col-md-8">
             <ul class="nav col-12 col-md-auto mb-2">
               <li><a href="#" class="nav-link px-2 link-dark">Home</a></li>
               <li><a href="#" class="nav-link px-2 link-dark">Servies</a></li>
               <li><a href="#" class="nav-link px-2 link-dark">Hot Prospects</a></li>
               <li><a href="#" class="nav-link px-2 link-dark">College Coaches</a></li>
               <li><a href="#" class="nav-link px-2 link-dark">Student Athlete</a></li>
               <li><a href="#" class="nav-link px-2 link-dark">High School</a></li>
               <li><a href="#" class="nav-link px-2 link-dark">Coaches</a></li>
               <li><a href="#" class="nav-link px-2 link-dark">Contact Us</a></li>
             </ul>
       
             </div>
             <div class="col-md-2 text-end">
				 <button type="button" class="btn gradint"><a href="/login">Log In</a></button>
            </div>
         </div>
       </header>

       <section>
    @yield('content')
        
    <footer>
      <div class="container">
          <div class="row foot">
            <div class="col-4">
              <img src="image/headlogo.png" height="60px" width="175px">
              <p class="foot-txt about-me">Lorem ipsum dolor sit amet, sectetur adipisicing elit, sed do eiusmod mpor incididunt ut labore et dolore Lorem ipsum dolor sit amet, sectetur adipisicing elit, sed do eiusmod</p>
            </br>
              <ul class="socialization">
                <li><a href="#"><img src="image/twitter.png"></a></li>
                <li><a href="#"><img src="image/facebook.png"></a></li>
                <li><a href="#"><img src="image/instagram.png"></a></li>
                <li><a href="#"><img src="image/pinterest.png"></a></li>
              </ul>
            </div>
            <div class="col-2">
              <h6>More Links</h6> 
              <ul class="foot-txt">
                <li>About Us</li>
                <li>Solutions</li>
                <li>Blog</li>
                <li>Contact</li>
  
              </ul>
            </div>
            <div class="col-2">
              <h6>Contact</h6> 
              <ul class="contact-icon">
                <li><a href="#"><img src="image/map.png">Orange Street,USA </a></li>
                <li><a href="#"><img src="image/mail.png">example@mail.com</a></li>
                <li><a href="#"><img src="image/admin.png">880 123 456 789</a></li>
              </ul>
            </div>
            
            <div class="col-4 newsletters">
              <h6>Newsletters</h6> 
              <form action="/action_page.php">
                <div class="form-group">
                  <p style="color: black;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut libero ut diam finibus</p>
                  <label for="email"></label>
                   <input type="email" placeholder="Your email" class="form-control" id="email"  name="email">
                  <button type="submit" class="btn footbtn">Send</button>
  
                </div>
              </form>
            </div>
          
            </div>
        </div>
      </div>
      <div class="container-fluid maincopy_right">
        <div class="container">
        <div class="copy-right ">
        <p>© 2022 Marvin Kendricks All Rights Reserved</p>
        <ul class="payment-logos">
        <img src="image/paymentlogos.png">
      </div>
      </div>
      </div>
      </footer>


       <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  
  <script>
    $('.slider-main').slick();
 </script>

<script>
    $(".portfolio-slider").slick({
   slidesToShow: 3,
   infinite:true,
   slidesToScroll: 1,
   autoplay: true,
   autoplaySpeed: 2000,
   dots: true, Boolean
  });
</script>

<script>
  $(".newss-slider").slick({
 slidesToShow: 3,
 infinite:true,
 slidesToScroll: 1,
 autoplay: true,
 autoplaySpeed: 2000,
    dots: true, Boolean
});
</script>

<script>
  $(document).ready(function() {
  $('.testimonial-slider').slick({
      autoplay: true,
      autoplaySpeed: 1000,
      speed: 600,
      draggable: true,
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: true,
      dots: false,
      responsive: [
          {
            breakpoint: 991,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
            }
          },
          {
              breakpoint: 575,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
              }
          }
      ]
  });
}); 
</script>

<script>
  AOS.init();
</script>

</body>
</html>