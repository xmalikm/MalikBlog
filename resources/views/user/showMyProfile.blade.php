@extends('contentSidebar')

{{-- title stranky --}}
@section('title', $title)

{{-- buttony na zoradovanie clankov --}}
@section('sortingButtons')

	{{-- prvy row: kategorie + pravy sidebar --}}
	@include('partials/_blogCategories')

@endsection


@section('content')

	{{-- profilova fotka --}}
	<img src="http://placehold.it/200x250" class="profile-photo">


	

@endsection

@section('sidebars')

	{{-- mozno nejaky iny sidebar --}}

	{{-- <button class="btn btn-info btn-block">Pridaj medzi oblubenych</button><br>
	@include('partials/sidebars/_profileInfo') --}}

@endsection