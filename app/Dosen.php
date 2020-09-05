<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
  protected $table = 'dosen';
  protected $fillable = ['dsn_code','dsn_nama','dsn_hp','dsn_kelamin','dsn_avatar','dsn_user'];

  public function getAvatar(){
  	if(!$this->dsn_avatar){
  		return asset('images/default.jpg');
  	}
  	return asset('images/dosen/'.$this->dsn_avatar);
  }

  //public BelongsToMany belongsToMany(string $related, string $table = null, string $foreignKey = null, string $otherKey = null, string $relation = null);
  //$this->hasMany('App\Comment', 'foreign_key', 'local_key');
  //$this->belongsTo('App\Post', 'foreign_key', 'other_key');
  
 	public function matakuliah(){
 		return $this->hasMany('App\Matakuliah', 'dosen_id', 'dsn_code');
 	}
 
}
