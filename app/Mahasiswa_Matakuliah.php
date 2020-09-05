<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa_Matakuliah extends Model
{
    protected $table = 'mahasiswa_matakuliah';
    protected $fillable = ['id','mahasiswa_id','matkul_id','harian','uts','uas','total'];

}
