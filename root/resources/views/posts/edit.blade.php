{{-- Formular na editaciu clanku --}}

@extends('contentWithoutSidebars')

{{-- title stranky --}}
@section('title', $title)

{{-- css subory --}}
@section('stylesheets')
	
	{{-- js validacia formularov --}}
    <link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
    {{-- kniznica na upravu inputov --}}
	<link rel="stylesheet" href="{{ asset('selectize/css/selectize.default.css') }}">

@endsection

{{-- breadcrumbs --}}
@section('breadcrumbs')
	{!! Breadcrumbs::render('editPost', $post) !!}
@endsection

{{-- nadpis stranky --}}
@section('pageTitle')
	<div class="row">
		<div class="col-lg-12 col-md-12 text-center post-title">
			<h1><a href=""> Editovať clánok </a></h1>
		</div>
	</div>
@endsection

{{-- obsah stranky --}}
@section('content')

	{{-- vypis errorov, ak nejake su --}}
 	@if(count($errors) >0)
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
            	<li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

	{{-- formular --}}
	{!! Form::model($post, ['url' => url('post', $post->id), 'method' => 'put', 'id' => 'edit-post', 'enctype' => 'multipart/form-data', 'data-parsley-validate' => '']) !!}

		{{-- ak uzivatel vytvori novu kategoria, vypise sa success message --}}
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
			{{ Form::select('category_id', $catsArray, isset($post->category_id) ? $post->category_id : 0, ['class' => 'form-control']) }}
		</div>{{-- kategoria blogu --}}
  		
  		{{-- button - otvara modal dialog pre vytvorenie novej kategorie --}}
		{{-- modal dialog je umiestneny v "master.blade.php" subor - inak dobre nefunguje --}}
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Alebo vytvor novu kategoriu</button>

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
			<div class="col-lg-6 file-input-wrapper">
				{!! Form::label('text', 'Náhladový obrázok', ['class' => 'photo-label']) !!}
				{{-- aktualny obrazok clanku --}}
				<img class="photo" src=" {{asset('uploads/blog_photos/'. $post->blog_photo)}}">
				{{ Form::file('blog_photo') }}
			</div>
		</div>{{-- obrazok blogu --}}
		
		{{-- clearnutie za obrazkom --}}
		<div class="clear-content"></div>

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
			{!! Form::button('Uprav článok', [
				'type' => 'submit',
				'class' => 'btn btn-primary'
			]) !!}
		</div>{{-- subbmit button --}}

		{{-- button naspat --}}
		<span>
			<a href="{{ URL::previous() }}">Naspäť</a>
		</span>{{-- button naspat --}}

	{!! Form::close() !!}

@endsection


{{-- js subory --}}
@section('scripts')
	{{-- js valdacia formularov --}}
	<script src=" {{ asset('js/parsley.min.js') }} "></script>
	{{-- js stranky --}}
	<script src=" {{ asset('js/blog-js/create-edit.js') }} "></script>
@endsection