    <div class="container-fluid timeline-div">
        <div class="row">
            <div class="col-sm-4 left-profile">
                <div class="container">
                    <div class="col-md">
                       <div class="card card-default">
                           <div class="card-header header">
                             @foreach ($tweets as $tweet)
                                  @endforeach
                               <div class="profile-contact">
                                   <div class="profile-header-img">

                                         {{-- <img class="rounded-circle" src="/storage/avatars/{{ $tweet->user }}" />  --}}
                                       <!-- badge -->
                                         <div class="rank-label-container">
                                           {{-- <span class="label label-default rank-label">{{$tweet->user}}</span> --}}
                                       </div>
                                   </div>
                                    <div>
                                       {{-- <a class="home-left-profile-links" href="/moments"><h6 class="profile-header-name">{{$tweet->user}}</h6></a> --}}
                                     </div>
                                     <div>
                                     {{-- <a class="home-left-profile-links" href="/moments">{{$tweet->user->email}}</a> --}}
                                     </div>
                                    <div class="row">
                                         <div class="col-sm-4">
                                             <a class="home-left-profile-links" href="/moments">Tweets</a>
                                         </div>

                                         <div class="col-sm">
                                             <a class="home-left-profile-links" href="/moments">Following</a>
                                       </div>
                                    </div>
                                     <div class="container">
                                         <div class="col-sm">
                                             <p class="home-left-profile-text">Who to follow</p>
                                             <a class="home-left-profile-links" href="">.Refresh</a>
                                             <a class="home-left-profile-links" href="https://twitter.com/who_to_follow/suggestions">.View all</a>
                                         </div>
                                    </div>
                                    <br/>
                                 </div>
                             </div>
                            <div class="card-body">

                                 <div class="container">
                                    <div class="fb-profile">
                                        <div class="col-sm-1">
                                            <a href="user-display"><img class="tweet-avatar" src="images/profile.png" alt="profile" ></a>
                                            {{-- <img src="/my/path/{{ $item->picture }}" > --}}
                                          {{-- <img src="{{ $user->avatar }}" > --}}
                                           {{-- <img src="resources/storage/avatars.jpg" > --}}
                                            {{-- { <img class="rounded-circle" src="/storage/avatars/{{ avatar }}" /> --}}

                                        {{-- </div>
                                        <div>
                                            {{-- <h4>{{$name->name}}</h4> --}}
                                         </div>
                                        <div>
                                           <div>
                                               <a href="user.follow/{user->id}"class="btn btn-primary">{{ __('Follow') }}</a>
                                               <a href="user.unFollow/{user->id}"class="btn btn-primary">{{ __('Un Follow') }}</a>

                                           </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-sm-4 left-profile">
                @include('partials.leftside-profile')
            </div> --}}
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
                                                <div id="tweetsWrapper">
                                                     <tweet-component v-for="tweet in tweets" :tweet=tweet></tweet-component>
                                                 </div>
                                                 <div id="app">
                                                     <div class="container">
                                                         <search-bar></search-bar>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--<script>

    currentLoggedInUserUserId = {{ $user->id }};

</script> --}}
