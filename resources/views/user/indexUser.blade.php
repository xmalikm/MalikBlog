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
	{!! Form::open(['url' => url('sort-blogers'), 'method' => 'post', 'id' => 'sortBloggers']) !!}

		<h3 onclick="ahoj()"><b>Zoradit podla</b></h3>
		{{-- select box --}}
		<div class="form-group">
			<div class="col-lg-4">
				{!! Form::select('sortBy', [
						'unique_views' => 'priemernej čítanosti',
				   		'popularity' => 'karmy',
				   		'created_at' => 'dátumu registrácie'], 'read', ['class' => 'form-control', 'id' => 'sortBy']
				) !!}
			</div>
			<div class="col-lg-4">
				{!! Form::select('sortFrom', [
						'desc' => 'od najväčšieho',
			   			'asc' => 'od najmenšieho',
			   		], 'desc', ['class' => 'form-control', 'id' => 'sortFrom']
				) !!}
			</div>
		</div>

		{{ Form::hidden('sortByMsg', null, ['id' => 'sortByMsg']) }}
		{{ Form::hidden('sortFromMsg', null, ['id' => 'sortFromMsg']) }}

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
							<b>	{{ $user->numOfArticles }} </b>
						</div>
					
					</div>

					<div class="col-lg-4 profile-boxes">

						<div class="well">
							<span class="profile-statistics">
								Priemerná čítateľnosť
							</span><br>
							<b>	{{ $user->avgReadability }} </b>
						</div>
					
					</div>

					<div class="col-lg-4 profile-boxes">

						<div class="well">
							<span class="profile-statistics">
								Priemerna popularita
							</span><br>
							<b>	{{ $user->avgPopularity }} </b>
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

@section('scripts')

	<script>
		$('#sortBloggers').on('submit', function(){
			// vybrate kriteria z formularu, podla ktorych sa bude sortovat
			var $sortBy = $('#sortBy :selected').text();
			var $sortFrom = $('#sortFrom :selected').text();

			// dva skryte inputy vo formulari naplnime tymito hodnotami
			// ulahci nam to vypis podla coho zoradujeme blogerov
			$('#sortByMsg').val($sortBy);
			$('#sortFromMsg').val($sortFrom);
		});
	</script>

@endsection