@extends('contentSidebar')

{{-- title stranky --}}
@section('title', $title)

{{-- buttony na zoradovanie clankov --}}
@section('sortingButtons')

	{{-- prvy row: kategorie + pravy sidebar --}}
	@include('partials/_blogCategories')

@endsection


@section('content')

	{{-- avatar + informacie --}}
	<div class="row">
		<div class="col-md-12">

			{{-- profilova fotka --}}
			<img src=" {{asset('uploads/profile_photos/'. $user->profile_photo)}}" style="width: 200px; height: 250px; border: 1px solid grey;">
			<h2>{{ $user->name }}</h2>
			<h3>{{ $user->email }}</h3>
			<h3><b>O autorovi</b>{{ $user->about }}</h3>

			{{ Form::open(['url' => 'profile', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}

				{{ Form::file('profile_photo') }}
				{{ Form::submit('uloz', ['class' => 'btn btn-primary']) }}

			{{ Form::close() }}

			<a href="edit udajov" class="btn btn-primary">Zmena udajov</a>
			<a href="edit hesla" class="btn btn-primary">Zmena hesla</a>

		</div>
	</div>{{-- avatar + informacie --}}	

	<div class="row">
		<div class="col-md-4">
			<div class="well">
				<span class="profile-statistics">
					Pocet clankov
				</span><br>
				<b>	10 </b>
			</div>
		</div>
		<div class="col-md-4">
			<div class="well">
				<span class="profile-statistics">
					Priemerna citatelnost
				</span><br>
				<b>	10 </b>
			</div>
		</div>
		<div class="col-md-4">
			<div class="well">
				<span class="profile-statistics">
					Priemerna diskutovanost
				</span><br>
				<b>	10 </b>
			</div>
		</div>
	</div>

@endsection

@section('sidebars')

	{{-- mozno nejaky iny sidebar --}}

	{{-- <button class="btn btn-info btn-block">Pridaj medzi oblubenych</button><br>
	@include('partials/sidebars/_profileInfo') --}}

@endsection