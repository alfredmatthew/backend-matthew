<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BahanBaku;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BahanBakuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bahanbakus = BahanBaku::all();

        if(count($bahanbakus) > 0){
            return response ([
                'message' => 'Retrieve All Success',
                'data' => $bahanbakus
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

        $validator = Validator::make($storeData, [
            'nama_bahan' => ['required', 'string', 'max:255'],
            'stok_bahan' => ['required', 'string', 'max:255'],
            'satuan' => ['required', 'string', 'max:255'],
        ], [
            'nama_bahan.required' => 'Nama bahan wajib diisi.',
            'stok_bahan.required' => 'Stok bahan wajib diisi.',
            'satuan.required' => 'Satuan wajib diisi.',
        ]);
        
        if($validator->fails())
            return response(['message' => $validator->errors()], 400);

        $bahanbaku = BahanBaku::create($storeData);
        return response([
            'message' => 'Add Bahan Baku Success',
            'data' => $bahanbaku
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $nama_bahan)
    {
        $bahanbakus = BahanBaku::where('nama_bahan', $nama_bahan)->first();

        if(!is_null($bahanbakus)){
            return response([
                'message' => 'Bahan Baku found, it is '.$bahanbakus->nama_bahan,
                'data' => $bahanbakus
            ],200);
        }

        return response([
            'message' => 'Bahan Baku Not Found',
            'data' => null
        ],404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bahanbaku = BahanBaku::find($id);
        if(is_null($bahanbaku)){
            return response([
                'message' => 'Bahan Baku Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();

        $validate = Validator::make($updateData, [
            'nama_bahan' => ['required', 'string', 'max:255'],
            'stok_bahan' => ['required', 'string', 'max:255'],
            'satuan' => ['required', 'string', 'max:255'],
        ], [
            'nama_bahan.required' => 'Nama bahan wajib diisi.',
            'stok_bahan.required' => 'Stok bahan wajib diisi.',
            'satuan.required' => 'Satuan wajib diisi.',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);
        
        $bahanbaku->nama_bahan = $updateData['nama_bahan'];
        $bahanbaku->stok_bahan = $updateData['stok_bahan'];
        $bahanbaku->satuan = $updateData['satuan'];

        if($bahanbaku->save()){
            return response([
                'message' => 'Update Bahan Baku Success',
                'data' => $bahanbaku
            ],200);
        }

        return response([
            'message' => 'Update Bahan Baku Failed',
            'data' => null
        ],400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bahanbaku = BahanBaku::find($id);

        if(is_null($bahanbaku)){
            return response([
                'message' => 'Bahan Baku Not Found',
                'data' => null
            ],404);
        }

        if($bahanbaku->delete()){
            return response([
                'message' => 'Delete Bahan Baku Success',
                'data'
            ],200);
        }

        return response([
            'message' => 'Delete Bahan Baku Failed',
            'data' => null
        ],400);
    }
}
