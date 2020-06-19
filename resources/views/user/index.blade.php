@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <h1>Usuarios</h1>

            <form action="{{ route('user.index') }}" method="GET" id="buscador">
            @csrf
            
            <div class="row">

                <div class="form-group col">
                    <input type="text" id='search'  class="form-control">
                </div>
    
    
                <div class="form-group col">
                    <input type="submit" class="btn btn-success" value="Buscar">
                </div>
                    
                </form>

            </div>

            <hr>
            @foreach ($users as $user)
                
            <div class="data-user profile user-profile">

                
                
                
                
                @if ($user->image)
                
                <div class="container-avatar">
                    <img src="{{ route('user.avatar', ['filename' => $user->image]) }}" alt="">
                </div>
                
                @endif
                
                
                
                <div class="user-info">
                    
                    <h2>{{'@'. $user->nick }}</h2>
                    <h3>{{ $user->name.' '.$user->surname }}</h3>
                    <span class="nickname">{{'Se unió: '.\Carbon\Carbon::now()->diffForHumans($user->created_at)}}</span>
                    
                    <p>{{ $user->description }}</p>
                    <a href="{{ route('profile',['id' => $user->id]) }}" class="btn btn-success">Perfil</a>

                </div>
                
                

            </div>

            <hr>
            
            
            
         
            {{-- Paginacion --}}
            @endforeach
            <div class="clearflix"></div>
            {{$users->links()}}
            
        </div>
        
    </div>
</div>
@endsection