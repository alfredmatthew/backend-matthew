<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Pembelian;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class HistoriPesananController extends Controller
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

    // public function showPembelian($id)
    // {
    //     $customer = Pembelian::with('Customer')->where('id_user', $id)->first();
    
    //     if (!$customer) {
    //         return response()->json(['message' => 'Customer not found'], 404);
    //     }
    
    //     $pembelians = $customer;
    
    //     return response()->json(['message' => 'Pembelians retrieved successfully', 'data' => $pembelians], 200);
    // }

    public function showHistory()
    {
        {
            // Fetch all distinct user IDs from tblpembelian
            $userIds = Pembelian::distinct()->pluck('id_user');
    
            // Fetch user details along with their transaction history
            $usersWithTransactionHistory = [];
            foreach ($userIds as $userId) {
                $user = Customer::where('id_user', $userId)->first();
                if ($user) {
                    $user->transaction_history = Pembelian::where('id_user', $userId)->get();
                    $usersWithTransactionHistory[] = $user;
                }
            }
    
            return response()->json($usersWithTransactionHistory);
        }
    }
    
}
