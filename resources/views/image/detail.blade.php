@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-10">
            @include('includes.message')
            <div class="card pub-image pub-image-detail">
            
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

                <div class="image-container image-detail">

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
                <div class="clearfix"></div>
                
                <div class="comments">
                    
                        <h2>Comentarios ({{ count($image->comments) }})</h2>
                        <hr>

                        <form action=" {{route('comment.save')}} " method="POST">
                            @csrf
                        <input type="hidden" name="image_id" value="{{ $image->id }}">
                            
                                <p><textarea class="textarea" name="content" class="from-control" id=""  ></textarea></p>

                                @if($errors->has('content'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('content') }}</strong>
                                </span>
                                    
                                @endif
                            
            
                             <button class="btn btn-success">Enviar</button>
            
            
                        </form>

                        <hr>

                        @foreach ($image->comments as $comment)

                        <div class="comment">

                                <span class="nickname">{{'@'.$comment->user->nick}}</span>
                                <span class="nickname">{{' | '.\Carbon\Carbon::now()->diffForHumans($comment->created_at)}}</span>                   
                                <p>{{$comment->content}}</p> 

                                @if ($comment->user_id == \Auth::user()->id  || $comment->image->user_id == \Auth::user()->id)
                                
                                <a href=" {{ route('comment.delete', ['id' => $comment->id])}}" class="btn btn-danger btn-sm">Eliminar</a>

                                @endif

                        </div>
                            
                        @endforeach
                        
                    </div>


                     

                  
                   
                </div>
            </div>
           
            {{-- Paginacion --}}
            <div class="clearflix"></div>
        </div>

    </div>
</div>
@endsection
