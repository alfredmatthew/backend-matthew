<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailSend;

class AuthController extends Controller
{ 
    public function sendEmail(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        
        if ($user) {
            $token = md5($user->email . $user->password);
            $user->token = $token;
            $user->save();

            $details = [
                'website' => 'Atma Library',
                'token' => $user->token,
                'url' =>  'http://localhost:5173/dashboard/changepassword/' . $user->token,
            ];
            Mail::to($email)->send(new MailSend($details));

            return response([
                'message' => 'Email ditemukan',
                'user' => $user
            ],200);
        } else {
            return response([
                'message' => 'Email tidak ditemukan'
            ], 400);
        }
    }

    public function changePasswordToken(Request $request, $token)
    {
        $user = User::where('token', $token)->first();
        if ($user) {
            $user->password = Hash::make($request->newPassword);
            $user->token = null;
            $user->save();

            return response([
                'message' => 'Password berhasil diubah'
            ], 200);
        } else {
            return response([
                'message' => 'Token sudah tidak valid'
            ], 401);
        }
    }
}
