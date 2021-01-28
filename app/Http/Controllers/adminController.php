<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Permission\Models\Role;

class adminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inicio(){
        Gate::authorize('haveaccess', 'admin.perm');
        return view('admin.inicio');
    }

    public function agregarUsuario(Request $request){
        $data=request()->validate([
            'name'=>'required | max:255 |',
            'email'=>'required|max:255|unique:users,email',
            'password'=>'required|max:255|min:8|required_with:password-confirm|same:password-confirm',
            'password-confirm'=>'max:255|min:8',
            'fileField'=>'mimes:jpeg,jpg,png,gif|image'
        ]);
        try{
            DB::transaction(function () use ($request) {
                $usuario=new User();
                $usuario->name=$request->name;
                $usuario->email=$request->email;
                $usuario->password=Hash::make($request->password);
                if($request->fileField){
                    $fileNameWithTheExtension = request('fileField')->getClientOriginalName();
                    $fileName = pathinfo( $fileNameWithTheExtension,PATHINFO_FILENAME);
                    $extension = request('fileField')->getClientOriginalExtension();
                    $newFileName=$fileName.'_'.time().'.'.$extension;
                    $path = request('fileField')->storeAs('/public/uploads/',$newFileName);
                    $usuario->avatar=$newFileName;
                }
                $usuario->save();
                if($request->type=="admin")
                    $usuario->roles()->sync(1);
                else
                    $usuario->roles()->sync(2);
            });
            if($request->ajax()){
                session()->flash('status','Usuario creado con éxito!');
                return 200;
            }
        }
        catch(QueryException $ex){
            if($request->ajax()){
                return response()->json(['errors' => ['catch' => [0 => 'Ocurrió un error inesperado, intentalo más tarde.']]], 500);
            }
        }
    }
}
