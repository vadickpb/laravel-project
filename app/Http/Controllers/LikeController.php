<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function like($image_id){

        //recoger los datos del usuario e imagen
        $user = Auth::user();

        //condicion para ver si existe el like y no duplicarlo

        $isset_like = Like::where('user_id', $user->id)
                            ->where('image_id', $image_id)
                            ->count();

       

        if($isset_like == 0){

            //asignar valores a like
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;
            //guardar en la base de datos
            $like->save();

            return response()->json([
                'like' => $like
            ]);

        }else{
            return response()->json([
                'message' => 'el like ya existe'
            ]);
        }

    }

    public function dislike($image_id){

        //recoger los datos del usuario e imagen
        $user = Auth::user();

        //condicion para ver si existe el like y no duplicarlo

        $like = Like::where('user_id', $user->id)
                            ->where('image_id', $image_id)
                            ->first();

       

        if($like){

            //eliminar like
            $like->delete();

            return response()->json([
                'like' => $like,
                'message' => 'has dado dislike correctmente'
            ]);

        }else{
            return response()->json([
                'message' => 'el like no existe'
            ]);
        }
    }

    public function index(){
        $user = Auth::user();
        $likes = Like::where('user_id', $user->id)->orderBy('id', 'desc')
                              ->paginate(5);

        return view('like.index', [
            'likes' => $likes
        ]);
    }

  
    
}
