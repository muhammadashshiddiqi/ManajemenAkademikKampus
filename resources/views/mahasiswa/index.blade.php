@extends('layout.master')

@section('content_main')
	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">

					@if(session('sukses'))
					<div class="alert alert-success">
				  	<strong>Success!</strong> {{ session('sukses') }}
					</div>
					@endif
					@if(session('error'))
					<div class="alert alert-danger">
				  	<strong>Failed!</strong> {{ session('error') }}
					</div>
					@endif
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">Data Mahasiswa</h3>
							<div class="right">
								<button type="button" class="" title="Tambah" data-toggle="modal" data-target="#myMahasiswa"><i class="lnr lnr-plus-circle"></i></button>
								<button type="button" class="" title="Import Data" data-toggle="modal" data-target="#myUpload"><i class="lnr lnr-upload"></i></button>
								<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
							</div>
						</div>
						<div class="panel-body no-padding">
							<table class="table table-striped" id="table_mahasiswa">
								<thead>
									<tr>
										<th>Code</th>
										<th>Nama</th>
										<th>Kelamin</th>
										<th>No Hp</th>
										<th>Rata-rata Nilai</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<!-- <tbody>
									@php $no=1; @endphp
								
									@foreach($data_all as $data)
									<tr>
										<td>{{ $no++ }}</td>
										<td><a href="{{ route('mahasiswa.profile', ['id' => $data->mhs_code]) }}">{{ $data->mhs_code }}</a></td>
										<td><a href="{{ route('mahasiswa.profile', ['id'=> $data->mhs_code]) }}">{{ $data->mhs_nama }}</a></td>
										<td>{{ $data->mhs_kelamin }}</td>
										<td>{{ $data->mhs_hp }}</td>
										<td>{{ $data->rata2nilai() }}</td>
										<td><a href="#" mahasiswa-id="{{$data->mhs_code}}" mahasiswa-href="{{ route('mahasiswa.edit', ['id'=> $data->mhs_code]) }}" class="btn btn-warning btn-sm edit">Edit</a>
												<a href="#" mahasiswa-id="{{$data->mhs_code}}" mahasiswa-href="{{ route('mahasiswa.delete', ['id'=> $data->mhs_code]) }}" class="btn btn-danger btn-sm delete">Hapus</a>
										</td>
									</tr>
									@endforeach
								</tbody> -->
							</table>
						</div>
						<div class="panel-footer">
							<div class="row">
								<div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i> Last 24 hours</span></div>
								<div class="col-md-6">
									<div class="pull-right"><a href="{{route('mahasiswa.exportxls')}}" class="btn btn-success">View All to XLSX</a></div>  
									
									<div class="pull-right"><a href="{{route('mahasiswa.exportpdf')}}" class="btn btn-danger">View All to PDF</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal content-->
		  <div class="modal fade" id="myMahasiswa" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		    	<div class="modal-content">
		        <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Add Mahasiswa</h4>
		        </div>
		      	<div class="modal-body">
		        	<form action="{{ route('mahasiswa.create') }}" method="post" enctype="multipart/form-data">
		        		{{ csrf_field() }}
							  <div class="form-group {{ $errors->has('kode_mhs') ? 'has-error' : '' }}">
							    <label for="kode_mhs">Kode Mahasiswa</label>
							    <input type="text" class="form-control" name="kode_mhs" id="kode_mhs" value="{{ (old('kode_mhs') == '') ? $rn_mahasiswa : old('kode_mhs') }}" required placeholder="Kode Mahasiswa ..." readonly="readonly">
							    @if($errors->has('kode_mhs')) 
											<span class="help-block">{{$errors->first('kode_mhs')}}</span>
							    @endif
							  </div>
							  <div class="form-group {{ $errors->has('email_mhs') ? 'has-error' : '' }}">
							    <label for="nama_mhs">Email</label>
							    <input type="email" class="form-control" name="email_mhs" id="email_mhs" required placeholder="Email Mahasiswa ..." value="{{old('email_mhs')}}">
							    @if($errors->has('email_mhs')) 
											<span class="help-block">{{$errors->first('email_mhs')}}</span>
							    @endif
							  </div>
							  <div class="form-group {{ $errors->has('nama_mhs') ? 'has-error' : '' }}">
							    <label for="nama_mhs">Nama Mahasiswa</label>
							    <input type="text" class="form-control" name="nama_mhs" id="nama_mhs" placeholder="Nama Lengkap Mahasiswa ..." value="{{old('nama_mhs')}}">
							    @if($errors->has('nama_mhs')) 
											<span class="help-block">{{$errors->first('nama_mhs')}}</span>
							    @endif
							  </div>
							  <div class="form-group {{ $errors->has('hp_mhs') ? 'has-error' : '' }}">
							    <label for="hp_mhs">No HP</label>
							    <input type="text" class="form-control" id="hp_mhs" maxlength="13" name="hp_mhs" placeholder="No Hp ...." value="{{old('hp_mhs')}}">
							    @if($errors->has('hp_mhs')) 
											<span class="help-block">{{$errors->first('hp_mhs')}}</span>
							    @endif
							  </div>
							  <div class="form-group {{ $errors->has('klm_mhs') ? 'has-error' : '' }}">	
										<label for="hp_mhs">Jenis Kelamin</label>
										<select name="klm_mhs" id="klm_mhs" class="form-control">
											<option value="L" {{ (old('klm_mhs') == 'L') ? 'selected' : '' }}>Laki-laki</option>
											<option value="P" {{ (old('klm_mhs') == 'P') ? 'selected' : '' }}>Perempuan</option>
										</select>
										@if($errors->has('hp_mhs')) 
											<span class="help-block">{{$errors->first('hp_mhs')}}</span>
							    	@endif
							  </div>
							  <div class="form-group {{ $errors->has('avatar_mhs') ? 'has-error' : '' }}">
							    <label for="avatar_mhs">Avatar</label>
							    <input type="file" class="form-control" id="avatar_mhs" name="avatar_mhs">
							    @if($errors->has('avatar_mhs'))
							    	<span class="help-block">{{$errors->first('avatar_mhs')}}</span>
							    @endif
							  </div>
		      	</div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		          <button type="submit" class="btn btn-default">Submit</button>
		        </div>
		      	</form>
		    	</div>
		      
		    </div>
			</div>
			<div class="modal fade" id="myUpload" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		    	<div class="modal-content">
		        <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Import Data Mahasiswa</h4>
		        </div>
		      	<div class="modal-body">
		        	<form action="{{ route('mahasiswa.import') }}" method="post" enctype="multipart/form-data">
		        		{{ csrf_field() }}
							  
							  <div class="form-group">
							    <label for="data_mahasiswa">Upload Data</label>
							    <input type="file" class="" id="data_mahasiswa" name="data_mahasiswa">
							  </div>
		      	</div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		          <button type="submit" class="btn btn-default">Upload</button>
		        </div>
		      	</form>
		    	</div>
		      
		    </div>
			</div>
		</div>
	</div>

@endsection

@section('js_footer')
	<script>
			$(document).ready(function(){
				$('#table_mahasiswa').DataTable({
					processing: true,
					'bFilter': true,
    			'bDestroy': true,
					serverSide: true,
					paginationType: "full_numbers",
					ajax: "{{ route('mahasiswa.getajaxshow') }}",
					columns: [
							/*{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},*/
							{data:'mhs_code', name:'mhs_code' },
							{data:'mhs_nama', name:'mhs_nama' },
							{data:'mhs_kelamin', name:'mhs_kelamin' },
							{data:'mhs_hp', name:'mhs_hp' },
							{data:'rata2_nilai', name:'rata2_nilai'},
							{data:'aksi', name:'aksi', orderable: false, searchable: false },
					]
				});

				$('.delete').click(function(){
					let id = $(this).attr('mahasiswa-id');
					let href = $(this).attr('mahasiswa-href');

					swal({
					  title: "Yakin?",
					  text: "Mau dihapus data Mahasiswa ID : "+id+" ?",
					  icon: "warning",
					  buttons: true,
					  dangerMode: true,
					})
					.then((willDelete) => {
					  if(willDelete) {
					  	window.location = href;
					  }
					}); 
				});

				$('.edit').click(function(){
					let id = $(this).attr('mahasiswa-id');
					let href = $(this).attr('mahasiswa-href');

					swal({
					  title: "Yakin?",
					  text: "Mau diedit data Mahasiswa ID : "+id+" ?",
					  icon: "warning",
					  buttons: true,
					  dangerMode: true,
					})
					.then((willDelete) => {
					  if(willDelete) {
					  	window.location = href;
					  }
					}); 
				});
			});
	</script>
@endsection