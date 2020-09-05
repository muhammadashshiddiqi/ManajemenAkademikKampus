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
							<h3 class="panel-title">Forum</h3>
							<div class="right">
								<button type="button" class="" title="Tambah" data-toggle="modal" data-target="#myForum"><i class="lnr lnr-plus-circle"></i></button>
								<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
							</div>
						</div>
						<div class="panel-body" style="overflow: hidden; width: auto; height: 430px;">
							<ul class="list-unstyled activity-list">
								@foreach($forum as $frm)	
								<li>
									<img src="assets/img/user1.png" alt="Avatar" class="img-circle pull-left avatar">
									<p><a href="{{ route('forum.view', ['id' => $frm->forum_id]) }}">{{ $frm->user->name }} </a>{{ $frm->forum_judul }}<span class="timestamp">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($frm->forum_created_at))->diffForHumans()}}</span></p>
								</li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="myForum" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->

		    	<div class="modal-content">
		      	<form action="{{ route('forum.create') }}" method="post" enctype="multipart/form-data">
			        <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Add Forum</h4>
			        </div>
			      	<div class="modal-body">
			        		{{ csrf_field() }}
								  <div class="form-group {{ $errors->has('frm_judul') ? 'has-error' : '' }}">
								    <label for="frm_judul">Judul</label>
								    <input type="text" class="form-control" name="frm_judul" id="frm_judul" value="{{ old('frm_judul') }}" required placeholder="Masukan Judul">
								    @if($errors->has('frm_judul')) 
												<span class="help-block">{{$errors->first('frm_judul')}}</span>
								    @endif
								  </div>
								  <div class="form-group {{ $errors->has('frm_content') ? 'has-error' : '' }}">
								    <label for="frm_content">Content</label>
								    <textarea name="frm_content" class="form-control" id="frm_content" cols="30" rows="10">{{old('frm_content')}}</textarea>
								    @if($errors->has('frm_content')) 
												<span class="help-block">{{$errors->first('frm_content')}}</span>
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

	</div>

@endsection