<?php

namespace App\Http\Controllers;

use App\Models\Elector;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SimpatizanteController extends Controller
{
    //
    public function index($uuid)
    {
        $elector = Elector::where('uuid', '=', $uuid)->first();
        if (!$elector)
            abort(404);
        return view('simpatizante.solicitud_baja', ['uuid' => $uuid]);
    }

    public function delete(Request $request, $uuid)
    {
        DB::beginTransaction();
        try {
            if ($uuid != $request->uuid)
                throw new Exception();
            $elector = Elector::where('uuid', '=', $uuid)->first();
            $elector->delete();
            DB::commit();
            return response()->json(200);
        } catch (\Exception $ex) {
            //throw $th;
            DB::rollBack();
            return response()->json(['errors' => ['catch' => [0 => 'Ocurrió un error inesperado, intentalo más tarde.']]], 500);
        }
    }

    public function simpatizantes(){
        //Recibe todas las secciones
        $simpatizantes = Elector::paginate(10);

        return view('usuario.simpatizantes', ['simpatizantes' => $simpatizantes]);
    }

    public function agregarSimpatizante(){
        $data=request()->validate([
            'nombre'=>'required | max:100 |',
            'apellido_p'=>'required | max:100 |',
            'apellido_m'=>'required | max:100 |',
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