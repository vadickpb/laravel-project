<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        
        return view('image.create');
    }
    
    public function save(Request $request){

        //validar los datos

        $validate = $this->validate($request, [
            'description' => ['required'],
            'image_path' => ['required', 'image']
        ]);

        //recojer los datos
        $image_path = $request->file('image_path');
        $descripcion = $request->input('description');
        
        //Asignar valores al objeto
        $image = new Image();
        $user = \Auth::user();

        $image->user_id = $user->id;
        $image->description = $descripcion;
        
        //guardar lla imagen
        $image_path_name = time().$image_path->getClientOriginalName();
        
        //guardar la imagen en la carpeta storage image
        Storage::disk('images')->put($image_path_name, File::get($image_path));
        
        //setear la imagen
        $image->image_path = $image_path_name;

        //guardar los datos en la bd
        $image->save();

        //redirect a home con mensaje de confirmacion
        return redirect()->route('home')
                        ->with(['message'=>'La imagen se guardó correctamente!!']);

        


    }

    public function getImage($filename){

        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);


    }
}
