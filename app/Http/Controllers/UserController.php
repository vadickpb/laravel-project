<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;


class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function config(){
        return view('user.config');
    }

    public function update(Request $request){

        //conseguir el ususario identificado
        $user = \Auth::user();
        $id = $user->id;


        //validar el formulario
        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255','unique:users,nick,'.$id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id]
            
        ]);


        //recojer los datos en post
        
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        //asignar nuevos valores al objeto del usuario

        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        //subir la imagen

        $image_path = $request->file('image_path');
        if($image_path){

            //ponerle un nombre unico
            $image_path_name = time().$image_path->getClientOriginalName();

            //guardarla en la carpeta storage app/users
            Storage::disk('users')->put($image_path_name, File::get($image_path));

            //seteo el nombre de la imagen en el objeto
            $user->image = $image_path_name;
        }

        

        // Ejecutar consulta y cambios a la base de datos

        $user->update();

        //redireccion a la pagina config

        return redirect()->route('config')
                        ->with(['message'=>'Usuario actualizado correctamente']);


        

        
    }

    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }
}
