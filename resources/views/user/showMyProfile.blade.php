@extends('contentWithoutSidebars')

{{-- title stranky --}}
@section('title', $title)

@section('breadcrumbs')
	{!! Breadcrumbs::render('showMyProfile') !!}
@endsection

@section('pageTitle', 'Profil: ' . $user->name)

@section('content')

	{{-- avatar + informacie --}}
	<div class="row">
		<div class="col-md-12">

			{{ Form::open(['url' => url('profile'), 'method' => 'delete']) }}

				 {{ Form::submit('Vymazat profil', ['class' => 'btn btn-danger']) }}

			{{ Form::close()}}

			{{-- profilova fotka --}}
			<img src=" {{asset('uploads/profile_photos/'. $user->profile_photo)}}" style="width: 200px; height: 250px; border: 1px solid grey;">
			<h2>{{ $user->name }}</h2>
			<h3>{{ $user->email }}</h3>
			<h3><b>O autorovi</b></h3>
			{{ $user->about }}
			<br>
			<a href=" {{ url('profile/edit') }} " class="btn btn-primary">Zmena udajov</a>
			<a href="edit hesla" class="btn btn-primary">Zmena hesla</a>

		</div>
	</div>{{-- avatar + informacie --}}

	<div class="row">
		<div class="col-md-4">
			<div class="well">
				<span class="profile-statistics">
					Počet článkov
				</span><br>
				<b>	{{ $user->num_of_articles }} </b>
			</div>
		</div>
		<div class="col-md-4">
			<div class="well">
				<span class="profile-statistics">
					Priemerná čitateľnosť
				</span><br>
				<b>	{{ $user->avg_readability }} </b>
			</div>
		</div>
		<div class="col-md-4">
			<div class="well">
				<span class="profile-statistics">
					Priemerná diskutovanosť
				</span><br>
				<b>	ND </b>
			</div>
		</div>
	</div>

	{{-- clanky usera --}}
	<div class="row">
		
	</div>{{-- clanky usera --}}

@endsection