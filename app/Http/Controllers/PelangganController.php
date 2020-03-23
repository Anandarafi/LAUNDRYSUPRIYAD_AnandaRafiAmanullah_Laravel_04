<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Pelanggan;
use Auth;
use DB;

class PelangganController extends Controller
{
    public function cek(){
        if(Auth::user()->level=='admin'){
            $petugas=DB::table('petugas')->get();
            return response()->json($petugas);
        }else{
            return response()->json(['ANDA BUKAN ADMIN']);
        }
    }
    public function store(Request $req)
    {
        if(Auth::user()->level=='admin'){
        $validator = Validator::make($req->all(), 
        [
            'nama' => 'required',
            'alamat'=> 'required',
            'telp'=> 'required',
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $Pelanggan = Pelanggan::create([
            'nama' => $req->nama,
            'alamat'=> $req->alamat,
            'telp'=> $req->telp,
        ]);
        if($Pelanggan){
            return Response()->json(['status'=>1,'message'=>'PELANGGAN BERHASIL BERGABUNG']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'PELANGGAN GAGAL BERGABUNG']);
            }
        }
    }

    public function update($id, Request $req)
    {
        if(Auth::user()->level=='admin'){
        $validator=Validator::make($req->all(),
        [
            'nama' => 'required',
            'alamat' => 'required',
            'telp'=> 'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $Pelanggan=Pelanggan::where('id_pelanggan',$id)->update([
            'nama' => $req->nama,
            'alamat' => $req->alamat,
            'telp'=> $req->telp,
        ]);
        if($Pelanggan){
            return Response()->json(['status'=>1,'message'=>'PELANGGAN BERHASIL DIUBAH']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'PELANGGAN GAGAL DIUBAH']);
        }
    }
}

    public function delete($id)
    {
        if(Auth::user()->level=='admin'){
        $Pelanggan=Pelanggan::where('id_pelanggan',$id)->delete();
        if($Pelanggan){
            return Response()->json(['status'=>1,'message'=>'PELANGGAN BERHASIL DIHAPUS']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'PELANGGAN GAGAL DIHAPUS']);
        }
    }
    }
    public function tampil()
    {
        if(Auth::user()->level=='admin'){
        $Pelanggan=Pelanggan::all();
        if($Pelanggan){
            return Response()->json(['Data'=>$Pelanggan,'status'=>1]);
        }
        else{
            return Response()->json(['status'=>0]);
        }
    }
}
}
