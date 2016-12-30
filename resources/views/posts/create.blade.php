@extends('contentSidebar')

@section('stylesheets')



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

	

@endsection