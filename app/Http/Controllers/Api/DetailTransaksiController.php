<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DetailTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detailtransaksis = DetailTransaksi::all();

        if(count($detailtransaksis) > 0){
            return response ([
                'message' => 'Retrieve All Success',
                'data' => $detailtransaksis
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $storeData = $request->all();

        $validate = Validator::make($storeData, [
            'jumlah_beli' => ['required', 'numeric'],
            'harga_beli' => ['required', 'numeric'],
        ], [
            'jumlah_beli.required' => 'Jumlah beli wajib diisi.',
            'jumlah_beli.numeric' => 'Jumlah beli harus berupa angka.',
            'harga_beli.required' => 'Harga beli wajib diisi.',
            'harga_beli.numeric' => 'Harga beli harus berupa angka.',
        ]);
        
        
        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $detailtransaksi = DetailTransaksi::create($storeData);
        return response([
            'message' => 'Add Detail Transaksi Success',
            'data' => $detailtransaksi
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $detailtransaksis = DetailTransaksi::find($id);

        if(!is_null($detailtransaksis)){
            return response([
                'message' => 'Detail Transaksi found, it is '.$detailtransaksis->id_transaksi_bahan,
                'data' => $detailtransaksis
            ],200);
        }

        return response([
            'message' => 'Detail Transaksi Not Found',
            'data' => null
        ],404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $detailtransaksi = DetailTransaksi::find($id);
        if(is_null($detailtransaksi)){
            return response([
                'message' => 'Detail Transaksi Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($storeData, [
            'jumlah_beli' => ['required', 'numeric'],
            'harga_beli' => ['required', 'numeric'],
        ], [
            'jumlah_beli.required' => 'Jumlah beli wajib diisi.',
            'jumlah_beli.numeric' => 'Jumlah beli harus berupa angka.',
            'harga_beli.required' => 'Harga beli wajib diisi.',
            'harga_beli.numeric' => 'Harga beli harus berupa angka.',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);
        
        $detailtransaksi->jumlah_beli = $updateData['jumlah_beli'];
        $detailtransaksi->harga_beli = $updateData['harga_beli'];

        if($detailtransaksi->save()){
            return response([
                'message' => 'Update Detail Transaksi Success',
                'data' => $detailtransaksi
            ],200);
        }

        return response([
            'message' => 'Update Detail Transaksi Failed',
            'data' => null
        ],400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $detailtransaksi = DetailTransaksi::find($id);

        if(is_null($detailtransaksi)){
            return response([
                'message' => 'Detail Transaksi Not Found',
                'data' => null
            ],404);
        }

        if($detailtransaksi->delete()){
            return response([
                'message' => 'Delete Detail Transaksi Success',
                'data'
            ],200);
        }

        return response([
            'message' => 'Delete Detail Transaksi Failed',
            'data' => null
        ],400);
    }
}
