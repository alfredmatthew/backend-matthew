<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penitip;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PenitipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penitips = Penitip::all();

        if(count($penitips) > 0){
            return response ([
                'message' => 'Retrieve All Success',
                'data' => $penitips
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
            'nama_penitip' => ['required', 'string', 'max:255'],
            'no_telp_penitip' => ['required', 'string', 'regex:/^\d{10,12}$/'],
            'alamat_penitip' => ['required', 'string', 'max:500'],
        ], [
            'nama_penitip.required' => 'Nama penitip wajib diisi.',
            'no_telp_penitip.required' => 'Nomor telepon penitip wajib diisi.',
            'no_telp_penitip.regex' => 'Format nomor telepon penitip tidak valid.',
            'alamat_penitip.required' => 'Alamat penitip wajib diisi.',
        ]);
        
        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $penitip = Penitip::create($storeData);
        return response([
            'message' => 'Add penitip Success',
            'data' => $penitip
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $nama_penitip)
    {
        $penitips = Penitip::where('nama_penitip', $nama_penitip)->first();

        if(!is_null($penitips)){
            return response([
                'message' => 'Penitip found, it is '.$penitips->nama_penitip,
                'data' => $penitips
            ],200);
        }

        return response([
            'message' => 'Penitip Not Found',
            'data' => null
        ],404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penitip = Penitip::find($id);
        if(is_null($penitip)){
            return response([
                'message' => 'Penitip Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_penitip' => ['required', 'string', 'max:255'],
            'no_telp_penitip' => ['required', 'string', 'regex:/^\d{10,12}$/'],
            'alamat_penitip' => ['required', 'string', 'max:500'],
        ], [
            'nama_penitip.required' => 'Nama penitip wajib diisi.',
            'no_telp_penitip.required' => 'Nomor telepon penitip wajib diisi.',
            'no_telp_penitip.regex' => 'Format nomor telepon penitip tidak valid.',
            'alamat_penitip.required' => 'Alamat penitip wajib diisi.',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);
        
        $penitip->nama_penitip = $updateData['nama_penitip'];
        $penitip->no_telp_penitip = $updateData['no_telp_penitip'];
        $penitip->alamat_penitip = $updateData['alamat_penitip'];

        if($penitip->save()){
            return response([
                'message' => 'Update Penitip Success',
                'data' => $penitip
            ],200);
        }

        return response([
            'message' => 'Update Penitip Failed',
            'data' => null
        ],400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penitip = Penitip::find($id);

        if(is_null($penitip)){
            return response([
                'message' => 'Penitip Not Founds',
                'data' => null
            ],404);
        }

        if($penitip->delete()){
            return response([
                'message' => 'Delete Penitip Success',
                'data'
            ],200);
        }

        return response([
            'message' => 'Delete Penitip Failed',
            'data' => null
        ],400);
    }
}
