@include('partials.header')

@section('content')

    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
               {{-- <a class="navbar-brand" href="{{ url('/') }}">
                   {{ config('app.name', 'Laravel') }}
               </a> --}}
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                   <span class="navbar-toggler-icon"></span>
               </button>

               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                   <!-- Left Side Of Navbar -->
                   <ul class="navbar-nav mr-auto">
                       <li><a class="login" class="navbar-brand" href="{{ url('/welcome') }}"><img src="../images/twitterbird.png" width="23px" height="23px">Home</a></li>
                       <li><a href="/moments">Moments</a></li>
                       <li><a href="/notifications">Notifications</a></li>
                       <li><a href="/messages">Messages</a></li>
                       <li><i class="fab fa-twitter"></i></li>

                       <div class="input-append">
                           <input class="span2" type="text">
                           <button type="submit" class="btn">
                                <i class="fa fa-search"></i>
                           </button>
                       </div>


                       <li><a href="/profile">Profile</a></li>
                       <li><a href="{{ url('/logout') }}"> logout </a></li>
                   </ul>

                   <!-- Right Side Of Navbar -->
                   <ul class="navbar-nav ml-auto">
                       <!-- Authentication Links -->
                       @guest
                           <li class="nav-item">
                               <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                           </li>
                           @if (Route::has('register'))
                               <li class="nav-item">
                                   <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                               </li>
                           @endif
                       @else
                           <li class="nav-item dropdown">
                               <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   {{ Auth::user()->name }} <span class="caret"></span>
                               </a>

                               <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                      onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                       {{ __('Logout') }}
                                   </a>

                                   <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                       @csrf
                                   </form>
                               </div>
                           </li>
                       @endguest
                   </ul>
               </div>
           </div>
       </nav>
       <div class="container-fluid timeline-div">
           <div class="row">
               <div class="col-sm-4 left-profile">
                   <div class="container">
                       <div class="col-md">
                          <div class="card card-default">
                              @foreach ($tweets as $tweet)
                              @endforeach
                              <div class="card-header header">

                                   <div class="profile-contact">
                                       <div>
                                          {{-- <a href="/moments"><h6 class="profile-header-name">{{$tweet->user->name}}</h6></a> --}}
                                        </div>
                                        <div>
                                           <a href="/moments">{{$tweet->user->email}}</a>
                                        </div>
                                       <div class="row">
                                            <div class="col-sm-4">
                                                <a href="/moments">Tweets</a>
                                            </div>
                                            {{-- {{$count}} --}}
                                            <div class="col-sm">
                                                <a href="/moments">Following</a>
                                          </div>
                                       </div>
                                        <div class="container">
                                            <div class="col-sm">
                                                Who to follow
                                                <a href="">.Refresh</a>
                                                <a href="https://twitter.com/who_to_follow/suggestions">.View all</a>
                                            </div>
                                       </div>
                                       <br/>
                                   </div>
                               </div>

                               <div class="card-body">
                                       @foreach ($names as $name)
                                   <div class="container">
                                       <div class="fb-profile">

                                           <div class="col-sm-1">
                                               <a href="user-display"><img class="tweet-avatar" src="images/profile.png" alt="profile" ></a>
                                           </div>
                                            <img align="left" class="fb-image-lg" src="" alt="Profile image example"/ style="margin-top:0;">
                                            <img align="left" class="fb-image-profile thumbnail" src="" alt="Profile image example"/>
                                           <div>
                                               <h4>{{$names->name}}</h4>
                                           </div>
                                           <div>
                                              <div>
                                                  <a href="user.follow/{user->id}"class="btn btn-primary">{{ __('Follow') }}</a>
                                                  <a href="user.unFollow/{user->id}"class="btn btn-primary">{{ __('Un Follow') }}</a>
                                              </div>
                                           </div>
                                       </div>
                                   </div>
                               @endforeach
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
                   <div class="col-sm-8 card-right">
                       <div class="container">
                           <div>
                               <div class="col-md">
                                   <div class="card card-default">
                                       <div class="card-header right-card-header">
                                          <div class="container">
                                              <div class="row">
                                                  <div class="col-sm-1">
                                                      <img class="tweet-avatar" src="images/profile.png" alt="profile">
                                                  </div>
                                                  <div class="col-sm">
                                                     <form method="post" action="/tweet">
                                                      @csrf
                                                          <textarea name="tweet" class="form-control" rows="1" placeholder="What's happening?" required></textarea>
                                                          <button type="submit" class="btn btn-primary"> {{ __('Tweet') }}</button>
                                                       </form>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                   @foreach ($tweets as $tweet)
                                      <p><b> {{$tweet->tweet}} <b><br/>
                                           by {{$tweet->user->name}} </p>
                                      at {{$tweet->created_at}}
                                     {{$createdDate}}
                                       <div class="container">
                                          <div class="row">
                                              <div class="col-md-3 tweet-buttons">
                                                  <a href="/edit-tweet/{{$tweet->id}}"><i class="far fa-edit"></i></a>
                                              </div>
                                              <div class="col-md-3 tweet-buttons">
                                                  <form method="POST" action="/like-tweet">
                                                   @foreach ($countLikes as $countlike -> $tweet->id)
                                                      @endforeach
                                                   @csrf
                                                      <input type="hidden" name="tweet_id" value="{{ $tweet->id }}"/>
                                                      <input type="hidden" name="id" value="{{$tweet->id}}"/>
                                                      <input type="hidden" name="like" value="1"/>
                                                      <button class="btn btn-default like btn-like" ng-click="like()">
                                                          <i class="fa fa-heart"></i>
                                                       </button>
                                                {{$countLikes}}
                                                  </form>
                                              </div>
                                              <div class="col-md-3 tweet-buttons">
                                                  <form method="POST" action="/like-tweet" >
                                                  @csrf
                                                      <input type="hidden" name="tweet_id" value="{{ $tweet->id }}"/>
                                                      <input type="hidden" name="id" value="{{$tweet->id}}"/>
                                                      <input type="hidden" name="like" value="0"/>
                                                      <button type="submit" class="btn btn-default like btn-unlike" ng-click="like()">
                                                          <i class="fas fa-thumbs-down"></i>
                                                      </button>
                                                  </form>
                                              </div>
                                               <div class="col-md-3 tweet-buttons">
                                                  <form name="delete-form" method="post" action="delete-tweet">
                                                  @csrf
                                                         {{$tweet->id}}
                                                      <input type="hidden" name="_method" value="DELETE"/>
                                                      <input type="hidden" name="tweet_id" value="{{$tweet->id}}"/>
                                                      <button type="submit" class="btn btn-default like btn-delete" ng-click="like()">
                                                         <i class="fa fa-trash"> </i>
                                                      </button>
                                                  </form>
                                               </div>
                                           </div>
                                      </div>
                                  <div class="container">
                                      <div class="row">
                                          <div class="col-sm-2">
                                              <img class="comment-avatar" src="images/profile.png" alt="profile">
                                          </div>
                                           <div class="col-md-6">
                                              <form  method="POST" action="comment">
                                               @csrf
                                                  <textarea name="comment" class="form-control comment-box" rows="1" placeholder="What's happening?" required></textarea>
                                                  <input type="hidden" name="user_id"  value="{{ $tweet->user_id}}" />
                                                  <input type="hidden" name="tweet_id"  value="{{ $tweet->id}}" />
                                                  <button  type="submit" class="btn btn-primary"> {{ __('Comment') }}</button>
                                              </form>
                                          </div>
                                      </div>
                                      @foreach ($tweet->comments as $comment)
                                          <p><b> {{$comment->comment}}<b></p>
                                                 {{ $comment->name }}
                                              by {{$comment->user->name}}
                                      <div class="row">
                                          <div class="col-md-2 tweet-buttons">
                                              <a href="/edit-comment/{{$comment->id}}"><i class="far fa-edit"></i></a>
                                          </div>
                                          <div class="col-md-3 tweet-buttons">
                                              <form method="POST" action="/like-tweet">
                                               @csrf
                                                  <input type="hidden" name="comment_id" value="{{ $comment->id }}"/>
                                                  <input type="hidden" name="id" value="{{$comment->id}}"/>
                                                  <input type="hidden" name="like" value="1"/>
                                                  <button class="btn btn-default like btn-like" ng-click="Unlike()">
                                                      <i class="fa fa-heart"></i>
                                                   </button>
                                              </form>
                                           </div>
                                           <div class="col-md-3 tweet-buttons">
                                              <form method="POST" action="/like-tweet" >
                                              @csrf
                                                  <input type="hidden" name="comment_id" value="{{ $comment->id }}"/>
                                                  <input type="hidden" name="id" value="{{$comment->id}}"/>
                                                  <input type="hidden" name="like" value="0"/>
                                                  <button type="submit" class="btn btn-default like btn-unlike" ng-click="like()">
                                                      <i class="fa fa-thumbs-down"></i>
                                                  </button>
                                              </form>
                                           </div>
                                           <div class="col-md-3">
                                              <form name="delete-form" method="post" action="delete/{id}">
                                                  @csrf
                                                  <input type="hidden" name="_method" value="DELETE"/>
                                                  <input type="hidden" name="comment_id" value="{{$comment->id}}"/>
                                                  <button type="submit" class="btn btn-default like btn-delete" ng-click="like()">
                                                      <i class="fa fa-trash"></i>
                                                  </button>
                                              </form>
                                          </div>
                                       <hr/>
                                      </div>
                                  @endforeach
                                  </div>
                              @endforeach
                              </div>
                           </div>
                           <div>
                               <a class="twitter-timeline" data-width="650" data-height="1200" href="https://twitter.com/TwitterDev/timelines/539487832448843776?ref_src=twsrc%5Etfw">National Park Tweets - Curated tweets by TwitterDev</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   {{-- @include('partials.footer') --}}

@endsection
