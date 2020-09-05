@extends('layout.master')

@section('css_header')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
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
							<h3 class="name">{{$data->mhs_nama}}</h3>
							<span class="online-status status-available">Available</span>
						</div>
						<div class="profile-stat">
							<div class="row">
								<div class="col-md-4 stat-item">
									{{ $data->matakuliah()->count() }}<span>Mata Kuliah</span>
								</div>
								<div class="col-md-4 stat-item">
									{{ $data->rata2nilai() }}<span>Rata-Rata Nilai</span>
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
								<li>ID Mahasiswa <span>{{ $data->mhs_code }}</span></li>
								<li>Jenis Kelamin <span>@if($data->mhs_kelamin == 'L') Laki-laki @else Perempuan @endif</span></li>
								<li>No. Handphone <span>{{ $data->mhs_hp }}</span></li>
							</ul>
						</div>
						<div class="text-center"><a href="{{ route('mahasiswa.edit', ['id' => $data->mhs_code]) }}" class="btn btn-primary">Edit Profile</a></div>
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
						<button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myNilai" >+ Tambah</button>
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
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data->matakuliah()->get()->all() as $pel)
								<tr>
									<th>{{ $pel->matkul_desc }}</th>
									<th><a href="{{ route('dosen.profile', ['id' => $pel->dosen->dsn_code]) }}">{{ $pel->dosen->dsn_nama }}</a></th>
									<th>{{ $pel->matkul_semester }}</th>
									<th><a href="#" class="NHarian" data-type="text" data-pk="{{$pel->matkul_code}}" data-url="{{ route('api.editnilai', ['id' => $data->mhs_code, 'nilai' => 'hari']) }}" data-title="Nilai Harian">{{ $pel->pivot->harian }}</a></th>
									<th><a href="#" class="NUTS" data-type="text" data-pk="{{$pel->matkul_code}}" data-url="{{ route('api.editnilai', ['id' => $data->mhs_code, 'nilai' => 'uts']) }}" data-title="Nilai UTS">{{ $pel->pivot->uts }}</a></th>
									<th><a href="#" class="NUAS" data-type="text" data-pk="{{$pel->matkul_code}}" data-url="{{ route('api.editnilai', ['id' => $data->mhs_code, 'nilai' => 'uas']) }}" data-title="Nilai UAS">{{ $pel->pivot->uas }}</a></th>
									<th>{{ $pel->pivot->total }}</th>
									<th><a href="{{ route('mahasiswa.deletenilai', ['id'=>$data->mhs_code, 'matkul'=>$pel->matkul_code]) }}" onclick="return confirm('Matakuliah ini ingin dihapus ?')"><span class="glyphicon glyphicon-trash"></span></a></th>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>

					<div class="tab-content" id="chart_nilai">
						
					</div>
					<!-- END TABBED CONTENT -->
				</div>
				<!-- END RIGHT COLUMN -->
			</div>
		</div>
	</div>
	
	<!-- Modal content-->
  <div class="modal fade" id="myNilai" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
    	<div class="modal-content">
        <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Add Nilai</h4>
        </div>
      	<div class="modal-body">
        	<form action="{{ route('mahasiswa.addnilai', ['id' => $data->mhs_code]) }}" method="post">
        		{{ csrf_field() }}
						
					  <div class="form-group">	
								<label for="hp_mhs">Pilih Mata Kuliah</label>
								<select name="pilih_matkul" id="pilih_matkul" class="form-control">
									@foreach($matkul as $mat)
									<option value="{{ $mat->matkul_code }}">{{ $mat->matkul_desc }}</option>
									@endforeach
								</select>
					  </div>
					  <div class="form-group">
					    <label for="kode_mhs">Nilai Harian</label>
					    <input type="number" class="form-control" min="0" max="100" name="harian" id="harian" placeholder="Nilai Harian">
					  </div>
					  <div class="form-group">
					    <label for="kode_mhs">Nilai UTS</label>
					    <input type="number" class="form-control" min="0" max="100" name="uts" id="uts" placeholder="Nilai UTS">
					  </div>
					  <div class="form-group">
					    <label for="kode_mhs">Nilai UAS</label>
					    <input type="number" class="form-control" min="0" max="100" name="uas" id="uas" placeholder="Nilai UAS">
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
@endsection

@section('js_footer')
	<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script>
		$(document).ready(function() {
     	$('.NHarian').editable();
     	$('.NUTS').editable();
     	$('.NUAS').editable();
     	$('.NTotal').editable();
    });
		Highcharts.chart('chart_nilai', {
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'Penilaian Mahasiswa'
	    },
	    xAxis: {
	        categories: {!! json_encode($chartCatagories) !!},
	        crosshair: true
	    },
	    yAxis: {
	        min: 0,
	        title: {
	            text: 'Nilai'
	        }
	    },
	    tooltip: {
	        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
	        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
	            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
	        footerFormat: '</table>',
	        shared: true,
	        useHTML: true
	    },
	    plotOptions: {
	        column: {
	            pointPadding: 0.2,
	            borderWidth: 0
	        }
	    },
	    series: [{
	        name: 'Harian',
	        data: {!! json_encode($chartNHarian) !!}

	    }, {
	        name: 'UTS',
	        data: {!! json_encode($chartNUTS) !!}

	    }, {
	        name: 'UAS',
	        data: {!! json_encode($chartNUAS) !!}

	    }, {
	        name: 'Avg Nilai',
	        data: {!! json_encode($chartNTotal) !!}

	    }]
		});
	</script>
@endsection