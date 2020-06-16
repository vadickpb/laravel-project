@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('includes.message')
        
        <div class="col-md-8">
        @foreach ($images as $image)
            <div class="card pub-image">
            
            <div class="card-header">
                <div class="container-avatar">

                    @if ($image->user->image)


                    <div class="data-user">
                        <img src=" {{url('user/avatar/'.$image->user->image)}}" alt="" class="avatar">
                    </div>
                    @endif

            
                </div>
                {{$image->user->name.' '.$image->user->surname }} 
            
            </div>

                <div class="card-body">
                     

                  
                   
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
