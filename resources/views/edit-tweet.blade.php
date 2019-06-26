@extends('layouts.app')

@section('content')

    <div class="container fluid ">
        <div class="row">
            <div class="col-sm-5">
                <div class="container">
                    <div class="row" >
                        <div class="col-md">
                            <div class="card card-default">
                                <div class="card-header">

                                </div>

                                <div class="card-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm">
                                                <p><a href="/moments">Rachel Sakac</a></p>
                                                <br/>
                                                <p><a href="/moments">@sakac934</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <div class="card-header">
                                <div class="container ">
                                    <form method="post" action="edit-tweet">
                                        @csrf
                                        <textarea class="tweets-edit">{{$tweet->tweet}}</textarea>
                                    </form>
                                        <a href="/edit-tweet/{{$tweet->id}} = {{$tweet->id}}">Edit</a> {{$tweet->user->name}} @ {{ $tweet->created_at}}

                                    <form name="editTweet" method="post" action="edit-tweet">
                                        @csrf
                                        <textarea class="form-control" name="comment" placeholder="Edit Tweet" value="{{$tweet->tweet}}"></textarea>
                                        <input type="hidden" name="tweet_id" value="{{$tweet->id}}" />
                                        <button class="btn btn-success">Edit Tweet</button>
                                    </form>

                                    <form method="POST" action="/edit-tweet/{{ $tweet->id }}">
                                      @csrf
                                     @foreach ($tweets as $tweet)
                                         <p><b> {{$tweet->tweet}}<b></p>
                                         @endforeach
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <img class="tweet-avatar" src="images/profile.png" alt="profile">
                                            </div>
                                            <div class="col-sm">
                                                <textarea name="edit-tweet" class="form-control" rows="1" placeholder="What's happening?">
                                                {{$tweet->tweet}}</textarea>
                                             </div>
                                                <input type="text" name="id" value="{{ $tweet->id }}" >
                                                <input type="hidden" name="user_id" value="{{$tweet->user_id}}">
                                                <input type="hidden" name="tweet" value="{{$tweet->tweet}}">
                                             <div class="col-md-8 offset-md-4">
                                                <form method="POST" action="/edit-tweet">
                                                    <input name = "_method" type = "hidden" value="PUT">
                                                    <input type="hidden" name="id" value="{{ $tweet->id }}" >
                                                    <input type="hidden" name="tweet" value=" {{$tweet->tweet}}">
                                                </form>
                                                <button type="submit" class="btn btn-primary">
                                                    <a href="/feed" >{{ __('Edit Tweet') }}</a>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                 </div>
                                 <h1 class="title">Edit Tweet</h1>
                                <form action="/edit-tweet/{{ $tweet->id }}" method="POST">
                                    <input type="hidden" name="_method" value="PUT">
                                    
                                </form>
                                <form action="/edit-tweet/{{ $tweet->id }}" method="POST">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                <div class="card-body">
                                    <a href="/feed" >Edit</a>

                                    @php
                                         if(isset($tweet->like) && ($tweet->like == true)){

                                            }else{
                                                }
                                                 @endphp

                                   <div class="container">
                                         <div class="row">
                                               <div class="col-md-4 flex-container">
                                                   <form method="POST" action="/like-tweet" >
                                                    @csrf
                                                        <input type="hidden" name="tweet_id" value="{{$tweet->id}}"/>
                                                        <input type="hidden" name="like" value="1"/>
                                                        <button type="submit" class="btn btn-primary"><i class="fa fa-heart"></i>{{ __('like') }}</button>
                                                        <button class="btn btn-default like btn-login" ng-click="like()">
                                                          <i class="fa fa-heart"></i>
                                                             <span>@{{ like_btn_text }}</span>
                                                         </button>
                                                   </form>
                                                </div>
                                                <div class="col-md-4">
                                                    <form method="POST" action="/like-tweet">
                                                    @csrf
                                                        <input type="hidden" name="tweet_id" value="{{$tweet->id}}"/>
                                                        <input type="hidden" name="like" value="0"/>
                                                        <button type="submit" class="btn btn-primary">{{ __('Unlike') }}</button>
                                                        <button class="btn btn-default like btn-login" ng-click="like()">
                                                            <i class="fa fa-thumbs-o-down"></i>
                                                             <span>@{{ like_btn_text }}</span>
                                                       </button>
                                                   </form>
                                                </div>
                                                <div class="col-md-4">
                                                   <form method="POST" action="/delete">
                                                     @csrf
                                                        {{$tweet->id}}
                                                        <p>{{'Tweet has been deleted successfully!'}}</p>
                                                        <input type="hidden" name="tweet_id" value="{{$tweet->id}}"/>
                                                        <input type="hidden" name="_method" value="DELETE"/>
                                                        <button type="submit" class="btn btn-primary">{{ __('Delete') }}</button>
                                                        <button class="btn btn-default like btn-login" ng-click="like()">
                                                           <i class="fa fa-trash"> </i>
                                                           <span>@{{ like_btn_text }}</span>
                                                        </button>
                                                          <i>&#xf014;</i>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <form method="POST" action="comment">
                                        @csrf
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-sm-1">
                                                        <img class="tweet-avatar" src="images/profile.png" alt="profile">
                                                    </div>
                                                    <div class="col-sm">
                                                        <textarea name="comment" class="form-control" rows="1" placeholder="What's happening?" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm">
                                                    <input type="hidden" name="tweet_id" value="{{$tweet->id}}"/>
                                                    <button type="submit" class="btn btn-primary"> {{ __('Comment') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                        <form method="POST" action="">
                                        @csrf
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-sm-1">
                                                        <img class="tweet-avatar" src="images/profile.png" alt="profile">
                                                    </div>
                                                    <div class="col-sm">
                                                        <textarea name="comment" class="form-control" rows="1" placeholder="What's happening?" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm">
                                                     <input type="hidden" name="tweet_id" value="{{$tweet->id}}"/>
                                                    <button type="submit" class="btn btn-primary"> {{ __('Comment') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
