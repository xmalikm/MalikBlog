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

@section('pageTitle')
<h2 class="title title-marker">{!! $title !!}</h2>
@endsection

@section('content')

	{{-- sortovanie blogerov podla kriterii --}}
	{!! Form::open(['url' => url('sort-blogers'), 'method' => 'post', 'id' => 'sort-users']) !!}

		<h3><b>Zoradit podla</b></h3>
		{{-- select box --}}
		<div class="form-group">
			<div class="col-lg-4">
				{!! Form::select('sortBy', [
						'unique_views' => 'priemernej čítanosti',
				   		'popularity' => 'karmy',
				   		'created_at' => 'dátumu registrácie'], 'read', [
				   		'class' => 'form-control',
				   		'id' => 'sort-by'
				   		]
				) !!}
			</div>
			<div class="col-lg-4">
				{!! Form::select('sortFrom', [
						'desc' => 'od najväčšieho',
			   			'asc' => 'od najmenšieho'], 'desc', [
			   			'class' => 'form-control',
			   			'id' => 'sort-from'
			   			]
				) !!}
			</div>
		</div>

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
								<div class="user-sample-wrapper clear-content">
									<div class="col-sm-4">
										<div class="post-thumbnail">
											{{-- profilova fotka --}}
											<a href="{{ url('user', $user->id) }}">
												<img src=" {{asset('uploads/profile_photos/'. $user->profile_photo)}}" class="img-responsive">
											</a>
										</div>
									</div>
									<div class="col-sm-8">
										<div class="post-content">
												{{-- meno autora --}}
												<h4 class="title">
													<a href="{{ url('user', $user->id) }}">{{ $user->name }}</a>
												</h4>
												{{-- statistiky uzivatela --}}
												<div class="row">
													{{-- pocet clankov --}}
													<div class="col-lg-4 user-info-box">
														<div class="well">
															<span class="user-stats">
																Počet článkov
															</span><br>
															<b>	{{ $user->numOfArticles }} </b>
														</div>
													</div>
													{{-- priemerna citanost clankov --}}
													<div class="col-lg-4 user-info-box">
														<div class="well">
															<span class="user-stats">
																Priemerná čítateľnosť
															</span><br>
															<b>	{{ $user->avgReadability }} </b>
														</div>
													</div>
													{{-- priemerna popularita clankov --}}
													<div class="col-lg-4 user-info-box">
														<div class="well">
															<span class="user-stats">
																Priemerna popularita
															</span><br>
															<b>	{{ $user->avgPopularity }} </b>
														</div>
													</div>
												</div>
										</div>
									</div>
								</div>
							</li>

				@endforeach
			</ul>{{-- zoznam uzivatelov --}}
		</div>
	</div>{{-- row --}}

@endsection

@section('sidebars')

	@include('partials/sideBars/_mostViewed')

@endsection

@section('scripts')

	<script src=" {{ asset('js/blog-js/user.js') }} "></script>

@endsection