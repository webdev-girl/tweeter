
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ ('Tweeter') }}</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>
        <link rel="icon" type="image/x-icon" href="../images/favicon.png">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('../css/tweeter.css')}}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body class="index-bg">
        <div class="container-fluid margin">
            <div class="row">
                <div class="col-sm">
                     <image class="left-side-image-index" src="../images/backimage.png" alt="birdwing"/>
                </div>
                <div class="col-sm right-side-index">
                   <div>
                       <div class="row">
                           <div class="col-sm">
                               <img class="right-side-image-index" src="images/twitterbird.png" alt="bird">
                           </div>
                           <div class="col-sm">
                               <a id="index-top-login" href="/login" class="w3-btn w3 index-login-top-button">Login</a>
                           </div>
                       </div>
                       <div class="main-content">
                            <ul>
                                <li><h2>See whats happening</h2></li>
                                <li class="margin-content"><h2>in the world right now<h2></li>
                                <li><h5>Join Tweeter today.</h5></li>
                                @if (Route::has('login'))
                                <div>
                                    @auth
                                     <a href="{{ url('home') }}">Home</a>
                                    @else
                                    <li><a href="{{ route('login') }}" class="w3-btn w3 index-login-button" >Login</a></li>

                                        @if (Route::has('register'))
                                    <li><a href="{{ route('register') }}" class="w3-btn w3 index-signup-button" >Sign Up</a></li>
                                        @endif
                                    @endauth
                                </div>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
             
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    @include('partials.footer')
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    </body>
</html>
