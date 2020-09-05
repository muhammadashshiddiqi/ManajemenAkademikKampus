@extends('layout.frontend')

@section('frontend_content')
	<!-- start banner Area -->
			<section class="banner-area relative" id="home" style="background: #cccccc;">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								Pendaftaran			
							</h1>	
							<p class="text-white link-nav"><a href="{{ route('home') }}">Home </a>  <span class="lnr lnr-arrow-right"></span><a href="{{ route('register') }}">Pendaftaran</a></p>
						</div>	
					</div>
				</div>
			</section>
	<!-- End banner Area -->					  
	
	<!-- Start search-course Area -->
	<section class="search-course-area relative" style="background: #cccccc;">
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row justify-content-between align-items-center">
				<div class="col-lg-6 col-md-6 search-course-left">
					<h1 class="text-white">
						Ayo Buruan Daftarkan !<br>
						Gratis Untuk Dhuafa & Yatim
					</h1>
					<p>
						inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards especially in the workplace. That’s why it’s crucial that, as women, our behavior on the job is beyond reproach.
					</p>
					<div class="row details-content">
						<div class="col single-detials">
							<span class="lnr lnr-graduation-hat"></span>
							<a href="#"><h4>Expert Instructors</h4></a>		
							<p>
								Usage of the Internet is becoming more common due to rapid advancement of technology and power.
							</p>						
						</div>
						<div class="col single-detials">
							<span class="lnr lnr-license"></span>
							<a href="#"><h4>Certification BAN PT</h4></a>		
							<p>
								Usage of the Internet is becoming more common due to rapid advancement of technology and power.
							</p>						
						</div>								
					</div>
				</div>
				<div class="col-lg-4 col-md-6 search-course-right section-gap">
						{{ Form::open(['route' => 'daftar', 'method' => 'post', 'class' => 'form-wrap']) }}

						<h4 class="text-white pb-20 text-center mb-30">Daftarkan Sekarang</h4>
						{{ Form::text('mhs_code', $rn_mahasiswa, ['class' => 'form-control', 'placeholder' => 'Mahasiswa ID', 'readonly' => 'readonly']) }}
						{{ Form::text('mhs_nama', '', ['class' => 'form-control', 'placeholder' => 'Nama Lengkap']) }}
						{{ Form::email('mhs_email', '', ['class' => 'form-control', 'placeholder' => 'Alamat Email']) }}
						{{ Form::text('mhs_hp', '', ['class' => 'form-control', 'placeholder' => 'No Handphone']) }}
						<div class="form-select" id="service-select">
							{{ Form::select('mhs_kelamin',[
								    '' => 'Jenis Kelamin',
								    'L' => 'Laki-Laki',
								    'P' => 'Perempuan',
								 ]) }}
						</div>							
						<input type="submit" class="primary-btn text-uppercase" value="Submit" style="text-align: center;">
						
						{{ Form::close() }}		
				</div>
			</div>
		</div>	
	</section>
	<!-- End search-course Area -->
	

@endsection