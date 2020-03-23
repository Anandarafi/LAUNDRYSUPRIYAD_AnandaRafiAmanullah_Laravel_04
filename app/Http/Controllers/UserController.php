<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                $test=array(
                    'logged'=>false,
                    'token'=>'',
                    'message'=> 'Login Gagal',
                );
                return response()->json($test);
                
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        
        if($token){
            $test=array(
                'logged'=>true,
                'token'=>$token,
                'message'=> 'Login berhasil'
            );
        }
        else{
            $test=array(
                'logged'=>false,
                'token'=>'',
                'message'=> 'Login Gagal'
            );
        }

        return response()->json($test);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_petugas' => 'required|string|max:255',
            'telp' => 'required|string|min:12',
            'username' => 'required|string|min:4',
            'password' => 'required|string|min:6',
            'level' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $petugas = User::create([
            'nama_petugas' => $request->get('nama_petugas'),
            'telp'=> $request->get('telp'),
            'username' => $request->get('username'),
            'password' => Hash::make($request->get('password')),
            'level' => $request->get('level'),
        ]);
        if($petugas){
            return Response()->json(['status'=>1,'message'=>'Petugas berhasil ditambahkan']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'Petugas tidak berhasil ditambahkan']);
        }
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }
        $auth=true;
        return response()->json(compact('auth','user'));
    
    }
    
    public function update($id, Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'nama_petugas'=> 'required',
            'username'=> 'required',
            'password'=> 'required',
            'telp'=> 'required',
            'level'=> 'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson(), 400);
        }
        $petugas=User::where('id',$id)->update([
            'nama_petugas'=>$req->nama_petugas,
            'username'=>$req->username,
            'password'=>$req->password,
            'telp'=>$req->telp,
            'level'=>$req->level,
        ]);
        if($petugas){
            return Response()->json(['status'=>1,'message'=>'Petugas berhasil diubah']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'Petugas tidak berhasil diubah']);
        }
    }

    public function delete($id)
    {
        $petugas=User::where('id',$id)->delete();
        if($petugas){
            return Response()->json(['status'=>1,'message'=>'Data berhasil dihapus']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'Data tidak berhasil dihapus']);
        }
    }

    public function tampil()
    {
        $petugas=User::all();
        if($petugas){
            return Response()->json(['user'=>$petugas,'status'=>1]);
        }
        else{
            return Response()->json(['status'=>0]);
        }
    }
}