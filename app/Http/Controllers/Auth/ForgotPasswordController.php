<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Mail\SendMailUser;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function sendEmail(Request $request)
    {
        $date = Carbon::now();
        $user = \DB::table('users')->where('email', $request['email'])->get();
        $token = Hash::make($user[0]->id);

        if(count($user) === 0){
            throw new HttpResponseException(response()->json(['error' => 'Não encontramos nenhum cadastro para o email informado.'], 400));
        }

        $existing_user_token = \DB::table('user_token')->where('user_email', $request['email'])->get();

        if(count($existing_user_token) === 0){
            $user_token = \DB::table('user_token')->insert([
                'user_id' => $token,
                'user_email' => $user[0]->email,
                'created_at' => $date,
                'updated_at' => $date
            ]);
        }else {
            $user_token = \DB::table('user_token')
                ->where('user_email', $user[0]->email)
                ->update([
                    'user_id' => $token,
                    'user_email' => $user[0]->email,
                    'updated_at' => $date
                ]);
        }

        Mail::to($user[0]->email)->queue(new SendMailUser($user[0], $token));

        return response()->json(['success' => 'Enviamos um e-mail com as informações para redefinir sua senha.'], 200);
    }
}
