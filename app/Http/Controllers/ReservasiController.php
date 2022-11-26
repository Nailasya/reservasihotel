<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function index()
    {
        //menampilkan data reservasi untuk admin
        $reservasi_turubae = Reservasi::all();
        return $reservasi_turubae;
    }

    public function store(Request $request)
    {
         //menambah data reservasi bagian customer
         $table = Reservasi::create([
            "nama_customer" => $request->nama_customer,
            "no_hp" => $request->no_hp,
            "jumlah_orang" => $request->jumlah_orang,
            "nama_kamar" => $request->nama_kamar,
            "tanggal_reservasi" => $request->tanggal_reservasi,
            "tanggal_kepulangan" => $request->tanggal_kepulangan,
            "jumlah_hari" => $request->jumlah_hari,
            "harga_kamar" => $request->harga_kamar,
            "total" => $request->total,
        ]);

        return response()->json([
            'success' => 201,
            'message' => 'data kamar berhasil disimpan',
            'data' => $table
        ], 201);
    }


    public function show($id)
    {
         // tampil detail reservasi bagi admin maupun customer
         $reservasi_turubae = Reservasi::find($id);
         if($reservasi_turubae){
             return response()->json([
                 'status' => 200,
                 'data' => $reservasi_turubae
             ], 200);
         }else{
             return response()->json([
                 'status' => 404,
                 'message' => $id . 'tidak ditemukan'
             ], 404);
         }
    }

    public function update(Request $request, $id)
    {
         // update atau ubah data reservasi bagian admin
         $reservasi_turubae = Reservasi::find($id);
         if($reservasi_turubae){
             $reservasi_turubae->nama_customer = $request->nama_customer ? $request->nama_customer : $request->nama_customer;
             $reservasi_turubae->no_hp = $request->no_hp ? $request->no_hp : $request->no_hp;
             $reservasi_turubae->jumlah_orang = $request->jumlah_orang ? $request->jumlah_orang : $request->jumlah_orang;
             $reservasi_turubae->nama_kamar = $request->nama_kamar ? $request->nama_kamar : $request->nama_kamar;
             $reservasi_turubae->tanggal_reservasi = $request->tanggal_reservasi ? $request->tanggal_reservasi : $request->tanggal_reservasi;
             $reservasi_turubae->tanggal_kepulangan = $request->tanggal_kepulangan ? $request->tanggal_kepulangan : $request->tanggal_kepulangan;
             $reservasi_turubae->jumlah_hari = $request->jumlah_hari ? $request->jumlah_hari : $request->jumlah_hari;
             $reservasi_turubae->harga_kamar = $request->harga_kamar ? $request->harga_kamar : $request->harga_kamar;
             $reservasi_turubae->total = $request->total ? $request->total : $request->total;
             $reservasi_turubae->save();
             return response()->json([
 
                 'status' => 200,
                 'data' => $reservasi_turubae
             ], 200);
         }else{
             return response()->json([
                 'status' => 404,
                 'message' => $id . 'tidak ditemukan'
             ],404);
         }
    }

    public function destroy($id)
    {
         // hapus data kamar
         $reservasi_turubae = Reservasi::where('id',$id )->first();
         if($reservasi_turubae){
             $reservasi_turubae->delete();
             return response()->json([
                 'status' => 200,
                 'data' => $reservasi_turubae
             ],200);
         }else{
             return response()->json([
                 'status' => 404,
                 'message' => $id . 'tidak ditemukan'
             ],404);
         }
    }
}