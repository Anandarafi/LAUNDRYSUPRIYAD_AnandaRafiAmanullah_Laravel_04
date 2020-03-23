<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Jenis;
use Auth;
use DB;

class JenisController extends Controller
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
            'nama_jenis' => 'required',
            'harga_per_kg'=> 'required',
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $Jenis = Jenis::create([
            'nama_jenis' => $req->nama_jenis,
            'harga_per_kg'=> $req->harga_per_kg,
        ]);
        if($Jenis){
            return Response()->json(['status'=>1,'message'=>'JENIS CUCIAN BERHASIL DITAMBAH']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'JENIS CUCIAN GAGAL DITAMBAH']);
        }
    }
}

    public function update($id, Request $req)
    {
        if(Auth::user()->level=='admin'){
        $validator=Validator::make($req->all(),
        [
            'nama_jenis' => 'required',
            'harga_per_kg' => 'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $Jenis=Jenis::where('id_jenis',$id)->update([
            'nama_jenis' => $req->nama_jenis,
            'harga_per_kg' => $req->harga_per_kg,
        ]);
        if($Jenis){
            return Response()->json(['status'=>1,'message'=>'JENIS CUCIAN BERHASIL DIUBAH']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'JENIS CUCIAN GAGAL DIUBAH']);
        }
    }
    }

    public function delete($id)
    {
        if(Auth::user()->level=='admin'){
        $Jenis=Jenis::where('id_jenis',$id)->delete();
        if($Jenis){
            return Response()->json(['status'=>1,'message'=>'JENIS CUCIAN BERHASIL DIHAPUS']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'JENIS CUCIAN GAGAL DIHAPUS']);
        }
    }
    }
    public function tampil()
    {
        if(Auth::user()->level=='admin'){
        $Jenis=Jenis::all();
        if($Jenis){
            return Response()->json(['Data'=>$Jenis,'status'=>1]);
        }
        else{
            return Response()->json(['status'=>0]);
        }
    }
}
}
