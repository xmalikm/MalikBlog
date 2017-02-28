{{-- header stranky --}}
<header>
	{{-- header kontajner --}}
	<div class="container-fluid container-header">
		<div class="row">
			{{-- social media ikony --}}
			<div class="col-md-4 social-media text-center">
				{{-- fb --}}
				<a href="https://www.facebook.com/martin.malik.14?ref=bookmarks" title="Martin Malík Facebook" target="_blank">
					<img src="{{ asset('images/icons/facebook-icon.png') }}" class = "icon">
				</a>
				{{-- g+ --}}
				<a href="https://plus.google.com/u/0/104749510764663008968" title="Martin Malík Google+" target="_blank">
					<img src="{{ asset('images/icons/google-icon.png') }}" class = "icon">
				</a>
			</div>{{-- social media ikony --}}

			{{-- logo --}}
			<div class="col-md-8 text-center logo">
				<a href="{{ url('/') }}"><img src="{{ asset('images/malikblog.png') }}" class="blog-logo"></a>
			</div>{{-- logo --}}
		</div>

	</div>{{-- header kontajner --}}
</header>