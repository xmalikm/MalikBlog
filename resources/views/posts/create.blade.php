@extends('contentSidebar')

@section('stylesheets')

	<link rel="stylesheet" href="{{ asset('css/selectize-css/normalize.css') }}">

@endsection

@section('content')

	{!! Form::open(['url' => url('post'), 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
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
	
	<script src=" {{ asset('js/selectize-js/index.js') }}"></script>
	<script src=" {{ asset('js/selectize-js/selectize.js') }}"></script>
	<script>
		$('#input-tags').selectize({
			persist: false,
			createOnBlur: true,
			create: true
		});
	</script>
@endsection