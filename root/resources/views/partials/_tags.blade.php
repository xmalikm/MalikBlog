{{-- Zoznam tagov clankov --}}

{{-- nadpis sekcie --}}
<h3 class="title">
	Tagy <img class="sidebar-icon" src="{{asset('images/icons/tags.png')}}">
</h3>

{{-- vypis tagov --}}
<p class="tags">
	@forelse($post->tags as $tag)

		{{-- nazov tagu --}}
		<a href=" {{ url('tag', $tag->id) }} " class="btn btn-danger">
			{{ $tag->name }}
		</a>

	{{-- ak clanok neobsahuje ziadne tagy --}}
	@empty
		<p><strong>Článok neobsahuje žiadne tagy</strong></p>

	@endforelse
</p>{{-- vypis tagov --}}