<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forum;
use Carbon;

class ForumController extends Controller
{
  public function index(){
  	$forum = Forum::paginate(10);
  	//dd($forum);
   	return view('forum.index', compact(['forum']));
  }

  public function create(Request $request){
  	$forum = new Forum();
  	$isi = array(
  		'forum_id' => $forum->rn_forum(),
			'forum_judul' => $request->frm_judul,
			'forum_slug' => str_replace(" ", "-", $request->frm_judul),
			'forum_konten' => $request->frm_content,
			'forum_user' => auth()->user()->id,
			'forum_created_at' => Carbon\Carbon::now()
  	);

  	Forum::create($isi);

  	return redirect()->back()->with('sukses', 'Forum berhasil ditambahkan');
  }

  public function view($id){
  	$frm = Forum::where('forum_id', $id)->get();

  	//dd($isi);
  	return view('forum.view', compact(['frm']));
  }
}
