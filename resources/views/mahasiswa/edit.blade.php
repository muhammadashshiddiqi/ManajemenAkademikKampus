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
	
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">Edit Mahasiswa</h3>
						</div>
						
							<form action="update" method="post" enctype="multipart/form-data">
							<div class="panel-body no-padding">
								<div class="col-md-12">
									{{ csrf_field() }}
				        	<input type="hidden" name="_method" value="PUT">
									<div class="form-group {{$errors->has('kode_mhs') ? 'has-error' : ''}}">
									    <label for="kode_mhs">Kode Mahasiswa</label>
									    <input type="text" class="form-control" name="kode_mhs" id="kode_mhs" readonly value="{{$data->mhs_code}}" readonly placeholder="Kode Mahasiswa ...">

									    @if($errors->has('kode_mhs'))
												<span class="has-block">{{$errors->first('kode_mhs')}}</span>
									    @endif
									</div>
									<div class="form-group {{$errors->has('nama_mhs') ? 'has-error' : ''}}">
									    <label for="nama_mhs">Nama Mahasiswa</label>
									    <input type="text" class="form-control" name="nama_mhs" id="nama_mhs" value="{{$data->mhs_nama}}" placeholder="Nama Lengkap Mahasiswa ...">

									    @if($errors->has('nama_mhs'))
												<span class="has-block">{{$errors->first('nama_mhs')}}</span>
									    @endif
									</div>
									<div class="form-group {{$errors->has('hp_mhs') ? 'has-error' : ''}}">
									    <label for="hp_mhs">No HP</label>
									    <input type="text" class="form-control" id="hp_mhs" maxlength="13" name="hp_mhs" value="{{$data->mhs_hp}}" placeholder="No Hp ....">

									    @if($errors->has('hp_mhs'))
												<span class="has-block">{{$errors->first('hp_mhs')}}</span>
									    @endif
									</div>
									<div class="form-group {{$errors->has('klm_mhs') ? 'has-error' : ''}}">	
										<label for="hp_mhs">Jenis Kelamin</label>
										<select name="klm_mhs" id="klm_mhs" class="form-control">
											<option value="L" @if($data->mhs_kelamin == 'L') selected @endif>Laki-laki</option>
											<option value="P" @if($data->mhs_kelamin == 'P') selected @endif>Perempuan</option>
										</select>
								    @if($errors->has('klm_mhs'))
											<span class="has-block">{{$errors->first('klm_mhs')}}</span>
								    @endif
									</div>
									<div class="form-group">
									    <label for="avatar_mhs">Upload Avatar</label>
									    <input type="file" class="form-control" id="avatar_mhs" name="avatar_mhs">
									</div>
								</div>
							</div>
							<div class="panel-footer">
								<div class="row">
									<div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i> Last 24 hours</span></div>
									<div class="col-md-6 text-right"><button type="submit" class="btn btn-warning">Update</button></div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection