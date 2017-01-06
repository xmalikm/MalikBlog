@extends('contentWithoutSidebars')

@section('title', $title)

@section('stylesheets')

    <link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
	<link rel="stylesheet" href="{{ asset('css/selectize-css/normalize.css') }}">
	<link rel="stylesheet" href="{{ asset('css/selectize-css/selectize.default.css') }}">

@endsection

@section('breadcrumbs')
	{!! Breadcrumbs::render('editPost', $post) !!}
@endsection

@section('pageTitle', 'Úprava článku')

@section('content')
 	@if(count($errors) >0)
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
            	<li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

	{!! Form::model($post, ['url' => url('post', $post->id), 'method' => 'put', 'enctype' => 'multipart/form-data', 'data-parsley-validate' => '']) !!}
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

         function getMessage(){
            $.ajax({
               	type:'POST',
               	url:'/session',
                headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
               	data: {
            		session:'{{$post->id}}',
               	},
               success:function(data){
                  
               }
            });
         }
	</script>
@endsection