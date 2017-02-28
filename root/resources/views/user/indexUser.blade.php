{{-- Zoznam autorov --}}

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

{{-- nadpis stranky --}}
@section('pageTitle')
	<h2 class="title title-marker">{!! $title !!}</h2>
@endsection

{{-- obsah stranky --}}
@section('content')

	{{-- sortovanie autorov podla kriterii --}}
	{!! Form::open(['url' => url('sort-blogers'), 'method' => 'post', 'id' => 'sort-users']) !!}

		<h3>
			<strong>Zoradit podla</strong>
		</h3>

		{{-- kriteria zoradenia --}}
		<div class="form-group">
			{{-- podla coho sa zoradi --}}
			<div class="col-lg-4">
				{!! Form::select('sortBy', [
						'unique_views' => 'priemernej čítanosti',
				   		'popularity' => 'karmy',
				   		'created_at' => 'dátumu registrácie'], 'read', [
				   		'class' => 'form-control',
				   		'id' => 'sort-by'
				   		]
				) !!}
			</div>{{-- podla coho sa zoradi --}}

			{{-- akym sposobom sa zoradi --}}
			<div class="col-lg-4">
				{!! Form::select('sortFrom', [
						'desc' => 'od najväčšieho',
			   			'asc' => 'od najmenšieho'], 'desc', [
			   			'class' => 'form-control',
			   			'id' => 'sort-from'
			   			]
				) !!}
			</div>{{-- akym sposobom sa zoradi --}}
		</div>{{-- kriteria zoradenia --}}

		{{-- skryte inputy - potrebne na zobrazenie info spravy pre uzivatela, podla coho sa zoraduje --}}
		{{ Form::hidden('sortByMsg', null, ['id' => 'sort-by-msg']) }}
		{{ Form::hidden('sortFromMsg', null, ['id' => 'sort-from-msg']) }}

		{{-- submit button --}}
        <div class="form-group">
            {!! Form::button('Zoradiť', [
                'type' => 'submit',
                'class' => 'btn btn-primary',
                'id' => 'submit'
            ]) !!}
        </div>

	{!! Form::close() !!}
	
	<div class="row ">
		{{-- zoznam uzivatelov --}}
		<div class="users-list">
			<ul>
				@foreach($users as $user)

							<li>
								{{-- item wrapper --}}
								<div class="user-sample-wrapper clear-content">
									<div class="col-sm-4">
										{{-- profilova fotka --}}
										<div class="post-thumbnail">
											<a href="{{ url('user', $user->id) }}">
												<img src=" {{asset('uploads/profile_photos/'. $user->profile_photo)}}" class="img-responsive">
											</a>
										</div>
									</div>
									{{-- column --}}
									<div class="col-sm-8">
										{{-- post content --}}
										<div class="post-content">
											{{-- meno autora --}}
											<h4 class="title">
												<a href="{{ url('user', $user->id) }}">{{ $user->name }}</a>
											</h4>
											{{-- statistiky uzivatela --}}
											<div class="row">
												{{-- pocet clankov --}}
												<div class="col-lg-4 user-info-box">
													<div class="well text-center">
														<span class="user-stats">
															Počet článkov
														</span><br>
														<b>	{{ $user->numOfArticles }} </b>
													</div>
												</div>
												{{-- priemerna citanost clankov --}}
												<div class="col-lg-4 user-info-box">
													<div class="well text-center">
														<span class="user-stats">
															Priemerná čítateľnosť
														</span><br>
														<b>	{{ $user->avgReadability }} </b>
													</div>
												</div>
												{{-- priemerna popularita clankov --}}
												<div class="col-lg-4 user-info-box">
													<div class="well text-center">
														<span class="user-stats">
															Priemerna popularita
														</span><br>
														<b>	{{ $user->avgPopularity }} </b>
													</div>
												</div>
											</div>{{-- statistiky uzivatela --}}
										</div>{{-- post content --}}
									</div>{{-- column --}}
								</div>{{-- item wrapper --}}
							</li>

				@endforeach
			</ul>
		</div>{{-- zoznam uzivatelov --}}
	</div>{{-- row --}}

@endsection

{{-- sidebary na stranke --}}
@section('sidebars')
	{{-- najcitanejsie stranky --}}
	@include('partials/sideBars/_mostViewed')
@endsection

{{-- js subory --}}
@section('scripts')
	{{-- js stranky --}}
	<script src=" {{ asset('js/blog-js/user.js') }} "></script>
@endsection