@extends('layouts.app')

@section('content')
<div class="container">
    @include('includes.message')
    <div class="row justify-content-center">
        
        <div class="col-md-8">
        @foreach ($images as $image)

            @include('includes.image',['image'=>$image])

            
            @endforeach
            {{-- Paginacion --}}
            <div class="clearflix"></div>
            {{$images->links()}}
        </div>

    </div>
</div>
@endsection
