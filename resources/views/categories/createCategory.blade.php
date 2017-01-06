@extends('contentWithSidebars')

{{-- title stranky --}}
@section('title', $title)

{{-- breadcrumbs --}}
@section('breadcrumbs')
	{!! Breadcrumbs::render('categories') !!}
@endsection

@section('pageTitle', 'Nova kategoria')

@section('content')
	{!! Form::open(['url' => url('category'), 'method' => 'post', 'data-parsley-validate' => '']) !!}
		
		{{-- vytvorenie novej kategorie --}}
		<div class="form-group">
			{!! Form::label('text', 'Vytvor novu kategoriu') !!}
			{!! Form::text('name', null, [
				'class' => 'form-control',
				'placeholder' => 'Nova kategoria'
			]) !!}
			{!! Form::button('Vytvor kategoriu', [
					'type' => 'submit',
					'class' => 'btn btn-primary'
			]) !!}
		</div>{{-- vytvorenie novej kategorie --}}

	{!! Form::close() !!}

@endsection

@section('sidebars')

	@include('partials/sideBars/_mostViewed')

@endsection