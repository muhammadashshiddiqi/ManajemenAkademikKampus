@extends('layout.master')

@section('content_main')
<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-headline">

						@foreach($frm as $abc)
						<div class="panel-heading">
							<h3 class="panel-title">{{ $abc->forum_judul }}</h3>
							<p class="panel-subtitle">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($abc->forum_created_at))->diffForHumans() }}</p>
						</div>
						<div class="panel-body">
							{{ $abc->forum_konten }}
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
</div>
	
@endsection