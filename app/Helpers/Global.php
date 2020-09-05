<?php
use App\Mahasiswa;
use App\Dosen;
function Ranking5Besar(){
	$data_mahasiswa = Mahasiswa::all();
	$data_mahasiswa->map(function($id){
		$id->rataNilai = $id->rata2nilai();
		return $id;
	});
	$dataall = $data_mahasiswa->sortByDesc('rataNilai')->take(5);
	return $dataall;
}

function TotalMahasiswa(){
	$data_count = Mahasiswa::count();
	return $data_count;
}

function TotalDosen(){
	$data_count = Dosen::count();
	return $data_count;
}