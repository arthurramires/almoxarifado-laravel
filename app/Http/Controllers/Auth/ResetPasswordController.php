<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function resetPassword(Request $request)
    {
        $date = Carbon::now();
        $user_token = \DB::table('user_token')->where('user_id', $request['token'])->get();

        $user = \DB::table('users')->where('email', $user_token[0]->user_email)->get();
        $difference = $date->diffInMinutes($user_token[0]->updated_at);
        if($difference > 5){
            throw new HttpResponseException(response()->json(['error' => 'Token expirado, solicite novamente sua redefinição de senha.'], 400));
        }

        \DB::table('users')
            ->where('id', $user[0]->id)
            ->update([
                'password' => Hash::make($request['password'])
            ]);

        return response()->json(['success' => 'Senha redefinida com sucesso.'], 200);
    }
}
