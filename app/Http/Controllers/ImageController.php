<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Comment;
use App\Like;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;



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
        $user = Auth::user();

        $image->user_id = $user->id;
        $image->description = $descripcion;
        

        if($image_path){

            //guardar lla imagen
            $image_path_name = time().$image_path->getClientOriginalName();
            
            //guardar la imagen en la carpeta storage image
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            
            //setear la imagen
            $image->image_path = $image_path_name;

        }

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

    public function detail($id){
        $image = Image::find($id);

        return view('image.detail', [
            'image' => $image
        ]);
    }

    public function delete($id){

        $user = Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();

        if($user && $image && $user->id == $image->user_id){

            //eliminar los comentarios
            if($comments && count($comments) >= 1){
                foreach($comments as $comment){
                    $comment->delete();
                }

            }

            //eliminar los likes

            if($likes && count($likes) >= 1){
                foreach($likes as $like){
                    $like->delete();
                }

            }


            //eliminar ficheros de imagen en el storage
            Storage::disk('images')->delete($image->image_path);

            //eliminar registro de la imagen
            $image->delete();

            $message = ['message' => 'la imagen se ha borrado correctamente'];


        }else{
            $message = ['message' => 'la imagen no se ha borrado correctamente'];
        }

        return redirect()->route('home')
                        ->with($message);

    }

    public function edit($id){
        $user = Auth::user();
        $image= Image::find($id);

        if($user && $image && $image->user->id == $user->id){
            return view('image.edit', [
                'image' => $image
            ]);
        }
    }


    public function update(Request $request){
        
         //validar los datos

         $validate = $this->validate($request, [
            'description' => ['required'],
            'image_path' => ['image']
        ]);
        
       
        
        //recojer datos
        $image_id = $request->input('image_id');
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        

        //conseguir objeto imagen
        $image=Image::find($image_id);
        $image->description=$description;


        
        //subir fichero
        if($image_path){
    
            //guardar lla imagen
            $image_path_name = time().$image_path->getClientOriginalName();            
            //guardar la imagen en la carpeta storage image
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            //setear la imagen
            $image->image_path = $image_path_name;
    
        }
       
        //actualizar registro

        $image->update();

        return redirect()->route('image.detail',['id' => $image_id])
                         ->with(['message' => 'los datos se actualizaron correctamente']);
        
        
    }
}
