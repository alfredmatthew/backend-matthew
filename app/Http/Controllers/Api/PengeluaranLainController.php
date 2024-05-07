<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengeluaranLain;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PengeluaranLainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengeluaranLains = PengeluaranLain::all();

        if(count($pengeluaranLains) > 0){
            return response ([
                'message' => 'Retrieve All Success',
                'data' => $pengeluaranLains
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
            'tanggal_pengeluaran' => 'required|date',
            'kategori_pengeluaran' => 'required|string',
            'detail_pengeluaran' => 'required|string|max:255',
            'biaya' => 'required|numeric',
        ], [
            'tanggal_pengeluaran.required' => 'Tanggal pengeluaran wajib diisi.',
            'tanggal_pengeluaran.date' => 'Tanggal pengeluaran harus dalam format tanggal yang valid.',
            'kategori_pengeluaran.required' => 'Kategori pengeluaran wajib diisi.',
            'kategori_pengeluaran.string' => 'Kategori pengeluaran harus berupa teks.',
            'detail_pengeluaran.required' => 'Detail pengeluaran wajib diisi.',
            'detail_pengeluaran.max' => 'Detail pengeluaran tidak boleh lebih dari :max karakter.',
            'biaya.required' => 'Biaya wajib diisi.',
            'biaya.numeric' => 'Biaya harus berupa angka.',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $pengeluaranLain = PengeluaranLain::create($storeData);
        return response([
            'message' => 'Pengeluaran Lain berhasil ditambahkan',
            'data' => $pengeluaranLain
        ]);
    }


    /**
     * Display the specified resource.
     * Based on date
     */
    public function show(Request $request, $tanggal_pengeluaran)
    {
        $pengeluaranLain = PengeluaranLain::whereDate('tanggal_pengeluaran', $tanggal_pengeluaran)
                        ->get();

        if($pengeluaranLain->isNotEmpty()){
            return response([
                'message' => 'Pengeluaran Lain found',
                'data' => $pengeluaranLain
            ],200);
        }

        return response([
            'message' => 'Pengeluaran Lain Not Found',
            'data' => null
        ],404);
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pengeluaranLain = PengeluaranLain::find($id);
        if(is_null($pengeluaranLain)){
            return response([
                'message' => 'Pengeluaran Lain Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($request->all(), [
            'tanggal_pengeluaran' => 'required|date',
            'kategori_pengeluaran' => 'required|string',
            'detail_pengeluaran' => 'required|string|max:255',
            'biaya' => 'required|numeric',
        ], [
            'tanggal_pengeluaran.required' => 'Tanggal pengeluaran wajib diisi.',
            'tanggal_pengeluaran.date' => 'Tanggal pengeluaran harus dalam format tanggal yang valid.',
            'kategori_pengeluaran.required' => 'Kategori pengeluaran wajib diisi.',
            'kategori_pengeluaran.string' => 'Kategori pengeluaran harus berupa teks.',
            'detail_pengeluaran.required' => 'Detail pengeluaran wajib diisi.',
            'detail_pengeluaran.max' => 'Detail pengeluaran tidak boleh lebih dari :max karakter.',
            'biaya.required' => 'Biaya wajib diisi.',
            'biaya.numeric' => 'Biaya harus berupa angka.',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);
        
        $pengeluaranLain->tanggal_pengeluaran = $updateData['tanggal_pengeluaran'];
        $pengeluaranLain->kategori_pengeluaran = $updateData['kategori_pengeluaran'];
        $pengeluaranLain->detail_pengeluaran = $updateData['detail_pengeluaran'];
        $pengeluaranLain->biaya = $updateData['biaya'];

        if($pengeluaranLain->save()){
            return response([
                'message' => 'Update Pengeluaran Lain Success',
                'data' => $pengeluaranLain
            ],200);
        }

        return response([
            'message' => 'Update Pengeluaran Lain Failed',
            'data' => null
        ],400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pengeluaranLain = PengeluaranLain::find($id);

        if(is_null($pengeluaranLain)){
            return response([
                'message' => 'Pengeluaran Lain Not Found',
                'data' => null
            ],404);
        }

        if($pengeluaranLain->delete()){
            return response([
                'message' => 'Delete Pengeluaran Lain Success',
                'data'
            ],200);
        }

        return response([
            'message' => 'Delete Pengeluaran Lain Failed',
            'data' => null
        ],400);
    }
}
