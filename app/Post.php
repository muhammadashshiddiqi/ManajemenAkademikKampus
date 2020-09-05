<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

  protected $table = 'post';
  protected $fillable = ['post_id','post_title','post_content','post_slug','post_thumbnail','post_userid','post_catagoryid','created_at','updated_at'];

  public function user(){
    return $this->belongsTo('App\User', 'post_userid', 'id');
  }

  public function running_number(){
  	$year = Carbon::now()->format('y');
  	$lastPost = $this->orderBy('created_at', 'desc')->first();
  	if(!$lastPost){
  		$number = 0;
  	}else{
  		$number = substr($lastPost->post_id, 4);
  	}

  	return 'PS'.$year.sprintf('%04d', intval($number) + 1);
  }

  public function thumbnail(){
    if(!$this->post_thumbnail){
      return asset('images/default.jpg');
    }
    return asset('images/blog/'.$this->post_thumbnail);
  }

}

