<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Mahasiswa;
use App\User;
use App\Mail\NotifPendaftaranMahasiswa;

class AuthController extends Controller
{
	public function index(){
		return view('auth.login');
	}

	public function login(Request $request){
		$credentials = [
        'email' => $request['user_email'],
        'password' => $request['user_password']
    ];

    if(Auth::attempt($credentials)){
    	return redirect('/dashboard');
    }
    	return redirect('/auth');

	}

	public function logout(){
		Auth::logout();
		return redirect('/auth');
	}

	public function register(){
		$rn = new Mahasiswa();
		$norut = $rn->running_number();
		
		return view('site.register', ['rn_mahasiswa' => $norut]);
	}

	public function postregister(Request $request){
		
		$usr = new User();
    $usr->role = 'mahasiswa';
    $usr->name = $request->mhs_nama;
    $usr->email = $request->mhs_email;
    $usr->password = bcrypt('ganteng');
    $usr->remember_token = str_random(60);
    $usr->save();

    $userid = $usr->id;
    
    $mahasiswa = Mahasiswa::create([
			'mhs_code' => $request->mhs_code,
			'mhs_nama' => $request->mhs_nama,
			'mhs_hp' => $request->mhs_hp,
			'mhs_kelamin' => $request->mhs_kelamin,
			'mhs_user' => $userid
		]);

		\Mail::to($usr->email)->send(new NotifPendaftaranMahasiswa);
		return view('auth.login');
	}
}
