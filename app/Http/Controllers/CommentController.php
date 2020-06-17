<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request){

        //validar los datos
        $validate = $this->validate($request, [
            'image_id' => ['int'],
            'content' => ['string', 'required']
        ]);
        
        $user= Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');

        

        //asigno los valores al objeto
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        //guardar en la base de datos
        $comment->save();

        return redirect()->route('image.detail', ['id' => $image_id])
                        ->with(['message' => 'el comentario se guardo correctamente']);
      
    }
    
    public function delete($id){

        //conseguir el objeto usuario
        $user = Auth::user();

        //conseguir el objeto del comentario
        $comment = Comment::find($id);

        //comprobar si soy el dueño del comentario de la publicacion
        if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)){
            $comment->delete();

            return redirect()->route('image.detail', ['id' => $comment->image->id])
                            ->with(['message' => 'Comentario eliminado correctamente']);
        }else{

            return redirect()->route('image.detail', ['id' => $comment->image->id])
                            ->with(['message' => 'El Comentario no se ha eliminado']);

        }
    }
}
