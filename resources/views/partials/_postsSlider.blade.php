{{-- Kontajner pre slider s clankami --}}
<div class="container-fluid post-slider-container">
	{{-- lava sipka na posuvanie --}}
	<div id='slide-left'>
		<img id="prev" src='{{ asset('images/prev.png') }}'/>
	</div> 

	{{-- sliders  clankami --}}
	<div class="slider">

		{{-- v cykle sa zobrazia clanky --}}
		@foreach($sliderPosts as $post)

			{{-- clanok v slidery --}}
			<div class="highlight-post">

				{{-- link - obrazok clanku --}}
				<a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}" class="highlight-post-image" style="background: url({{asset('uploads/blog_photos/'. $post->blog_photo)}}) no-repeat center center;">
					{{-- overlay vrstva, ktora sa zobrazi pri hovernuti obrazku --}}
					<span class="image-overlay"></span>
				</a>

				{{-- informacie k clanku --}}
				<div class="highlight-post-content">

				{{-- kategoria --}}
			    	<a href="{{ url('category', $post->category->id) }}" class="btn btn-primary btn-xs" title="Kategória článku">{{ $post->category->name }}</a>
			    	{{-- nadpis --}}
					<h3><a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}">{{ $post->title }}</a></h3>
					{{-- autor + datum --}}
					<small>
						{{-- meno autora --}}
						<span class="glyphicon glyphicon-user" title="Autor článku"></span>
						<a href="{{ url('user', $post->user->id) }}" title="Autor článku">{{ $post->user->name}}</a>
						{{-- datum vydania clanku --}}
						<span class="glyphicon glyphicon-time post-date" title="Vydanie článku"></span>
						<span title="Vydanie článku">{{ $post->created_at }}</span>
					</small>

				</div>{{-- informacie k clanku --}}

			</div>{{-- clanok v slidery --}}

		@endforeach

	</div>

	{{-- prava sipka na posuvanie --}}
	<div id='slide-right'>
		<img id="next" src='{{ asset('images/next.png') }}'/>
	</div> 
</div>