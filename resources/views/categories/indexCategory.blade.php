@extends('contentWithSidebars')

{{-- title stranky --}}
@section('title', $title)

{{-- breadcrumbs --}}
@section('breadcrumbs')
	{!! Breadcrumbs::render('categories') !!}
@endsection

@section('pageTitle', 'Kategórie článkov')

@section('content')

	@foreach($categories as $category)

		<p><b>{{ $category->name }}</b></p>
		<p>{!! $category->posts !!}</p>


	@endforeach

@endsection

@section('sidebars')

	@include('partials/sideBars/_mostViewed')

@endsection