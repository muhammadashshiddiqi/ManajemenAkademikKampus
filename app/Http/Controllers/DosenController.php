<?php

namespace App\Http\Controllers;

use App\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function profile($id){
        $data = Dosen::where('dsn_code', $id)->get()->first();

        return view('dosen.profile', ['data' => $data]);
    }
}
