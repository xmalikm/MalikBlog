{{-- Formular na vytvorenie noveho clanku --}}

@extends('contentWithoutSidebars')

{{-- css subory --}}
@section('stylesheets')

	{{-- js validacia formularov --}}
    <link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
    {{-- kniznica na upravu inputov --}}
	<link rel="stylesheet" href="{{ asset('selectize/css/selectize.default.css') }}">

@endsection

{{-- breadcrumbs --}}
@section('breadcrumbs')
	{!! Breadcrumbs::render('createPost') !!}
@endsection


{{-- nadpis stranky --}}
@section('pageTitle')
	<div class="row">
		<div class="col-lg-12 col-md-12 text-center post-title">
			<h1 class="title-marker"><a href=""> Nový clánok </a></h1>
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
	{!! Form::open(['url' => url('post'), 'method' => 'post', 'enctype' => 'multipart/form-data', 'data-parsley-validate' => '']) !!}

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
			{{ Form::select('category_id', $catsArray, Session::has('newCat') ? Session::get('newCat') : 0, ['class' => 'form-control']) }}
		</div>{{-- kategoria blogu --}}

		{{-- button - otvara modal dialog pre vytvorenie novej kategorie --}}
		{{-- modal dialog je umiestneny v "master.blade.php" subor - inak dobre nefunguje --}}
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Alebo vytvor novu kategoriu</button>

		{{-- nazov blogu --}}
		<div class="form-group">
			{!! Form::label('text', 'Nadpis') !!}
			{!! Form::text('title', 'nadpis', [
				'class' => 'form-control',
				'placeholder' => 'Nadpis článku',
				'required' => '',
				'maxlength' => 255
			]) !!}
		</div>{{-- nazov blogu --}}

		{{-- obsah clanku --}}
		<div class="form-group">
			{!! Form::label('text', 'Obsah') !!}
			{!! Form::textarea('text', 'no ahoj moj', [
				'class' => 'form-control',
				'placeholder' => 'Obsah článku',
				'rows' => 16,
				'required' => ''
			]) !!}
		</div>{{-- obsah clanku --}}

		{{-- obrazok blogu --}}
		<div class="form-group">
			{!! Form::label('text', 'Obrázok') !!}
			{{ Form::file('blog_photo') }}
		</div>{{-- obrazok blogu --}}

		{{-- tagy blogu --}}
		<div class="form-group">
			{!! Form::label('text', 'Tagy') !!}
			{!! Form::text('tags', null, [
				'placeholder' => 'Zadaj slová alebo výrazy',
				'id' => 'input-tags',
			]) !!}
		</div>{{-- tagy blogu --}}

		{{-- subbmit button --}}
		<div class="form-group">
			{!! Form::button('Vytvor článok', [
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