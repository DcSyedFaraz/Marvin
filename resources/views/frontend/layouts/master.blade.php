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
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;500;600&family=Oswald&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <!-- //////////SLICK_SLIDER/////////// -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body>

    <header>
        <div
            class="container-fluid header d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
            <div class="col-md-2">
                <img src="./assets/images/headlogo.png" width="180px">
            </div>
            <div class="col-md-8">
                <ul class="nav col-12 col-md-auto mb-2">
                    <li><a href="./index.html" class="nav-link px-2 active link-dark">Home</a></li>
                    <li><a href="./about-us.html" class="nav-link px-2 link-dark">About Us</a></li>
                    <li><a href="./job-board.html" class="nav-link px-2 link-dark">Job Board</a></li>
                    <li><a href="./hot-prospects.html" class="nav-link px-2 link-dark">Hot Prospects</a></li>
                    <li><a href="./college-coaches.html" class="nav-link px-2 link-dark">College Coaches</a></li>
                    <li><a href="./students-athletes.html" class="nav-link px-2 link-dark">Student Athlete</a></li>
                    <li><a href="./high-school.html" class="nav-link px-2 link-dark">High School</a></li>
                    <li><a href="./contact-us.html" class="nav-link px-2 link-dark">Contact Us</a></li>
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
                        <img src="./assets/images/headlogo.png" height="60px" width="175px">
                        <p class="foot-txt about-me">Lorem ipsum dolor sit amet, sectetur adipisicing elit, sed do eiusmod
                            mpor
                            incididunt ut labore et dolore Lorem ipsum dolor sit amet, sectetur adipisicing elit, sed do
                            eiusmod</p>
                        </br>
                        <ul class="socialization">
                            <li><a href="#"><img src="./assets/images/twitter.png"></a></li>
                            <li><a href="#"><img src="./assets/images/facebook.png"></a></li>
                            <li><a href="#"><img src="./assets/images/instagram.png"></a></li>
                            <li><a href="#"><img src="./assets/images/pinterest.png"></a></li>
                        </ul>
                    </div>
                    <div class="col-2">
                        <h6>More Links</h6>
                        <ul class="foot-txt">
                            <a href="./about-us.html"><li>About Us</li></a>
                            <a href="./free-recruiting-evaluation.html"><li>Free Recruiting</li></a>
                            <a href="./contact-us.html"><li>Contact</li></a>

                        </ul>
                    </div>
                    <div class="col-2">
                        <h6>Contact</h6>
                        <ul class="contact-icon">
                            <li><a href="#"><img src="./assets/images/map.png">Orange Street,USA </a></li>
                            <li><a href="#"><img src="./assets/images/mail.png">example@mail.com</a></li>
                            <li><a href="#"><img src="./assets/images/admin.png">880 123 456 789</a></li>
                        </ul>
                    </div>

                    <div class="col-4 newsletters">
                        <h6>Newsletters</h6>
                        <form action="/action_page.php">
                            <div class="form-group">
                                <p style="color: black;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut
                                    libero ut
                                    diam finibus</p>
                                <label for="email"></label>
                                <input type="email" placeholder="Your email" class="form-control" id="email" name="email">
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
                            <img src="./assets/images/paymentlogos.png">
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
            $(document).ready(function() {
                $(".counter").each(function() {
                    var $this = $(this),
                        countTo = $this.attr("data-countto");
                    countDuration = parseInt($this.attr("data-duration"));
                    $({
                        counter: $this.text()
                    }).animate({
                        counter: countTo
                    }, {
                        duration: countDuration,
                        easing: "linear",
                        step: function() {
                            $this.text(Math.floor(this.counter));
                        },
                        complete: function() {
                            $this.text(this.counter);
                        }
                    });
                });
            });
        </script>

        <script>
            $(".portfolio-slider").slick({
                slidesToShow: 3,
                infinite: true,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                dots: true,
                Boolean
            });
        </script>

        <script>
            $(".newss-slider").slick({
                slidesToShow: 3,
                infinite: true,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                dots: true,
                Boolean
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
                    responsive: [{
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
            $(document).ready(function() {
                $('.customer-logos').slick({
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 1500,
                    speed: 600,
                    arrows: false,
                    dots: false,
                    pauseOnHover: false,
                    responsive: [{
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 4
                        }
                    }, {
                        breakpoint: 520,
                        settings: {
                            slidesToShow: 3
                        }
                    }]
                });
            });
        </script>

        <script>
            AOS.init({
                once: true
            });
        </script>

</body>

</html>
