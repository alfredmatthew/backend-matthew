<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransaksiBahanBaku;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TransaksiBahanBakuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksibahanbakus = TransaksiBahanBaku::all();

        if(count($transaksibahanbakus) > 0){
            return response ([
                'message' => 'Retrieve All Success',
                'data' => $transaksibahanbakus
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
            'tanggal_transaksi' => ['required', 'date'],
            'total_transaksi' => ['required', 'numeric'],
        ], [
            'tanggal_transaksi.required' => 'Tanggal transaksi wajib diisi.',
            'tanggal_transaksi.date' => 'Tanggal transaksi harus dalam format tanggal yang valid.',
            'total_transaksi.required' => 'Total transaksi wajib diisi.',
            'total_transaksi.numeric' => 'Total transaksi harus berupa angka.',
        ]);
        
        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $transaksibahanbaku = TransaksiBahanBaku::create($storeData);
        return response([
            'message' => 'Add Transaksi Bahan Baku Success',
            'data' => $transaksibahanbaku
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaksibahanbakus = TransaksiBahanBaku::find($id);

        if(!is_null($transaksibahanbakus)){
            return response([
                'message' => 'Transaksi Bahan Baku found, it is '.$transaksibahanbakus->id_transaksi_bahan,
                'data' => $transaksibahanbakus
            ],200);
        }

        return response([
            'message' => 'Transaksi Bahan Baku Not Found',
            'data' => null
        ],404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaksibahanbaku = TransaksiBahanBaku::find($id);
        if(is_null($transaksibahanbaku)){
            return response([
                'message' => 'Transaksi Bahan Baku Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($storeData, [
            'tanggal_transaksi' => ['required', 'date'],
            'total_transaksi' => ['required', 'numeric'],
        ], [
            'tanggal_transaksi.required' => 'Tanggal transaksi wajib diisi.',
            'tanggal_transaksi.date' => 'Tanggal transaksi harus dalam format tanggal yang valid.',
            'total_transaksi.required' => 'Total transaksi wajib diisi.',
            'total_transaksi.numeric' => 'Total transaksi harus berupa angka.',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);
        
        $transaksibahanbaku->tanggal_transaksi = $updateData['tanggal_transaksi'];
        $transaksibahanbaku->total_transaksi = $updateData['total_transaksi'];

        if($transaksibahanbaku->save()){
            return response([
                'message' => 'Update Transaksi Bahan Baku Success',
                'data' => $transaksibahanbaku
            ],200);
        }

        return response([
            'message' => 'Update Transaksi Bahan Baku Failed',
            'data' => null
        ],400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksibahanbaku = TransaksiBahanBaku::find($id);

        if(is_null($transaksibahanbaku)){
            return response([
                'message' => 'Transaksi Bahan Baku Not Found',
                'data' => null
            ],404);
        }

        if($transaksibahanbaku->delete()){
            return response([
                'message' => 'Delete Transaksi Bahan Baku Success',
                'data'
            ],200);
        }

        return response([
            'message' => 'Delete Transaksi Bahan Baku Failed',
            'data' => null
        ],400);
    }
}
