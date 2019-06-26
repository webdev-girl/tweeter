    <div class="container-fluid timeline-div">
        <div class="row">
            <div class="col-sm-4 left-profile">
                <div class="container">
                    <div class="col-md">
                       <div class="card card-default">
                           <div class="card-header header">
                               @foreach ($tweets as $tweet)
                               @endforeach
                               {{-- {{ $tweets->links() }} --}}
                               <div class="profile-contact">
                                   <div class="profile-header-img">
                                        {{-- <img class="rounded-circle" src="/storage/avatars/{{ $User->user }}" />  --}}
                                       <!-- badge -->
                                    </div>
                                    <div>
                                        <a class="home-left-profile-links" href="/moments"><h6 class="profile-header-name">{{$user->name}}</h6></a>
                                     </div>
                                     <div>
                                         <a class="home-left-profile-links" href="/moments">{{$user->email}}</a>
                                     </div>
                                    <div class="row">
                                         <div class="col-sm-4">
                                             <a class="home-left-profile-links" href="/moments">Tweets</a>
                                         </div>
                                         {{-- {{$count}} --}}
                                         <div class="col-sm">
                                             <a class="home-left-profile-links" href="/moments">Following</a>
                                       </div>
                                    </div>
                                    <br/>
                                </div>
                            </div>
                            <div class="card-body">
                                 <p class="home-left-profile-text">Who to follow</p>
                                 <small><a href="#">Refresh</a> ● <a href="#">View all</a></small>
                                 <br/>
                                 <br/>
                            {{-- <div class="panel-heading">
                                <h3 class="panel-title">
                                    <small><a href="#">Refresh</a> ● <a href="#">View all</a></small>
                                </h3>
                            </div> --}}

                             @foreach ($names as $name)
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
                                             <img src="https://upload.wikimedia.org/wikipedia/fr/c/c8/Twitter_Bird.svg" height="20" width="20"/>
                                        </div>
                                        <div>
                                             <h4>{{ $name->name }}</h4>
                                         </div>
                                        <div id="app">
                                            <follow-component></follow-component>
                                        </div>
                                        {{-- <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td clphpass="table-text"><div>{{ $user->name }}</div></td>
                                                @if (auth()->user()->isFollowing($user->id))
                                                    <td>
                                                        <form action="{{route('unfollow', ['id' => $user->id])}}" method="POST">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}

                                                            <button type="submit" id="delete-follow-{{ $user->id }}" class="btn btn-danger">
                                                                <i class="fa fa-btn fa-trash"></i>Unfollow
                                                            </button>
                                                        </form>
                                                    </td>
                                                @else
                                                    <td>
                                                        <form action="{{route('follow', ['id' => $user->id])}}" method="POST">
                                                            {{ csrf_field() }}

                                                            <button type="submit" id="follow-user-{{ $user->id }}" class="btn btn-success">
                                                                <i class="fa fa-btn fa-user"></i>Follow
                                                            </button>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table> --}}
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
                                                <div class="col-sm-2">
                                                    {{ Auth::user()->name }}
                                                    <img class="tweet-avatar" src="images/profile.png" alt="profile">
                                                </div>
                                                <div class="col-sm">
                                                 <form method="post" action="/tweet">
                                                   @csrf
                                                    <textarea name="tweet" class="form-control" rows="1" placeholder="What's happening?" required></textarea>
                                                    <button type="submit" class="btn btn-primary"> {{ __('Tweet') }}</button>
                                                </form>
                                                <div id="app">
                                                     <tweet-component v-for="tweet in tweets" :tweet=tweet></tweet-component>
                                                </div>
                                              {{-- <upload-component :user="{{auth()->user()}}"></upload-component> --}}
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

        <div class="media">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">

                            @if(auth()->user()->isNot($user))
                            @if(auth()->user()->isFollowing($user))
                            <a href="{{ route('users.unfollow', $user) }}" class="btn btn-danger">No Follow</a>
                            @else
                            <a href="{{ route('users.follow', $user) }}" class="btn btn-success">Follow</a>
                            @endif
                            @endif

                        </div>
                    </div>
                </div>
        </div>


<script>

    currentLoggedInUserUserId = {{ $user->id }};

</script>
