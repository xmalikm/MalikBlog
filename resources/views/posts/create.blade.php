@extends('contentWithoutSidebars')

@section('stylesheets')

    <link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
	<link rel="stylesheet" href="{{ asset('css/selectize-css/normalize.css') }}">
	<link rel="stylesheet" href="{{ asset('css/selectize-css/selectize.default.css') }}">

@endsection

@section('breadcrumbs')
	{!! Breadcrumbs::render('createPost') !!}
@endsection

@section('pageTitle', 'Nový článok')

@section('content')
 	@if(count($errors) >0)
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
            	<li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

	{!! Form::open(['url' => url('post'), 'method' => 'post', 'enctype' => 'multipart/form-data', 'data-parsley-validate' => '']) !!}
		@include('partials.blogForm')
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
	<script>
		$('#input-tags').selectize({
			persist: false,
			createOnBlur: true,
			create: true
		});
	</script>
@endsection