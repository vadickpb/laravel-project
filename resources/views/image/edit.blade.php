@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Editar mi imagem</div>

                <div class="card-body">
                    <form action="{{ route('image.update') }}  " method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="image_id" value="{{ $image->id }}">
                        <div class="form-group row">

                            <label for="image_path" class="col-md-4 col-form-label text-md-right">Imagen</label>
                            
                            <div class="col-md-7">
                               
                                @if ($image->image_path)
        
                                <div class="container-avatar image-edit">
                                    <img src=" {{ route('image.file', ['filename' => $image->image_path ]) }}" alt="" class="avatar">
                                </div>
        
                                @endif
                                
                                <input type="file" name="image_path" class="form-control" id="">
                                


                                {{-- @error('image_path')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror --}}
                            </div>


                        </div>

                        <div class="form-group row">

                            <label for="description" class="col-md-4 col-form-label text-md-right">Descripcion</label>
                            <div class="col-md-7">

                                <textarea id="description" name="description" class="form-control">
                                {{ $image->description }}
                                </textarea>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-7 offset-md-4">

                                <input type="submit" class="btn btn-success" value="editar">

                            </div>

                        </div>



                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection