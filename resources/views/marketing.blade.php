
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    {{-- <link rel="stylesheet" type="text/css" href="engine1/style.css" /> --}}
    <link rel="icon" type="image/x-icon" href="../images/favicon.png">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('../css/tweeter.css')}}">
</head>
    <body class="marketing-image">
        <div>
            <ul>
                <li><a href="/about"><i class="fab fa-twitter"></i>About</a></li>
                <li><a href="/">Let's go Tweeter</a></li>
                <li><a href="/about">Company</a></li>
                <li><a href="/">Values</a></li>
                <li><a href="/contact">Contact</a></li>
                <li><a href="/">Blog</a></li>
                <li><a href="/terms">Terms</a></li>
                <li><a href="/register">Sign up</a></li>
                <div id="myNav" class="overlay">
            </ul>
            <ul>
                {{-- <a href="/welcome"><i class="fab fa-facebook"></i></a> --}}
                {{-- <li><a href="https://www.facebook.com/sharer/sharer.php?u=http://" class="social-button " id=""><span class="fa fa-facebook-official"></span></a></li> --}}
                {{-- <a href="#" class="fa fa-twitter"></a>
                <a href="#" class="fa fa-google"></a>
                <a href="#" class="fa fa-linkedin"></a> --}}

            </ul>
        </div>
        <div id="typed-strings">
                <p>Oops! You stumbled accross <strong>Tweeter</strong>
                <h1>Why Tweeter?</h1>
                <p>Want to <em>know</em> more check out our new features, and packages taliored to suit your needs.</p>
        </div>
        <span id="typed"></span>

            <h1 class="marketing-title">Why Tweeter?</h1>

        <article class="market-article" id="react-root">
            See whats going on in your community or around the globe, stay connected with friends, family, co-workers, or just hang out and make new friends.
            Have a business you want to promote or advertise we have the solution.
        </article>
        <div class="slideshow-container">

            <div class="mySlides fade">
              <div class="numbertext">1 / 3</div>
              <img src="images/social-net-girl.jpg" style="width:100%">
              <div class="text">Casual</div>
            </div>

            <div class="mySlides fade">
              <div class="numbertext">2 / 3</div>
              <img src="images/social-media.png" style="width:100%">
              <div class="text">Business Innovation</div>
            </div>

            <div class="mySlides fade">
              <div class="numbertext">3 / 3</div>
              <img src="images/social-media1.jpg" style="width:100%">
              <div class="text">Networking</div>
            </div>

        </div>
        <br>

        <div style="text-align:center">
          <span class="dot"></span>
          <span class="dot"></span>
          <span class="dot"></span>
        </div>
        <div id="app"></div>
        <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.9"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        {{-- <script src="js/anijs-min.js"></script> --}}
        <script type="text/javascript" src="{{url::asset('js/marketing.js') }}" ></script>
        <script>
              var typed = new Typed('#typed', {
                stringsElement: '#typed-strings'
              });

        </script>
        <script>
        var slideIndex = 0;
        showSlides();

        function showSlides() {
          var i;
          var slides = document.getElementsByClassName("mySlides");
          var dots = document.getElementsByClassName("dot");
          for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
          }
          slideIndex++;
          if (slideIndex > slides.length) {slideIndex = 1}
          for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
          }
          slides[slideIndex-1].style.display = "block";
          dots[slideIndex-1].className += " active";
          setTimeout(showSlides, 2000); // Change image every 2 seconds
        }
    </script>
    @include('partials.footer')
    </body>
</html>
