<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;


class CuentaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        $Agents=User::join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id',2)->get();
        $brigadistas=User::join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id',3)->get();
        $userAgente=false;
        $userBrigadista=false;

        foreach ($Agents as $Agente){
            if($user->id == $Agente->user_id){
                $userAgente = true;
            }
        }

        foreach ($brigadistas as $brigadista){
            if($user->id == $brigadista->user_id){
                $userBrigadista = true;
            }
        }
        

        return view('usuario.ajustes',['agente' => $userAgente, 'brigadista' => $userBrigadista]);
    }

    public function cuenta(){
        return view('usuario.cuenta');
    }

    public function cuentaAdmin(){
        return view('admin.cuenta');
    }

    public function cuentaUpdate($id){
        $data=request()->validate([
            'passActual'=>'nullable|max:25',
            'password'=>'nullable|min:8|max:25',
            'fileField'=>'nullable|mimes:jpg,jpeg,bmp,png'
        ]);
        try{
            \DB::beginTransaction();
            {
                $user=User::findOrFail($id);
                // Se actualiza solo la contraseña
                if(request('fileField')==null && request('password')!=null && request('passActual')!=null && request('cfmPassword')!=null){
                    if( Hash::check( request('passActual'), $user->password ) ){
                        $user->password=bcrypt(request('password'));
                        $user->save();
                        // dd('Actualizando contraseña bien');
                        \DB::commit();
                        return redirect('ajustes/cuenta')->with('status', 'Se actualizaron los datos correctamente');
                    }
                    else{
                        // dd('Actualizando contraseña incorrecta');
                        return redirect('ajustes/cuenta')->withErrors(['La contraseña es incorrecta']);
                    }
                }
                // Se actualiza foto y contraseña
                else if(request('fileField')!=null && request('password')!=null && request('passActual')!=null && request('cfmPassword')!=null){
                    if( Hash::check( request('passActual'), $user->password ) ){
                        $user->password=bcrypt(request('password'));
                        
                        
                        $fileNameWithTheExtension = request('fileField')->getClientOriginalName();
                        $fileName = pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);
                        $extension = request('fileField')->getClientOriginalExtension();
                        $newFileName = $fileName . '_' . time() . '.' . $extension;
                        $path = request('fileField')->storeAs('/public/avatar/', $newFileName);
                        $user->avatar = $newFileName;
                
                        $oldImage=public_path().'/public/avatar/'.$user->avatar;
                        if(file_exists($oldImage)){
                            unlink($oldImage);
                        }
                        
                        $user->avatar=$newFileName;
                        $user->save();
                        
                        // dd('Actualizando contraseña bien');
                        \DB::commit();
                        return redirect('ajustes/cuenta')->with('status', 'Se actualizaron los datos correctamente');
                    }
                    else{
                        // dd('Actualizando contraseña incorrecta');
                        return redirect('ajustes/cuenta')->withErrors(['La contraseña es incorrecta']);
                    }
                }
                // Se actualiza solo la foto
                else if (request('fileField')!=null && request('password')==null && request('passActual')==null && request('cfmPassword')==null){

                    $fileNameWithTheExtension = request('fileField')->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);
                    $extension = request('fileField')->getClientOriginalExtension();
                    $newFileName = $fileName . '_' . time() . '.' . $extension;
                    $path = request('fileField')->storeAs('/public/avatar/', $newFileName);
                    $user->avatar = $newFileName;
            
                    $oldImage=public_path().'/public/avatar/'.$user->avatar;
                    if(file_exists($oldImage)){
                        unlink($oldImage);
                    }

                    $user->avatar=$newFileName;
                    $user->save();
                    \DB::commit();
                        return redirect('ajustes/cuenta')->with('status', 'Se actualizaron los datos correctamente');
                }

                else{
                    return redirect('ajustes/cuenta')->withErrors(['No hay datos para actualizar']);
                }
            }
        }
        catch(QueryException $ex){
            \DB::rollback();
            return redirect('ajustes/cuenta')->withErrors(['No se pudieron actualizar los datos']);
        }
    }

    public function cuentaUpdateAdmin($id){
        $data=request()->validate([
            'passActual'=>'nullable|max:25',
            'password'=>'nullable|min:8|max:25',
            'fileField'=>'nullable|mimes:jpg,jpeg,bmp,png',
            'nombre'=>'required|min:5|max:255'
        ]);
        try{
            \DB::beginTransaction();
            {
                $user=User::findOrFail($id);
                // Se actualiza solo la contraseña
                if(request('fileField')==null && request('password')!=null && request('passActual')!=null && request('cfmPassword')!=null){
                    if( Hash::check( request('passActual'), $user->password ) ){
                        $user->password=bcrypt(request('password'));
                        $user->name=request('nombre');
                        $user->save();
                        // dd('Actualizando contraseña bien');
                        \DB::commit();
                        return redirect('admin/cuenta')->with('status', 'Se actualizaron los datos correctamente');
                    }
                    else{
                        // dd('Actualizando contraseña incorrecta');
                        return redirect('admin/cuenta')->withErrors(['La contraseña es incorrecta']);
                    }
                }
                // Se actualiza foto y contraseña
                else if(request('fileField')!=null && request('password')!=null && request('passActual')!=null && request('cfmPassword')!=null){
                    if( Hash::check( request('passActual'), $user->password ) ){
                        $user->password=bcrypt(request('password'));
                        
                        
                        $fileNameWithTheExtension = request('fileField')->getClientOriginalName();
                        $fileName = pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);
                        $extension = request('fileField')->getClientOriginalExtension();
                        $newFileName = $fileName . '_' . time() . '.' . $extension;
                        $path = request('fileField')->storeAs('/public/avatar/', $newFileName);
                        $user->avatar = $newFileName;
                
                        $oldImage=public_path().'/public/avatar/'.$user->avatar;
                        if(file_exists($oldImage)){
                            unlink($oldImage);
                        }
                        
                        $user->avatar=$newFileName;
                        $user->name=request('nombre');
                        $user->save();
                        
                        // dd('Actualizando contraseña bien');
                        \DB::commit();
                        return redirect('admin/cuenta')->with('status', 'Se actualizaron los datos correctamente');
                    }
                    else{
                        // dd('Actualizando contraseña incorrecta');
                        return redirect('admin/cuenta')->withErrors(['La contraseña es incorrecta']);
                    }
                }
                // Se actualiza solo la foto
                else if (request('fileField')!=null && request('password')==null && request('passActual')==null && request('cfmPassword')==null){

                    $fileNameWithTheExtension = request('fileField')->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);
                    $extension = request('fileField')->getClientOriginalExtension();
                    $newFileName = $fileName . '_' . time() . '.' . $extension;
                    $path = request('fileField')->storeAs('/public/avatar/', $newFileName);
                    $user->avatar = $newFileName;
            
                    $oldImage=public_path().'/public/avatar/'.$user->avatar;
                    if(file_exists($oldImage)){
                        unlink($oldImage);
                    }

                    $user->avatar=$newFileName;
                    $user->name=request('nombre');
                    $user->save();
                    \DB::commit();
                        return redirect('admin/cuenta')->with('status', 'Se actualizaron los datos correctamente');
                }
                else if ($user->name != request('nombre')){
                    $user->name=request('nombre');
                    $user->save();
                    \DB::commit();
                        return redirect('admin/cuenta')->with('status', 'Se actualizaron los datos correctamente');
                }
                else{
                    return redirect('admin/cuenta')->withErrors(['No hay datos para actualizar']);
                }
            }
        }
        catch(QueryException $ex){
            \DB::rollback();
            return redirect('admin/cuenta')->withErrors(['No se pudieron actualizar los datos']);
        }
    }
}


