<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class SiteController extends Controller
{
  public function index(){
  	return view('site.home');
  }

  public function about(){
    return view('site.about');
  }

  public function blog(){
    $post = Post::all();
  	return view('site.blog', ['post_all' => $post]);
  }

  public function singlepost($slug){
		$post = Post::where('post_slug', $slug)->first();  	
  	return view('site.single-blog', ['post' => $post]);
  }
}
