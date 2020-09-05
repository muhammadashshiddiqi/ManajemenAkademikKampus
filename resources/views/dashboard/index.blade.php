@extends('layout.master')

@section('content_main')
<br>
<div class="col col-md-6">
	<div class="panel">
		<div class="panel-heading">
			<h3 class="panel-title">Data Mahasiswa Berprestasi 5 Besar</h3>
		</div>
		<div class="panel-body no-padding">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Ranking</th>
						<th>Code</th>
						<th>Nama</th>
						<th>Rata-rata Nilai</th>
					</tr>
				</thead>
				<tbody>
					@php $no=1; @endphp
					@foreach(Ranking5Besar() as $data)
					<tr>
						<td>{{ $no++ }}</td>
						<td>{{ $data->mhs_code }}</td>
						<td>{{ $data->mhs_nama }}</td>
						<td>{{ $data->rataNilai }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="panel-footer">
			<div class="row">
				<div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i> Last 24 hours</span></div>
				<div class="col-md-6 text-right"><a href="#" class="btn btn-primary">View All to XLSX</a></div>
			</div>
		</div>
	</div>
</div>
<div class="col col-md-6">
	<div class="col-md-6">
		<div class="metric">
			<span class="icon"><i class="fa fa-download"></i></span>
			<p>
				<span class="number">{{ TotalMahasiswa() }}</span>
				<span class="title">Mahasiswa</span>
			</p>
		</div>
	</div>
	<div class="col-md-6">
		<div class="metric">
			<span class="icon"><i class="fa fa-shopping-bag"></i></span>
			<p>
				<span class="number">{{ TotalDosen() }}</span>
				<span class="title">Dosen</span>
			</p>
		</div>
	</div>
	<div class="col-md-6">
		<div class="metric">
			<span class="icon"><i class="fa fa-eye"></i></span>
			<p>
				<span class="number">274,678</span>
				<span class="title">Visits</span>
			</p>
		</div>
	</div>
	<div class="col-md-6">
		<div class="metric">
			<span class="icon"><i class="fa fa-bar-chart"></i></span>
			<p>
				<span class="number">35%</span>
				<span class="title">Conversions</span>
			</p>
		</div>
	</div>
</div>
@endsection