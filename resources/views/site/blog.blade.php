@extends('layout.frontend')

@section('frontend_content')
	<!-- start banner Area -->
			<section class="banner-area relative" id="home" style="background: #cccccc;">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								Blog			
							</h1>	
							<p class="text-white link-nav"><a href="{{ route('home') }}">Home </a>  <span class="lnr lnr-arrow-right"></span><a href="{{ route('blog') }}">Blog</a></p>
						</div>	
					</div>
				</div>
			</section>
	<!-- End banner Area -->	
	

	<!-- Start popular-course Area -->
			<section class="popular-course-area section-gap">
				<div class="container">
											
					<div class="row">
						<div class="active-popular-carusel">
							@foreach($post_all as $post)
							<div class="single-popular-carusel">
								<div class="thumb-wrap relative">
									<div class="thumb relative">
										<div class="overlay overlay-bg"></div>	
										<img class="img-fluid" src="{{ $post->thumbnail() }}" alt="">
									</div>
									<div class="meta d-flex justify-content-between">
										<p><span class="lnr lnr-calendar-full"></span> {{ $post->created_at->diffForHumans() }}</p>
									</div>									
								</div>
								<div class="details">
									<a href="{{route('site.singlepost', $post->post_slug) }}">
										<h4>
											{{ $post->post_title }}
										</h4>
									</a>
									<p>
										{{ $post->post_content }}								
									</p>
								</div>
							</div>
							@endforeach							
						</div>
					</div>
				</div>	
			</section>
			<!-- End popular-course Area -->
@endsection