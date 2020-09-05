@extends('layout.master')

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
							<img src="{{ auth()->user()->mahasiswa->getAvatar() }}" width="100" height="100" class="img-circle" alt="Avatar">
							<h3 class="name">{{auth()->user()->mahasiswa->mhs_nama}}</h3>
							<span class="online-status status-available">Available</span>
						</div>
						<div class="profile-stat">
							<div class="row">
								<div class="col-md-4 stat-item">
									{{ auth()->user()->mahasiswa->matakuliah()->count() }}<span>Mata Kuliah</span>
								</div>
								<div class="col-md-4 stat-item">
									{{ auth()->user()->mahasiswa->rata2nilai() }}<span>Rata-Rata Nilai</span>
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
								<li>ID Mahasiswa <span>{{ auth()->user()->mahasiswa->mhs_code }}</span></li>
								<li>Jenis Kelamin <span>@if(auth()->user()->mahasiswa->mhs_kelamin == 'L') Laki-laki @else Perempuan @endif</span></li>
								<li>No. Handphone <span>{{ auth()->user()->mahasiswa->mhs_hp }}</span></li>
							</ul>
						</div>
						<div class="text-center"><a href="{{ route('mahasiswa.edit', ['id' => auth()->user()->mahasiswa->mhs_code]) }}" class="btn btn-primary">Edit Profile</a></div>
					</div>
					<!-- END PROFILE DETAIL -->
				</div>
				<!-- END LEFT COLUMN -->
				<!-- RIGHT COLUMN -->
				<div class="profile-right">
					<!-- TABBED CONTENT -->
					<div class="custom-tabs-line tabs-line-bottom left-aligned">
						<ul class="nav" role="tablist">
							<li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Mata Pelajaran</a></li>
						</ul>
					</div>
					<div class="tab-content">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Matakuliah</th>
									<th>Dosen</th>
									<th>Semester</th>
									<th>Harian</th>
									<th>UTS</th>
									<th>UAS</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								@foreach(auth()->user()->mahasiswa->matakuliah()->get()->all() as $pel)
								<tr>
									<td>{{ $pel->matkul_desc }}</td>
									<td>{{ $pel->dosen->dsn_nama }}</td>
									<td>{{ $pel->matkul_semester }}</td>
									<td>{{ $pel->pivot->harian }}</td>
									<td>{{ $pel->pivot->uts }}</td>
									<td>{{ $pel->pivot->uas }}</td>
									<td>{{ $pel->pivot->total }}</td>
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