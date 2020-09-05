<div id="sidebar-nav" class="sidebar">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
				
				<li><a href="{{ route('dashboard') }}" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
				<li><a href="{{ route('forum') }}" class="active"><i class="lnr lnr-user"></i> <span>Forum</span></a></li>
				@if(auth()->user()->role == 'admin')
				<li><a href="{{ route('mahasiswa') }}" class=""><i class="lnr lnr-code"></i> <span>Mahasiswa</span></a></li>
				<li><a href="{{ route('post') }}" class=""><i class="lnr lnr-pencil"></i> <span>Post</span></a></li>
				<li>
					<a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Report</span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
					<div id="subPages" class="collapse ">
						<ul class="nav">
							<li><a href="page-profile.html" class="">Mahasiswa</a></li>
							<li><a href="page-login.html" class="">Mata Kuliah</a></li>
							<li><a href="page-lockscreen.html" class="">Penilaian</a></li>
						</ul>
					</div>
				</li>
				@endif
			</ul>
		</nav>
	</div>
</div>