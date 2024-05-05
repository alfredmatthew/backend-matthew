<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Pembelian;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();

        if(count($customers) > 0){
            return response ([
                'message' => 'Retrieve All Success',
                'data' => $customers
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show(string $nama_customer)
    {
        $customer = Customer::where('nama_customer', $nama_customer)->first();
    
        if(!is_null($customer)){
            return response([
                'message' => 'Customer found, it is '.$customer->nama_customer,
                'data' => $customer
            ],200);
        }
    
        return response([
            'message' => 'Customer Not Found',
            'data' => null
        ],404);
    }

    public function showPembelian($id)
    {
        $pembelians = Pembelian::where('id_user', $id)->get();
        
        if ($pembelians->isEmpty()) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
        
        return response()->json(['message' => 'Pembelians retrieved successfully', 'data' => $pembelians], 200);
    }
    
    
}
