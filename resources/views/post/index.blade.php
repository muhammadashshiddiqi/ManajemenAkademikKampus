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
							<h3 class="panel-title">Data Post</h3>
							<div class="right">
								<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
								<a href="{{ route('post.create') }}"><button type="button" class=""><i class="lnr lnr-plus-circle"></i></button></a>
							</div>
						</div>
						<div class="panel-body no-padding">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>ID Post</th>
										<th>User</th>
										<th>Title</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									@php $no=1; @endphp
									
									@foreach($data_all as $data)

									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $data->post_id }}</td>
										<td>{{ $data->user->name }}</td>
										<td>{{ $data->post_title }}</td>
										<td>
												<a target="_blank" href="{{ route('site.singlepost', $data->post_slug) }}" class="btn btn-info btn-sm delete">View</a>

												<a href="#" class="btn btn-warning btn-sm edit">Edit</a>
												<a href="#" class="btn btn-danger btn-sm delete">Hapus</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

@endsection

@section('js_footer')
	<!-- <script>
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
	</script> -->
@endsection