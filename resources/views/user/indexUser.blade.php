@extends('contentWithSidebars')

{{-- title stranky --}}
@section('title', $title)

{{-- kategorie clankov --}}
@section('categories')
	@include('partials/_categories')
@endsection

{{-- breadcrumbs --}}
@section('breadcrumbs')
	{!! Breadcrumbs::render('blogers') !!}
@endsection

@section('pageTitle', $title)

@section('content')

	{{-- sortovanie blogerov podla kriterii --}}
	{!! Form::open(['url' => url('sort-blogers'), 'method' => 'post']) !!}

		<h3><b>Zoradit podla</b></h3>
		{{-- select box --}}
		<div class="col-lg-4">
		<div class="form-group">
			{!! Form::select('sort', [
					'read' => 'priemernej čítanosti',
			   		'like' => 'karmy',
			   		'registration' => 'dátumu registrácie'], 'read', ['class' => 'form-control']
			) !!}
		</div>
		</div>

		{{-- submit button --}}
        <div class="form-group">
            {!! Form::button('Zoradiť', [
                'type' => 'submit',
                'class' => 'btn btn-primary'
            ]) !!}
        </div>

	{!! Form::close() !!}
	
	@foreach($users as $user)

		<div class="col-lg-7 col-md-7">
			<!-- Media middle -->
			<div class="media">
				<div class="media-left media-bottom">
			    	{{-- profilova fotka --}}
					<a href="{{ url('user', $user->id) }}">
						<img src=" {{asset('uploads/profile_photos/'. $user->profile_photo)}}" class="media-object" style="width: 120px; height: 140px; border: 1px solid grey;">
					</a>
				</div>
				<div class="media-body">
			    	<h4 class="media-heading"><a href="{{ url('user', $user->id) }}">{{ $user->name }}</a></h4>
			    	<div class="col-lg-4">

						<div class="well">
							<span class="profile-statistics">
								Počet článkov
							</span><br>
							<b>	{{ $user->num_of_articles }} </b>
						</div>
					
					</div>

					<div class="col-lg-4 profile-boxes">

						<div class="well">
							<span class="profile-statistics">
								Priemerná čítateľnosť
							</span><br>
							<b>	{{ $user->avg_readability }} </b>
						</div>
					
					</div>

					<div class="col-lg-4 profile-boxes">

						<div class="well">
							<span class="profile-statistics">
								Priemerná diskutovanosť
							</span><br>
							<b>	10 </b>
						</div>
					
					</div>
				</div>
			</div>
			<hr>
		</div>

	@endforeach

@endsection

@section('sidebars')

	@include('partials/sideBars/_mostViewed')

@endsection