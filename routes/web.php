<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', "SiteController@index")->name('home');
Route::get('/about', "SiteController@about")->name('about');
Route::get('/blog', "SiteController@blog")->name('blog');

Route::get('/register', "AuthController@register")->name('register');
Route::post('/daftar', "AuthController@postregister")->name('daftar');


Route::group(["prefix" => "auth"], function(){
	Route::get('/', "AuthController@index")->name('login');
	Route::post('/login', "AuthController@login");
	Route::get('/logout', "AuthController@logout")->name('logout');
});

Route::group(['middleware' => ['auth', 'checkRole:admin']], function(){

		Route::group(["prefix" => "dashboard"], function(){
			Route::get("/", "DashboardController@index")->name('dashboard');
		});
		
		Route::group(["prefix" => "post"], function(){
			Route::get("/", "PostController@index")->name('post');
			Route::get("/create", "PostController@showcreate")->name('post.create');
			Route::post("/store", "PostController@create")->name('post.createpost');
			Route::get("/{id}/edit", "PostController@showedit")->name('post.edit');
			Route::put("/update", "editController@edit")->name('post.editpost');
		});

		Route::group(["prefix" => "mahasiswa"], function(){
			Route::get("/", "MahasiswaController@index")->name('mahasiswa');
			Route::post("/create", "MahasiswaController@store")->name('mahasiswa.create');
			Route::get("/{id}/edit", "MahasiswaController@edit")->name('mahasiswa.edit');
			Route::put("/{id}/update", "MahasiswaController@update")->name('mahasiswa.update');
			Route::get("/{id}/delete", "MahasiswaController@destroy")->name('mahasiswa.delete');
			Route::get("/{id}/profile", "MahasiswaController@profile")->name('mahasiswa.profile');
			Route::post("/{id}/addnilai", "MahasiswaController@addnilai")->name('mahasiswa.addnilai');
			Route::get("/exportxls", "MahasiswaController@exportxls")->name('mahasiswa.exportxls');
			Route::get("/exportpdf", "MahasiswaController@exportpdf")->name('mahasiswa.exportpdf');
			Route::post("/import", "MahasiswaController@importData")->name('mahasiswa.import');
			Route::get("/{id}/{matkul}/deletenilai", "MahasiswaController@deletenilai")->name('mahasiswa.deletenilai');
			Route::get("/show", "MahasiswaController@getajaxshow")->name('mahasiswa.getajaxshow');
		});

		Route::group(["prefix" => "dosen"], function(){
			Route::get("/{id}/profile", "DosenController@profile")->name('dosen.profile');
		});

});

Route::group(['middleware' => ['auth', 'checkRole:mahasiswa,admin']], function(){

	Route::group(["prefix" => "dashboard"], function(){
		Route::get("/", "DashboardController@index")->name('dashboard');
	});

	Route::group(["prefix" => "forum"], function(){
		Route::get("/", "ForumController@index")->name('forum');
		Route::post("/create", "ForumController@create")->name('forum.create');
		Route::get("/{id}/view", "ForumController@view")->name('forum.view');
	});
	
	Route::get("/profilsaya", "MahasiswaController@profilesaya")->name('profilsaya');
	Route::get("/{id}/edit", "MahasiswaController@edit")->name('mahasiswa.edit');
	Route::put("/{id}/update", "MahasiswaController@update")->name('mahasiswa.update');

});


Route::get('/post/{slug}',['uses' => 'SiteController@singlepost', 'as' => 'site.singlepost']);