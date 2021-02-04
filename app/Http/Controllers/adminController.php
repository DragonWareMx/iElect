<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Campaign;
use App\Permission\Models\Role;

class adminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inicio(){
        Gate::authorize('haveaccess', 'admin.perm');
        $totalUsers=User::get()->count();
        $totalAdmins=User::join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id',1)->get()->count();
        $totalAgents=User::join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id',2)->get()->count();
        $totalBrigadists=User::join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id',3)->get()->count();
        $totalCampanas=Campaign::get()->count();
        return view('admin.inicio',[
            'totalUsers'=>$totalUsers,
            'totalAdmins'=>$totalAdmins,
            'totalAgents'=>$totalAgents,
            'totalBrigadists'=>$totalBrigadists,
            'totalCampanas'=>$totalCampanas
        ]);
    }

    public function agregarUsuario(Request $request){
        Gate::authorize('haveaccess', 'admin.perm');
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

    public function verUsuarios(){
        Gate::authorize('haveaccess', 'admin.perm');
        $administradores=User::join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id',1)->get();
        $agentes=User::join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id',2)->get();
        $brigadistas=User::join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id',3)->get();
        return view('admin.usuarios',[
            'administradores'=>$administradores,
            'agentes'=>$agentes,
            'brigadistas'=>$brigadistas
        ]);
    }

    public function editarUsuario(Request $request , $id){
        Gate::authorize('haveaccess', 'admin.perm');
        $data=request()->validate([
            'name'=>'required | max:255 |',
            'email' => ['required','max:255', function ($attribute, $value, $fail) use ($id) {
                $usuario=User::findOrFail($id);
                if($usuario->email != $value){
                    $emailRepetido=User::where('email',$value)->first();
                    if($emailRepetido){
                        return $fail(__('El correo ingresado pertenece a otra cuenta.')); 
                    }
                }    
            }],
            'actualPassword' => ['nullable', function ($attribute, $value, $fail) use ($id) {
                $user=User::findOrFail($id);
                if (!Hash::check($value, $user->password)) {
                    return $fail(__('La contraseña actual es incorrecta.'));
                }
            }],
            'password'=>'nullable|max:255|min:8|same:password-confirm',
            'password-confirm'=>'nullable|max:255|min:8',
            'fileField'=>'mimes:jpeg,jpg,png,gif|image'
        ]);
        try{
            DB::transaction(function () use ($request,$id) {
                $usuario=User::findOrFail($id);
                $usuario->name=$request->name;
                $usuario->email=$request->email;
                if($request->password){
                    $usuario->password=Hash::make($request->password);
                }
                if($request->fileField){
                    $oldFile=public_path().'/storage/uploads/'.$usuario->avatar;
                    if(file_exists($oldFile)){
                        unlink($oldFile);
                    }
                    $fileNameWithTheExtension = request('fileField')->getClientOriginalName();
                    $fileName = pathinfo( $fileNameWithTheExtension,PATHINFO_FILENAME);
                    $extension = request('fileField')->getClientOriginalExtension();
                    $newFileName=$fileName.'_'.time().'.'.$extension;
                    $path = request('fileField')->storeAs('/public/uploads/',$newFileName);
                    $usuario->avatar=$newFileName;
                }
                $usuario->save();
            });
            if($request->ajax()){
                session()->flash('status','Usuario editado con éxito!');
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
