@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-10">
            <div class="card pub-image pub-image-detail">

                @include('includes.message')
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
                        <?php $user_like = false; ?>
                        @foreach ($image->likes as $like)
                        @if ($like->user_id == Auth::user()->id)

                        <?php $user_like =true; ?>

                        @endif
                        @endforeach

                        @if ($user_like)
                        <img src="{{ asset('img/heart-red.png') }}" alt="" data-id="{{ $image->id }}"
                            class="btn-dislike">
                        @else

                        <img src="{{ asset('img/heart-black.png') }}" alt="" data-id="{{ $image->id }}"
                            class="btn-like">

                        @endif
                        {{ count($image->likes) }}
                    </div>

                    @if ($image->user_id == Auth::user()->id)

                    <div class="actions">
                        <a href="{{ route('image.edit',['id' => $image->id]) }}" class="btn btn-primary btn-sm">Acutalizar</a>
                        {{-- <a href="{{ route('image.delete', ['id' => $image->id]) }}"class="btn btn-danger btn-sm">Borrar</a> --}}

                        <!-- Button to Open the Modal -->
                        <button type="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal">
                            Eliminar
                        </button>

                        <!-- The Modal -->
                        <div class="modal" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">¿Estás seguro?</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        Si eliminas esta imagen no podras recuperarla, ¿estás seguro de querer borrar?.
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                                        <a href="{{ route('image.delete', ['id' => $image->id]) }}"class="btn btn-danger ">Borrar definitivamente</a>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    @endif


                    <div class="clearfix"></div>

                    <div class="comments">

                        <h2>Comentarios ({{ count($image->comments) }})</h2>
                        <hr>

                        <form action=" {{route('comment.save')}} " method="POST">
                            @csrf
                            <input type="hidden" name="image_id" value="{{ $image->id }}">

                            <p><textarea class="textarea" name="content" class="from-control" id=""></textarea></p>

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
                            <span
                                class="nickname">{{' | '.\Carbon\Carbon::now()->diffForHumans($comment->created_at)}}</span>
                            <p>{{$comment->content}}</p>

                            @if ($comment->user_id == \Auth::user()->id || $comment->image->user_id ==
                            \Auth::user()->id)

                            <a href=" {{ route('comment.delete', ['id' => $comment->id])}}"
                                class="btn btn-danger btn-sm">Eliminar</a>

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