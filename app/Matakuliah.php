<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $table = 'matakuliah';
    protected $fillable = ['matkul_code','matkul_desc','matkul_semester', 'dosen_id'];

    //public BelongsToMany belongsToMany(string $related, string $table = null, string $foreignKey = null, string $otherKey = null, string $relation = null);
    //$this->hasMany('App\Comment', 'foreign_key', 'local_key');
    //$this->belongsTo('App\Post', 'foreign_key', 'other_key');
    
    public function mahasiswa(){
    	return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_matakuliah', 'mahasiswa_id', 'matakuliah_id', 'matkul_code', 'mhs_code')->withPivot(['harian','uts','uas','total']);
    }
    
    public function dosen(){
    	return $this->belongsTo('App\Dosen', 'dosen_id', 'dsn_code');
    }
}