<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $fillable = ['mhs_code','mhs_nama','mhs_hp','mhs_kelamin','mhs_avatar','mhs_user'];

    public function getAvatar(){
    	if(!$this->mhs_avatar){
    		return asset('images/default.jpg');
    	}
    	return asset('images/mahasiswa/'.$this->mhs_avatar);
    }

   //public BelongsToMany belongsToMany(string $related, string $table = null, string $foreignKey = null, string $otherKey = null, string $relation = null)
   
    public function matakuliah(){
    	return $this->belongsToMany(Matakuliah::class, 'mahasiswa_matakuliah', 'mahasiswa_id', 'matakuliah_id', 'mhs_code', 'matkul_code')->withPivot(['harian','uts','uas','total']);
    }

    public function rata2nilai(){
        $isi = 0;
        $matkul = 0;
        foreach ($this->matakuliah as $value) {
            $isi += $value->pivot->total;
            $matkul ++;
        }

        return $matkul == 0 ? 0 : round($isi/$matkul);

    }

    public function running_number(){
        $lastMahasiswa = $this->orderBy('created_at', 'desc')->first();
        if ( ! $lastMahasiswa){
             $number = 0;
        }else {
             $number = substr($lastMahasiswa->mhs_code, 2);
        }
     
        return 'IB' . sprintf('%04d', intval($number) + 1);

    }
}
