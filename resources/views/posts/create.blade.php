@extends('contentWithoutSidebars')

@section('stylesheets')

    <link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
	<link rel="stylesheet" href="{{ asset('css/selectize-css/normalize.css') }}">
	<link rel="stylesheet" href="{{ asset('css/selectize-css/selectize.default.css') }}">

@endsection

@section('breadcrumbs')
	{!! Breadcrumbs::render('createPost') !!}
@endsection

@section('pageTitle')
	{{-- nadpis --}}
	<div class="row">
		<div class="col-lg-12 col-md-12 text-center post-title">
			<h1 class="title-marker"><a href=""> Nový clánok </a></h1>
		</div>
	</div>{{-- nadpis --}}
@endsection

@section('content')
 	@if(count($errors) >0)
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
            	<li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    {{-- bootstrap modal - obsahuje form pre vytvorenie novej kategorie
		 musi byt umiestneny mimo formularu, pretoze sam obsahuje druhy formular --}}
  	@include('partials/_newCatModal')

	{!! Form::open(['url' => url('post'), 'method' => 'post', 'enctype' => 'multipart/form-data', 'data-parsley-validate' => '']) !!}
		{{-- spolocny form --}}
		{{-- @include('partials.blogForm') --}}

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

		{{-- button pre otvorenie vyssie uvedeneho modalu pre novu kategoriu --}}
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
		</div>
		{{-- obrazok blogu --}}

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

@section('sidebars')

	{{-- najcitanejsie blogy --}}
	<div class="panel panel-info panel-table">

		<div class="panel-heading panel-table-heading">

	    	Autor clanku

	    </div>

	    <div class="panel-body">
	      					
			Info o autorovi

	    </div>{{-- panel body --}}

	</div>{{-- najcitanejsie blogy --}}

@endsection

@section('scripts')
	
	<script src=" {{ asset('js/selectize-js/selectize.js') }} "></script>
	<script src=" {{ asset('js/parsley.min.js') }} "></script>
	<script src=" {{ asset('js/blog-js/create-edit.js') }} "></script>
@endsection