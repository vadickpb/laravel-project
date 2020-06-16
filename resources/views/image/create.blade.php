@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card">
                <div class="card-header">Subir nueva imagen</div>

                <div class="card-body">
                    <form action=" {{route('image.save')}} " method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="image_path" class="col-md-4 col-form-label text-md-right" >Imagen</label>

                            <div class="col-md-7">
                                
                                <input type="file" name="image_path" class="form-control" id="">


                                @if ($errors->has('image_path'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image_path') }}</strong>
                                </span>
                                    
                                @endif

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
                                
                                <input type="submit" class="btn btn-success ">
    
                            </div>
    
                        </div>



                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection