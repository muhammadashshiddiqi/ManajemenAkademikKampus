<?php

namespace App\Http\Controllers\API;
use DB;
use App\Mahasiswa;
use App\Mahasiswa_Matakuliah;
use App\Matakuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
  public function editnilai(Request $request, $id, $nilai){
  	$val = (float)$request->value;
  	$pk = $request->pk;

  	$qry = Mahasiswa::where('mhs_code', $id)->get()->first();
  	$pivot = $qry->matakuliah()->where('matakuliah_id', $pk)->get()->all();
  	foreach ($pivot as $vals) {
  		$NHarian = (float)$vals->pivot->harian;
  		$NUTS = (float)$vals->pivot->uts;
  		$NUAS = (float)$vals->pivot->uas;
  	}

  	if($nilai == 'hari'){
  		$total = ($val*0.3)+($NUTS*0.4)+($NUAS*0.4);
  		$qry->matakuliah()->updateExistingPivot($pk, ['harian' => $val, 'total' => $total]);
  	}elseif ($nilai == 'uts') {
  		$total = ($NHarian*0.3)+($val*0.4)+($NUAS*0.4);
  		$qry->matakuliah()->updateExistingPivot($pk, ['uts' => $val, 'total' => $total]);
  	}else{
  		$total = ($NHarian*0.3)+($NUTS*0.4)+($val*0.4);
  		$qry->matakuliah()->updateExistingPivot($pk, ['uas' => $val, 'total' => $total]);
  	}
  }
}
