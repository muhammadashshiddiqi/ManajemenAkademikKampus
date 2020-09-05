<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\Matakuliah;
use App\User;
use DB;
use App\Exports\MahasiswaExport;
use App\Imports\MahasiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use PDF;
use DataTables;

class MahasiswaController extends Controller
{
    
    public function index(Request $request)
    {
        if($request->has('cari')){
            $data_mahasiswa = Mahasiswa::where('mhs_code', 'LIKE', '%'.$request->cari.'%')
                                      ->orWhere('mhs_nama', 'LIKE', '%'.$request->cari.'%')
                                      ->orWhere('mhs_kelamin', 'LIKE', '%'.$request->cari.'%')
                                      ->orWhere('mhs_hp', 'LIKE', '%'.$request->cari.'%')->get();
        }else{
            $data_mahasiswa = Mahasiswa::all();
        }

        $rn = new Mahasiswa();
        $norut = $rn->running_number();

        return view('mahasiswa.index', ['data_all' => $data_mahasiswa, 'rn_mahasiswa' => $norut]);
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'kode_mhs' => 'required|unique:mahasiswa,mhs_code',
        'nama_mhs' => 'required|min:4',
        'email_mhs' => 'required|unique:users,email',
        'hp_mhs' => 'required|numeric',
        'klm_mhs' => 'required',
        'avatar_mhs' => 'mimes:jpeg,bmp,png,jpg',
      ]);

      $kode_mhs = $request['kode_mhs'];
      $nama_mhs = $request['nama_mhs'];
      $email_mhs = $request['email_mhs'];
      $hp_mhs = $request['hp_mhs'];
      $klm_mhs = $request['klm_mhs'];

      if($request->hasFile('avatar_mhs')){
        $request->file('avatar_mhs')->move('images/mahasiswa/',$request->file('avatar_mhs')->getClientOriginalName());
        $nmDB = $request->file('avatar_mhs')->getClientOriginalName();
      }else{
        $nmDB = NULL;
      }

        $usr = new User();
        $usr->role = 'mahasiswa';
        $usr->name = $nama_mhs;
        $usr->email = $email_mhs;
        $usr->password = bcrypt('ganteng');
        $usr->remember_token = str_random(60);
        $usr->save();
        $userid = $usr->id;

        $data = array('mhs_code' => $kode_mhs,
                    'mhs_nama' => $nama_mhs,
                    'mhs_hp' => $hp_mhs,
                    'mhs_kelamin' => $klm_mhs,
                    'mhs_user' => $userid,
                    'mhs_avatar' => $nmDB);
        //dd($data);
      $hasil = Mahasiswa::create($data);
      return redirect('mahasiswa')->with('sukses', 'Data Berhasil di input ...');
    }

    public function profile($id)
    {
        $data = Mahasiswa::where('mhs_code', $id)->first();
        $matkul = Matakuliah::all();

        $chart_catagories = $data->matakuliah()->get();

        $isi1 = $isi2 = $isi3 = $isi4 = $isi5 = array();
        foreach ($chart_catagories as $val) {
          $isi1[] = $val->matkul_desc;
          $isi2[] = (float)$val->pivot->harian;
          $isi3[] = (float)$val->pivot->uts;
          $isi4[] = (float)$val->pivot->uas;
          $isi5[] = (float)$val->pivot->total;
        }

        return view('mahasiswa.profile', [
                      'data' => $data, 
                      'matkul' => $matkul, 
                      'chartCatagories' => $isi1,
                      'chartNHarian' => $isi2,
                      'chartNUTS' => $isi3,
                      'chartNUAS' => $isi4,
                      'chartNTotal' => $isi5,
                      ]);
    }

    public function edit($id)
    {
      $data = Mahasiswa::where('mhs_code', $id)->first();
      return view('mahasiswa.edit', ['data' => $data]);
    }

    
    public function update(Request $request, $id)
    {   
      $this->validate($request, [
        'nama_mhs' => 'required|min:4',
        'hp_mhs' => 'required|numeric',
        'klm_mhs' => 'required',
        'avatar_mhs' => 'mimes:jpeg,bmp,png,jpg',
      ]);
      

        $kode_mhs = $request['kode_mhs'];
        $nama_mhs = $request['nama_mhs'];
        $hp_mhs = $request['hp_mhs'];
        $klm_mhs = $request['klm_mhs'];

        
        $data = array('mhs_nama' => $nama_mhs,
                      'mhs_hp' => $hp_mhs,
                      'mhs_kelamin' => $klm_mhs);

        $SQL = Mahasiswa::where('mhs_code', $id)->update($data);

        if($request->hasFile('avatar_mhs')){
            $request->file('avatar_mhs')->move('images/mahasiswa/',$request->file('avatar_mhs')->getClientOriginalName());
            $nmDB = $request->file('avatar_mhs')->getClientOriginalName();

            $dataImg = array('mhs_avatar' => $nmDB);
            $SQL = Mahasiswa::where('mhs_code', $id)->update($dataImg);
        }
        return redirect('mahasiswa')->with('sukses', 'Data Berhasil di Update');
    }

    public function destroy($id)
    {
         //delete user
        $del = Mahasiswa::where('mhs_code', $id)->first();
        $user_id = $del->mhs_user;
        $userdelete = User::where('id', $user_id);
        $userdelete->delete();

        //delete mahasiswa
        $delete_id = Mahasiswa::where('mhs_code', $id)->delete();

        return redirect('mahasiswa')->with('sukses', 'Data Berhasil di delete');
    }

    public function addnilai(Request $request, $id){
      $qry = Mahasiswa::where('mhs_code', $id)->get()->first();

      if($qry->matakuliah()->where('matakuliah_id', $request->pilih_matkul)->exists()){
        return redirect('mahasiswa/'.$id.'/profile')->with('error', 'Data MataKuliah sudah ada');
      }

      $arr = array(
        'harian' => $request->harian,
        'uts' => $request->uts,
        'uas' => $request->uas,
        'total' => (($request->harian*0.3)+($request->uts*0.4)+($request->uas*0.4))
      );
      $input = $qry->matakuliah()->attach($request->pilih_matkul, $arr);

      return redirect('mahasiswa/'.$id.'/profile')->with('sukses', 'Data MataKuliah terinput');
    }

    public function deletenilai($id, $matkul){
      $qry = Mahasiswa::where('mhs_code', $id)->get()->first();
      $qry->matakuliah()->detach($matkul);
      return redirect()->back()->with('sukses', 'Data berhasil di delete');
    }

    public function exportxls() 
    {
        return Excel::download(new MahasiswaExport, 'mahasiswa.xlsx');
    }

    public function exportpdf() 
    {
      $data = Mahasiswa::all();

      $pdf = PDF::loadView('export.pdf.mahasiswa', ['data'=> $data]);
      return $pdf->download('Mahasiswa.pdf');
    }

    public function getajaxshow(){
      $data = Mahasiswa::latest()->get();
      return DataTables::of($data)
            ->addColumn('rata2_nilai', function($m){
                return $m->rata2nilai();
            })
            ->addColumn('aksi', function($data){
              $edit = route('mahasiswa.edit', ['id'=> $data->mhs_code]);
              $delete = route('mahasiswa.delete', ['id'=> $data->mhs_code]);
              
                $button = "<a href=\"".$edit."\" mahasiswa-id=\"{{$data->mhs_code}}\" mahasiswa-href=\"{{ route('mahasiswa.edit', ['id'=> $data->mhs_code]) }}\" class=\"btn btn-warning btn-sm edit\">Edit</a>";
                $button .= "<a href=\"".$delete."\" mahasiswa-id=\"{{$data->mhs_code}}\" mahasiswa-href=\"{{ route('mahasiswa.delete', ['id'=> $data->mhs_code]) }}\" class=\"btn btn-danger btn-sm delete\">Hapus</a>";

                return $button;
            })
            ->rawColumns(['no','rata2_nilai','aksi'])
            ->make(true);
    }

    public function profilesaya(){
      return view('layout.profilesaya');
    }

    public function importData(Request $request){
      Excel::import(new MahasiswaImport, $request->file('data_mahasiswa'));
      return redirect()->route('mahasiswa.index');
    }
}
