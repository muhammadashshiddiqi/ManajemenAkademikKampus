@extends('layout.master')

@section('css_header')
@endsection

@section('content_main')

	<div class="container-fluid">
		<div class="panel panel-profile">

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
		
			<div class="clearfix">
				<!-- LEFT COLUMN -->
				<div class="profile-left">
					<!-- PROFILE HEADER -->
					<div class="profile-header">
						<div class="overlay"></div>
						<div class="profile-main">
							<img src="{{ $data->getAvatar() }}" width="100" height="100" class="img-circle" alt="Avatar">
							<h3 class="name">{{$data->dsn_nama}}</h3>
							<span class="online-status status-available">Available</span>
						</div>
						<div class="profile-stat">
							<div class="row">
								<div class="col-md-4 stat-item">
									{{ $data->matakuliah()->count() }}<span>Mata Kuliah</span>
								</div>
								<div class="col-md-4 stat-item">
									15 <span>Awards</span>
								</div>
								<div class="col-md-4 stat-item">
									2174 <span>Points</span>
								</div>
							</div>
						</div>
					</div>
					<!-- END PROFILE HEADER -->
					<!-- PROFILE DETAIL -->
					<div class="profile-detail">
						<div class="profile-info">
							<h4 class="heading">Data Lengkap</h4>
							<ul class="list-unstyled list-justify">
								<li>ID Mahasiswa <span>{{ $data->dsn_code }}</span></li>
								<li>Jenis Kelamin <span>@if($data->dsn_kelamin == 'L') Laki-laki @else Perempuan @endif</span></li>
								<li>No. Handphone <span>{{ $data->dsn_hp }}</span></li>
							</ul>
						</div>
						<div class="text-center"><a href="" class="btn btn-primary">Edit Profile</a></div>
					</div>
					<!-- END PROFILE DETAIL -->
				</div>
				<!-- END LEFT COLUMN -->
				<!-- RIGHT COLUMN -->
				<div class="profile-right">
					<!-- TABBED CONTENT -->
					<div class="custom-tabs-line tabs-line-bottom left-aligned">
						<ul class="nav" role="tablist">
							<li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Mata Kuliah yang sudah diajarkan oleh {{$data->dsn_nama}}</a></li>
						</ul>
					</div>
					<div class="tab-content">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Kode</th>
									<th>Matakuliah</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data->matakuliah()->get()->all() as $pel)
								<tr>
									<th>{{ $pel->matkul_code }}</th>
									<th>{{ $pel->matkul_desc }}</th>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<!-- END TABBED CONTENT -->
				</div>
				<!-- END RIGHT COLUMN -->
			</div>
		</div>
	</div>
	
@endsection

@section('js_footer')
@endsection