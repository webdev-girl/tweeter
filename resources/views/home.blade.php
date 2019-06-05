@extends('layouts.app')

 @section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

@php
    use App\Tweets;
    $tweets = Tweets::orderBy('created_at', 'DESC')->get();
@endphp

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
                                            {{-- <a href="/moments">{{$tweet->user->email}}</a> --}}
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <a href="/moments">Tweets</a>
                                            </div>
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
                                   <div id="tweetsWrapper">
                                        <tweet-component v-for="tweet in tweets" :tweet=tweet></tweet-component>
                                    </div>

                                   <div class="container">

                                        <div class="row">
                                            <div class="col-md-3 tweet-buttons">
                                                <a href="/edit-tweet"><i class="far fa-edit"></i></a>
                                            </div>
                                            <div class="col-md-3 tweet-buttons">
                                                <form name="delete-form" method="post" action="delete-tweet">
                                                @csrf

                                                </form>
                                                  {{-- <form name="deleteform" method="POST" action="">
                                                     @csrf
                                                     <input type="hidden" name="_method" value="destroy" />
                                                     <input type="hidden" name="tweet_id" value="" />
                                                     <button class="btn btn-sm delete-btn">Remove</button>
                                                </form> --}}
                                             </div>
                                        </div>
                                    </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            {{-- <img class="comment-avatar" src="images/profile.png" alt="profile"> --}}
                                        </div>
                                        <div class="col-md-6">
                                            <form  method="POST" action="/comment">
                                            @csrf

                                            </form>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 tweet-buttons">
                                            <a href="/edit-comment/"><i class="far fa-edit"></i></a>
                                        </div>
                                        <div class="col-md-3 tweet-buttons">

                                        </div>
                                        <div class="col-md-3 tweet-buttons">

                                        </div>
                                        <div class="col-md-3">
                                            <form name="delete-form" method="post" action="delete/{id}">
                                             @csrf
                                                <input type="hidden" name="_method" value="DELETE"/>
                                                <input type="hidden" name="comment_id" value=""/>
                                                <button type="submit" class="btn btn-default like btn-delete" ng-click="like()">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                             </form>
                                        </div>
                                     <hr/>
                                    </div>
                                </div>
                            </div>
                         </div>
                         <div>
                               {{-- <a class="twitter-timeline" data-width="650" data-height="1200" href="https://twitter.com/TwitterDev/timelines/539487832448843776?ref_src=twsrc%5Etfw">National Park Tweets - Curated tweets by TwitterDev</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> --}}
                        </div>
                    </div>
                </div>
             </div>
         </div>
    </div>
@endsection
<script>

    currentlyLoggedInUserInUserId = {{ $user->id }};

</script>
