<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Mahasiswa;
use App\User;
class MahasiswaImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {	
    	$i = 1;
			$lastMahasiswa = Mahasiswa::orderBy('created_at', 'desc')->first();
	    if ( ! $lastMahasiswa){
	         $number = 0;
	    }else {
	         $number = substr($lastMahasiswa->mhs_code, 2);
	    }
       foreach ($collection as $key => $row) {
					if($key >= 3){
						
						$user = new User();
						$user->name = $row[0];
						$user->role = 'mahasiswa';
						$user->email = $row[3];
						$user->password = bcrypt('ganteng');
						$user->remember_token = str_random(60);
						$user->save();

						$isi_data = array(
							'mhs_code' => 'IB'.sprintf('%04d', intval($number) + $i++),
							'mhs_nama' => $row[0],
							'mhs_hp' => $row[1],
							'mhs_kelamin' => $row[2],
							'mhs_user' => $user->id
						);

						Mahasiswa::create($isi_data);
					}       
       }
    }
}
