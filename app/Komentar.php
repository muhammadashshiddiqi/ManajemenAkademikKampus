<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
   protected $table = 'komentar';
   protected $fillable = ['kmtr_id','kmtr_isi','kmtr_user','kmtr_forum','kmtr_parent','kmtr_created_at'];

   public function user(){
   		return $this->belongsTo('App\User', 'kmtr_user', 'id'); 
   }

   public function forum(){
   		return $this->belongsTo('App\Forum', 'kmtr_forum', 'forum_id'); 
   }
}
