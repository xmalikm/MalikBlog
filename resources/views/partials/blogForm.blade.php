{{-- formular pre vytvaranie, resp. editaciu blogov --}}

{{-- nazov blogu --}}
<div class="form-group">
	{!! Form::label('text', 'Nadpis') !!}
	{!! Form::text('title', "Nadpis clanku", [
		'class' => 'form-control',
		'placeholder' => 'Nadpis článku'
	]) !!}
</div>{{-- nazov blogu --}}

{{-- obsah clanku --}}
<div class="form-group">
	{!! Form::label('text', 'Obsah') !!}
	{!! Form::textarea('text', "Ahoj ako sa mas", [
		'class' => 'form-control',
		'placeholder' => 'Obsah článku',
		'rows' => 16
	]) !!}
</div>{{-- obsah clanku --}}

{{-- kategoria blogu --}}
<div class="form-group">
	{!! Form::label('text', 'Kategória') !!}
	{{ Form::select('category', [
		"Politika" => "Politika", "Šport" => "Šport", "Ekonomika" => "Ekonomika",
		"Automoto" => "Automoto", "Cestovanie" => "Cestovanie", "Jedlo" => "Jedlo",
		"Veda a technika" => "Veda a technika", "Zábava" => "Zábava",
		"Zaujimavosti" => "Zaujimavosti", "Lifestyle" => "Lifestyle", "Kultúra" => "Kultúra",
		"Nezaradené" => "Nezaradené"
	],"politics", ['class' => 'form-control']) }}
</div>{{-- kategoria blogu --}}

{{-- obrazok blogu --}}
<div class="form-group">
	{!! Form::label('text', 'Obrázok') !!}
	{{-- {{ Form::open(['url' => 'profile', 'method' => 'post', 'enctype' => 'multipart/form-data']) }} --}}
		{{ Form::file('blog_photo') }}
	{{-- {{ Form::close() }} --}}
</div>
{{-- obrazok blogu --}}

{{-- tagy blogu --}}
<div class="form-group">
	{!! Form::label('text', 'Tagy') !!}
	{!! Form::text('tags', "ako sa mas", [
		'placeholder' => 'Zadaj slová alebo výrazy',
		'id' => 'input-tags'
	]) !!}
</div>{{-- tagy blogu --}}

{{-- subbmit button --}}
<div class="form-group">
	{!! Form::button('Vytvoriť blog', [
		'type' => 'submit',
		'class' => 'btn btn-primary'
	]) !!}
</div>{{-- subbmit button --}}

{{-- button naspat --}}
<span>
	<a href="{{ URL::previous() }}">Naspäť</a>
</span>{{-- button naspat --}}