<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllController extends Controller
{
    public function home(Request $request)
    {
        $user = Auth::user();
        if ($request->method() == 'GET') {
            if ($user->role == 'Staff') {
                $targets = User::where('division', $user->division)->where('role', 'Inti')->get(['id', 'name']);
            } else {
                $targets = User::where('role', 'Inti')->get(['id', 'name']);
            }
            if ($user->division == 'PSDM' && $user->role == 'Inti') {
                $messages = Message::all();
            } else {
                $messages = [];
            }

            return view('home', compact('user', 'targets', 'messages'));
        } else {
            Message::create($request->all());

            return back();
        }
    }
    public function withMessage($code)
    {
        $user = Auth::user();
        if ($user->division == 'PSDM' && $user->role == 'Inti') {
            $messages = User::where('code', base64_decode($code))->first()->messages;
        } else {
            return back();
        }
        $targets = false;

        return view('home', compact('user', 'targets', 'messages'));
    }

    public function login(Request $request)
    {
        if ($request->method() == 'GET') {
            return view('login');
        } else {
            $user = User::where('code', $request->code)->first();
            if ($user) {
                Auth::login($user);

                return redirect()->intended('/');
            }

            return back();
        }
    }

    public function withCode($code)
    {
        $user = User::where('code', $code)->first();
        if ($user) {
            Auth::login($user);

            return redirect()->intended('/');
        }

        return redirect('login');
    }

    public function logout()
    {
        Auth::logout();

        return back();
    }

    public function sendCode()
    {
        $url = env('APP_URL');
        foreach (User::all() as $item) {
            $message = "Halo {$item->name} sang penyelamat bumi!\n\nNggak terasa ya, udah sejauh ini kita melangkah bersama di BBJ ini. 💪✨ Sebelum lanjut ke langkah selanjutnya, bantu kami untuk berkembang yuk dengan cara beri evaluasi atau kritik konstruktif ke koor dan wakoor divisi kamu. Pendapat dan feedback kalian penting banget untuk BBJ kedepannya!\n\nTenang aja, identitas kalian bakal aman terjaga karena evaluasi ini bersifat anonim\n\nKlik aja link di bawah ini buat isi form evaluasinya\n\nLINK\n{$url}/{$item->code}\n\nEvaluasi akan kami tunggu sampai tanggal 31 yaaa 🙌🏻\n\nTerima kasih yaa udah mau bantu biar kita semua bisa terus berkembang jadi lebih baik lagi! 🤩🙌\n\nSalam semangat,\nDIVISI IT x FRIENDS";
            $this->kirimWa($item->phone, $message);
        }
    }

    private function kirimWa($target, $message)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => [
                'target' => $target,
                'message' => $message,
                'schedule' => 0,
                'typing' => false,
                'delay' => '2',
                'countryCode' => '62',
            ],
            CURLOPT_HTTPHEADER => [
                'Authorization: ' . env('FONNTE_KEY', null),
            ],
        ]);

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }
        curl_close($curl);

        if (isset($error_msg)) {
            echo $error_msg;
        }
        echo $response;
    }
}
