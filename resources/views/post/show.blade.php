@extends('layout.master')


@section('css_header')
<style>
	.ck-editor__editable {
		min-height: 300px;
	}
</style>
@endsection


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
							<h3 class="panel-title">Create Post</h3>
						</div>
						<div class="panel-body no-padding">
								<form action="{{ route('post.createpost') }}" method="post" enctype="multipart/form-data">
		        		{{ csrf_field() }}

									<div class="col-md-9">
									  <div class="form-group {{ $errors->has('post_title') ? 'has-error' : '' }}">
									    <label for="post_title">Title Post</label>
									    <input type="text" class="form-control" name="post_title" id="post_title" required placeholder="Title Post">
									    @if($errors->has('post_title')) 
													<span class="help-block">{{$errors->first('post_title')}}</span>
									    @endif
								  	</div>
								  	<div class="form-group {{ $errors->has('post_content') ? 'has-error' : '' }}">
									    <label for="post_content">Content Post</label>
									    <textarea name="post_content" class="form-control" rows="3" id="post_content"></textarea>
									  </div>
									</div>
									<div class="col-md-3">
										<div class="input-group">
										    <span class="input-group-btn">
										      <a id="lfm" data-input="post_thumbnail" data-preview="holder" class="btn btn-primary">
										       	<i class="fa fa-picture-o"></i> Choose
										      </a>
										    </span>
										    <input id="post_thumbnail" class="form-control" type="text" name="post_thumbnail">
										</div>
										 	<img id="holder" style="margin-top:15px;margin-bottom:15px;max-height:100px;">
										 	<div class="input-group">
										 		<input type="submit" value="Submit" class="btn btn-primary">
											</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

@endsection


@section('js_footer')	
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>


<script>
  ClassicEditor
  .create( document.querySelector( '#post_content' ) )
  .then( editor => {
          console.log( editor );
  })
  .catch( error => {
          console.error( error );
  });

  $(document).ready(function(){
  	$('#lfm').filemanager('image');
  });
</script>
@endsection