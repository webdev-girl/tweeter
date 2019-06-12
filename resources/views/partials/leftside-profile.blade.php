<div class="col-sm-4 left-profile">
    <div class="container">
        <div class="col-md">
           <div class="card card-default">
               <div class="card-header header">
                 @foreach ($tweets as $tweet)
                      @endforeach
                   <div class="profile-contact">
                       <div class="profile-header-img">

                            {{-- <img class="rounded-circle" src="/storage/avatars/{{ $tweet->user }}" /> --}}
                           <!-- badge -->
                            <div class="rank-label-container">
                               <span class="label label-default rank-label">{{$tweet->user}}</span>
                           </div>
                       </div>
                        <div>
                           <a class="home-left-profile-links" href="/moments"><h6 class="profile-header-name">{{$tweet->user}}</h6></a>
                         </div>
                         <div>
                         <a class="home-left-profile-links" href="/moments">{{$tweet->user->email}}</a>
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

                            </div>
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
{{--
@foreach ($tweets as $tweet)
    <p><b> {{$tweet->tweet}} <b><br/>
    by {{$tweet->user->name}} </p>
    at {{$tweet->created_at}}
       {{-- {{$createdDate}} --}}
 {{-- <div class="container">
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
    @endforeach  --}}
