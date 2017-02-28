{{-- Formular na editovanie uzivatelskeho profilu --}}

@extends('contentWithoutSidebars')

{{-- title stranky --}}
@section('title', $title)

{{-- breadcumbs --}}
@section('breadcrumbs')
	{!! Breadcrumbs::render('editMyProfile') !!}
@endsection

{{-- nadpis stranky --}}
@section('pageTitle')
	<div class="row">
		<div class="col-lg-12 col-md-12 text-center post-title">
			<h1 class="title-marker"><a href=""> Úprava profilu </a></h1>
		</div>
	</div>
@endsection

{{-- obsah stranky --}}
@section('content')

	{{-- zoznam errorov, ak nejake su --}}
	@if(count($errors) >0)
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
            	<li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

	{{-- form na upravu profilu --}}
	<div class="row">
		{{-- column --}}
		<div class="col-md-12">

			{!! Form::model($user, ['url' => url('profile'), 'method' => 'put', 'enctype' => 'multipart/form-data', 'data-parsley-validate' => '']) !!}
				
				{{-- meno uzivatela --}}
				<div class="form-group">
					{!! Form::label('text', 'Meno') !!}
					{!! Form::text('name', null, [
						'class' => 'form-control',
						'placeholder' => 'Meno',
						'required' => '',
						'maxlength' => 20
					]) !!}
				</div>{{-- meno uzivatela --}}

				{{-- email uzivatela --}}
				<div class="form-group">
					{!! Form::label('text', 'Email') !!}
					{!! Form::email('email', null, [
						'class' => 'form-control',
						'placeholder' => 'Email',
						'required' => ''
					]) !!}
				</div>{{-- email uzivatela --}}

				{{-- o sebe --}}
				<div class="form-group">
					{!! Form::label('text', 'O sebe') !!}
					{!! Form::textarea('about', null, [
						'class' => 'form-control',
						'placeholder' => 'O sebe',
						'row' => 4,
					]) !!}
				</div>{{-- o sebe --}}

				{{-- profilova foto uzivatela --}}
				<div class="form-group">
					<div class="col-lg-6 file-input-wrapper">
						{!! Form::label('text', 'Profilová foto', ['class' => 'photo-label']) !!}
							{{-- zobrazene foto uzivatela --}}
							<img class="img-responsive photo" src=" {{asset('uploads/profile_photos/'. $user->profile_photo)}}">
						{{ Form::file('profile_photo') }}
					</div>{{-- profilova foto uzivatela --}}
				</div>

				{{-- clearnutie dalsieho obsahu --}}
				<div class="clear-content"></div>

				{{-- submit button --}}
				<div class="form-group">
					{!! Form::button('Uprav profil', [
						'type' => 'submit',
						'class' => 'btn btn-primary'
					]) !!}
				</div>

			{!! Form::close() !!}

		</div>{{-- column --}}
	</div>{{-- form na upravu profilu --}}

@endsection

{{-- js subory --}}
@section('scripts')
	{{-- js validacia formularu --}}
	<script src=" {{ asset('js/parsley.min.js') }} "></script>
@endsection