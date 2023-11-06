
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
