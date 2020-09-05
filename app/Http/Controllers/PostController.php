<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{

  public function index(){
  	$data = Post::all();
  	return view('post.index', ['data_all' => $data]);
  }

  public function showcreate(){

  	return view('post.show');
  }

  public function create(Request $request){

  	$rn = new Post();
  	$isi = $rn->running_number();
  	$arr = array(
  					'post_id' => $isi,
  					'post_content' => $request->post_content,
  					'post_title' => $request->post_title,
  					'post_thumbnail' => $request->post_thumbnail,
  					'post_userid' => auth()->user()->id,
  					'post_slug' => str_replace(' ', '-', $request->post_title),
  				);

  	$post = Post::create($arr);

  	return redirect()->route('post')->with('sukses', 'Post berhasil di submit');
  }
}
