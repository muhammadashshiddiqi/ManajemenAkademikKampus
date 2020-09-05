<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
   protected $table = 'forum';
   protected $fillable = ['forum_id','forum_judul','forum_slug','forum_konten','forum_user','forum_created_at'];

   public function user(){
   	 return $this->belongsTo('App\User', 'forum_user', 'id');
   }

   public function komentar(){
   		return $this->hasMany('App\Komentar', 'kmtr_forum', 'forum_id');
   }

   public function rn_forum(){
	   	$lastForum = $this->orderBy('forum_id', 'desc')->first();
	   	if(!$lastForum){
	   		$number = 1;	
	   	}else{
	   		$number = substr($lastForum->forum_id, 2);
	   	}

	   	return 'FR'.sprintf('%06d', intval($number)+1);
   }
}