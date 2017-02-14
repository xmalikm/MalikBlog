@if($post->tags)

	<h3>Tagy</h3>
	<p class="tags">
		
		@foreach($post->tags as $tag)

			<a href=" {{ url('tag', $tag->id) }} " class="btn btn-danger">
				<img src="{{asset('images/icons/tags.png')}}" style="width: 15px; height: 15px; display: inline-block;"> {{ $tag->name }}
			</a>

		@endforeach

	</p>

@endif