@if(Session::has('newCatMessage'))
	<div class="alert alert-success alert-dismissable fade in">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong> {{Session::get('newCatMessage')}} </strong>
 	</div>
 @endif

{{-- kategoria blogu --}}
<div class="form-group">
	{!! Form::label('text', 'Kategória') !!}
	{{-- ak editujem blog -> zobraz kategoriu blogu, ak vytvaram novy blog -> zobraz defaultnu kategoriu --}}
	{{ Form::select('category_id', $categories, isset($post->category_id) ? $post->category_id : 0, ['class' => 'form-control']) }}
	@if(Route::currentRouteName() == 'post.edit')
		<a href="{{ Route('category.create') }}?post={{$post->id}}" class="btn btn-primary" id = "new-category" >Alebo vytvor novu kategoriu</a>
	@else
		<a href="{{ Route('category.create') }}" class="btn btn-primary" id = "new-category" >Alebo vytvor novu kategoriu</a>
	@endif
</div>{{-- kategoria blogu --}}

{{-- nazov blogu --}}
<div class="form-group">
	{!! Form::label('text', 'Nadpis') !!}
	{!! Form::text('title', null, [
		'class' => 'form-control',
		'placeholder' => 'Nadpis článku',
		'required' => '',
		'maxlength' => 255
	]) !!}
</div>{{-- nazov blogu --}}

{{-- obsah clanku --}}
<div class="form-group">
	{!! Form::label('text', 'Obsah') !!}
	{!! Form::textarea('text', null, [
		'class' => 'form-control',
		'placeholder' => 'Obsah článku',
		'rows' => 16,
		'required' => ''
	]) !!}
</div>{{-- obsah clanku --}}

{{-- obrazok blogu --}}
<div class="form-group">
	{!! Form::label('text', 'Obrázok') !!}
	<br>
	{{-- ak prave editujem clanok, zobraz mi akrualnu fotku k clanku --}}
	@if(Route::currentRouteName() === 'post.edit')
		{{-- aktualny obrazok clanku --}}
		<img src=" {{asset('uploads/blog_photos/'. $post->blog_photo)}}" style="width: 200px; height: 250px; border: 1px solid grey;">
	@endif
		{{ Form::file('blog_photo') }}
	{{-- {{ Form::close() }} --}}
</div>
{{-- obrazok blogu --}}

{{-- tagy blogu --}}
<div class="form-group">
	{!! Form::label('text', 'Tagy') !!}
	{!! Form::text('tags', isset($tags) ? $tags : null, [
		'placeholder' => 'Zadaj slová alebo výrazy',
		'id' => 'input-tags',
	]) !!}
</div>{{-- tagy blogu --}}

{{-- subbmit button --}}
<div class="form-group">
	@if(Route::currentRouteName() === 'post.create')
		{!! Form::button('Vytvor článok', [
			'type' => 'submit',
			'class' => 'btn btn-primary'
		]) !!}
	@else 
		{!! Form::button('Uprav článok', [
			'type' => 'submit',
			'class' => 'btn btn-primary'
		]) !!}
	@endif
</div>{{-- subbmit button --}}

{{-- button naspat --}}
<span>
	<a href="{{ URL::previous() }}">Naspäť</a>
</span>{{-- button naspat --}}