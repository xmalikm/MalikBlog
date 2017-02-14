@extends('contentWithoutSidebars')

{{-- title stranky --}}
@section('title', $title)

@section('breadcrumbs')
	{!! Breadcrumbs::render('showMyProfile') !!}
@endsection

@section('pageTitle')
	{{-- nadpis --}}
	<div class="row">
		<div class="col-lg-12 col-md-12 text-center post-title">
			<h1><a href=""> Profil: {{ $user->name }} </a></h1>
		</div>
	</div>{{-- nadpis --}}

@endsection

@section('content')

	{{-- buttony na editaciu profilu uzivatela --}}
	<div class="row">
		<div class="col-md-10 col-md-offset-1 profile-buttons">
			{{ Form::open(['url' => url('profile'), 'method' => 'delete', 'id' => 'delete_profile']) }}

				 {{ Form::submit('Vymazat profil', ['class' => 'btn btn-danger']) }}

			{{ Form::close()}}

			<a href=" {{ url('profile/edit') }} " class="btn btn-primary">Zmena udajov</a>
			<a href="edit hesla" class="btn btn-primary">Zmena hesla</a>
		</div>
	</div>

	{{-- avatar + informacie --}}
	<div class="row">
		<div class="col-md-10 col-md-offset-1 profile-info-wrapper">
			<div class="row">
				{{-- wrapper pre profilovu fotku --}}
				<div class="col-sm-4">
					{{-- profilova fotka --}}
					<img id="profile_photo" class="img-responsive" src="{{asset('uploads/profile_photos/'. $user->profile_photo)}}" >
				</div>{{-- wrapper pre profilovu fotku --}}

				{{-- wrapper pre info o uzivatelovi --}}
				<div class="col-sm-8 profile-bio-wrapper">
					<h2 id="user_name">{{ $user->name }}</h2>
					<p id="user_email"><strong>E-mail:</strong> {{ $user->email }} </p>
					<p><strong>O autorovi:</strong> {{ $user->about }} </p>
				</div>{{-- wrapper pre info o uzivatelovi --}}
			</div>

		</div>
	</div>{{-- avatar + informacie --}}
	
	{{-- statistiky uzivatela --}}
	<div class="row">
		<div class="col-md-10 col-md-offset-1 text-center">
			<h2>Štatistiky</h2>
		</div>
		<div class="col-md-10 col-md-offset-1 divider text-center">
			{{-- pocet clankov --}}
	        <div class="col-xs-12 col-sm-3 emphasis">
	            <h2><strong> {{ $user->num_of_articles }} </strong></h2>
	            <p><small>Počet článkov</small></p>
	        </div>{{-- pocet clankov --}}

	        {{-- priemerna ciatanost --}}
	        <div class="col-xs-12 col-sm-3 emphasis">
	            <h2><strong> {{ $user->avg_readability }} </strong></h2>
	            <p><small>Priemerná čitanosť</small></p>
	        </div>{{-- priemerna ciatanost --}}

	        {{-- priemerna diskutovanost --}}
	        <div class="col-xs-12 col-sm-3 emphasis">
	            <h2><strong> {{ $user->avg_comments }} </strong></h2>
	            <p><small>Priemerná diskutovanosť</small></p>
	        </div>{{-- priemerna diskutovanost --}}

	        {{-- priemerna popularita --}}
	        <div class="col-xs-12 col-sm-3 emphasis">
	            <h2><strong> {{ $user->avg_popularity }} </strong></h2>
	            <p><small>Priemerná popularita</small></p>
	        </div>{{-- priemerna popularita --}}
	    </div>
	</div>

@endsection