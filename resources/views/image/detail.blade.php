@extends('layouts.app')

@section('content')
<div class="container">
    @include('includes.message')
    <div class="row justify-content-center">
        
        <div class="col-md-10">
            <div class="card pub-image">
            
            <div class="card-header">
                
                @if ($image->user->image)
                
                
                <div class="container-avatar">
                    
                        <img src=" {{url('user/avatar/'.$image->user->image)}}" alt="" class="avatar">
                </div>
                
                @endif

                <div class="data-user">
                    
                
                    {{$image->user->name.' '.$image->user->surname}} 
                    
                    <span class="nickname"> {{' | @'.$image->user->nick}}</span>
                </div>
            
            
            </div>

                <div class="card-body">

                <div class="image-container">

                    <img src="{{ route('image.file', ['filename' => $image->image_path ]) }}" alt="">

                </div>

                

                <div class="description">
                    <span class="nickname">{{'@'.$image->user->nick}}</span>

                    <span class="nickname">{{' | '.\Carbon\Carbon::now()->diffForHumans($image->created_at)}}</span>
                    
                    <p>{{$image->description}}</p> 
                </div>

                
                <div class="likes">
                    <img src="{{ asset('img/heart-black.png') }}" alt="">
                </div>
                
                <div class="comments">
                    
                    <a href="" class="btn btn-warning tn-sm btn-comments">
                        Comentarios ({{ count($image->comments) }})
                    </a>
                </div>

                     

                  
                   
                </div>
            </div>
           
            {{-- Paginacion --}}
            <div class="clearflix"></div>
        </div>

    </div>
</div>
@endsection
