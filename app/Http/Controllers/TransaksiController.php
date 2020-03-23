<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;
use App\Transaksi;
use App\User;
use App\Pelanggan;
use App\Jenis;
use App\Detail;
use Auth;
use App\Petugas;

class TransaksiController extends Controller
{
    public function cek(){
        if(Auth::user()->level=='admin'||'petugas'){
            $petugas=DB::table('petugas')->get();
            return response()->json($petugas);
        }else{
            return response()->json(['ANDA BUKAN ADMIN dan PETUGAS']);
        }
    }

    public function store(Request $req)
    {
        if(Auth::user()->level=='admin'||'petugas'){
        $validator = Validator::make($req->all(), 
        [
            'id_pelanggan' => 'required',
            'id_petugas'=> 'required',
            'tgl_transaksi'=> 'required',
            'tgl_selesai'=> 'required',
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $Transaksi = Transaksi::create([
            'id_pelanggan' => $req->id_pelanggan,
            'id_petugas'=> $req->id_petugas,
            'tgl_transaksi'=> $req->tgl_transaksi,
            'tgl_selesai'=> $req->tgl_selesai,
        ]);
        if($Transaksi){
            return Response()->json(['status'=>1,'message'=>'TRANSAKSI  BERHASIL DITAMBAH']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'TRANSAKSI  GAGAL DITAMBAH']);
        }
    }
}

    public function update($id, Request $req)
    {
        if(Auth::user()->level=='admin'||'petugas'){
        $validator=Validator::make($req->all(),
        [
            'id_pelanggan' => 'required',
            'id_petugas' => 'required',
            'tgl_transaksi'=> 'required',
            'tgl_selesai'=> 'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $Transaksi=Transaksi::where('id_transaksi',$id)->update([
            'id_pelanggan' => $req->id_pelanggan,
            'id_petugas' => $req->id_petugas,
            'tgl_transaksi'=> $req->tgl_transaksi,
            'tgl_selesai'=> $req->tgl_selesai,
        ]);
        if($Transaksi){
            return Response()->json(['status'=>1,'message'=>'TRANSAKSI  BERHASIL DIUBAH']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'TRANSAKSI  GAGAL DIUBAH']);
        }
    }
}


    public function delete($id)
    {
        if(Auth::user()->level=='admin'||'petugas'){
        $Transaksi=Transaksi::where('id_transaksi',$id)->delete();
        if($Transaksi){
            return Response()->json(['status'=>1,'message'=>'TRANSAKSI  BERHASIL DIHAPUS']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'TRANSAKSI  GAGAL DIHAPUS']);
        }
    }
}
    public function tampil(Request $req)
    {
        if(Auth::user()->level=='admin'||'petugas'){
        $Transaksi = DB::table('transaksi')->join('pelanggan','pelanggan.id_pelanggan','transaksi.id_pelanggan')->where('transaksi.tgl_transaksi','>=',$req->tgl_transaksi)->where('transaksi.tgl_transaksi','<=',$req->tgl_selesai)->get();
        $arr_data=[];
        foreach ($Transaksi as $Transaksi){
            $grand = DB::table('detail_transaksi')->where('detail_transaksi.id_transaksi','=',$Transaksi->id_transaksi)->groupBy('id_transaksi')->select(DB::raw('sum(sub_total) as grandtotal'))->first();
            
            $detail=DB::table('detail_transaksi')->join('jenis_cuci','jenis_cuci.id_jenis','detail_transaksi.id_jenis')->where('id_transaksi',$Transaksi->id_transaksi)->get();
            $arr_data=[
                'tgl_transaksi'=> $Transaksi->tgl_transaksi,
                'nama_pelanggan'=> $Transaksi->nama,
                'alamat'=> $Transaksi->alamat,
                'telp'=> $Transaksi->telp,
                'tgl_selesai'=> $Transaksi->tgl_selesai,
                'grandtotal'=>$grand,
                'detail_cuci'=>$detail,
               

        ];
        }
        return Response()->json(['Data'=>$arr_data]);
    }
}

    public function store1(Request $req)
    {
        $validator = Validator::make($req->all(), 
        [
            'id_transaksi' => 'required',
            'id_jenis'=> 'required',
            'qty'=> 'required',
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $sub = Jenis::where('id_jenis',$req->id_jenis)->first();
        $subtotal=$sub->harga_per_kg*$req->qty;

        $Detail = Detail::create([
            'id_transaksi' => $req->id_transaksi,
            'id_jenis'=> $req->id_jenis,
            'sub_total'=> $subtotal,
            'qty'=> $req->qty,
        ]);
        if($Detail){
            return Response()->json(['status'=>1,'message'=>'DETAIL TRANSAKSI BERHASIL']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'DETAIL TRANSAKSI GAGAL']);
        }
    }



    public function update1($id, Request $req)
    {
        if(Auth::user()->level=='admin'||'petugas'){
        $validator=Validator::make($req->all(),
        [
            'id_transaksi' => 'required',
            'id_jenis' => 'required',
            'qty' => 'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $sub = Jenis::where('id_jenis',$req->id_jenis)->first();
        $subtotal=$sub->harga_per_kg*$req->qty;
        $Detail=Detail::where('id_detail',$id)->update([
            'id_transaksi' => $req->id_transaksi,
            'id_jenis' => $req->id_jenis,
            'sub_total'=>$subtotal,
            'qty'=> $req->qty,
        ]);
        if($Detail){
            return Response()->json(['status'=>1,'message'=>'DETAIL TRANSAKSI BERHASIL DIUBAH']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'DETAIL TRANSAKSI GAGAL DIUBAH']);
        }
    }
}

    public function delete1($id)
    {
        if(Auth::user()->level=='admin'||'petugas'){
        $Detail=Detail::where('id_detail',$id)->delete();
        if($Detail){
            return Response()->json(['status'=>1,'message'=>'DETAIL TRANSAKSI BERHASIL DIHAPUS']);
        }
        else{
            return Response()->json(['status'=>0,'message'=>'DETAIL TRANSAKSI GAGAL DIHAPUS']);
        }
    }
    }
    public function tampil1()
    {
        if(Auth::user()->level=='admin'||'petugas'){
        $Detail= Detail::join('jenis_cuci','jenis_cuci.id_jenis','detail_transaksi.id_jenis')->get();
        $arr_data=array();
        foreach ($Detail as $Detail){
            $arr_data[]=array(
                'id_detail'=> $Detail->id_detail,
                'id_jenis'=> $Detail->id_jenis,
                'id_transaksi'=> $Detail->id_transaksi,
                'nama_jenis'=> $Detail->nama_jenis,
                'harga_per_kg'=> $Detail->harga_per_kg,
                'qty'=> $Detail->qty,
                'sub_total'=> $Detail->sub_total,
            );
        }
        return Response()->json([$arr_data]);
    }
}
}
