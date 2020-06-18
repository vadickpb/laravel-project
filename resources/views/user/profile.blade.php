@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="data-user profile">



                @if ($user->image)

                <div class="container-avatar">
                    <img src="{{ route('user.avatar', ['filename' => $user->image]) }}" alt="">
                </div>

                @endif



                <div class="user-info">
                    
                    <h1>{{'@'. $user->nick }}</h1>
                    <h1>{{ $user->name.' '.$user->surname }}</h1>
                    <span class="nickname">{{'Se unió: '.\Carbon\Carbon::now()->diffForHumans($user->created_at)}}</span>

                    <p>{{ $user->description }}</p>

                </div>



            </div>



            @foreach ($user->images as $image)
            @include('includes.image',['image'=>$image])
            @endforeach
            {{-- Paginacion --}}

        </div>

    </div>
</div>
@endsection