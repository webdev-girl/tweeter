@extends('layouts.app')

@section('content')

<div class="">
    @include('partials.tweets')
</div>
@endsection
<script>
    currentLoggedInUserUserId = {{ $user->id }};
</script>
