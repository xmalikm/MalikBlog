@if($post->tags)

	<h3>Tagy</h3>
	<p class="tags">
		
		@foreach($post->tags as $tag)

			<a href=" {{ url('tag', $tag->id) }} " class="btn btn-danger">
				{{ $tag->name }}
			</a>

		@endforeach

	</p>

@endif