@extends('contentWithoutSidebars')

{{-- title stranky --}}
@section('title', $title)

@section('breadcrumbs')
	{!! Breadcrumbs::render('editMyProfile') !!}
@endsection

@section('pageTitle', 'Uprava profilu')

@section('content')

	@if(count($errors) >0)
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
            	<li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

	{{-- form na upravu profilu --}}
	<div class="row">

		<div class="col-md-12">

			{!! Form::model($user, ['url' => url('profile'), 'method' => 'put', 'enctype' => 'multipart/form-data', 'data-parsley-validate' => '']) !!}
				
				{{-- meno --}}
				<div class="form-group">
					{!! Form::label('text', 'Meno') !!}
					{!! Form::text('name', null, [
						'class' => 'form-control',
						'placeholder' => 'Meno',
						'required' => '',
						'maxlength' => 20
					]) !!}
				</div>{{-- meno --}}

				{{-- email --}}
				<div class="form-group">
					{!! Form::label('text', 'Email') !!}
					{!! Form::email('email', null, [
						'class' => 'form-control',
						'placeholder' => 'Email',
						'required' => ''
					]) !!}
				</div>{{-- email --}}

				{{-- o sebe --}}
				<div class="form-group">
					{!! Form::label('text', 'O sebe') !!}
					{!! Form::textarea('about', null, [
						'class' => 'form-control',
						'placeholder' => 'O sebe',
						'row' => 4,
					]) !!}
				</div>{{-- o sebe --}}

				{{-- profilova foto --}}
				<div class="form-group">
					{!! Form::label('text', 'Profilová foto') !!}
					<br>
					@if(Route::currentRouteName() === 'profile.edit')
						{{-- aktualny obrazok clanku --}}
						<img src=" {{asset('uploads/profile_photos/'. $user->profile_photo)}}" style="width: 200px; height: 250px; border: 1px solid grey;">
					@endif
					{{ Form::file('profile_photo') }}
				</div>
				{{-- profilova foto --}}

				{!! Form::button('Uprav profil', [
					'type' => 'submit',
					'class' => 'btn btn-primary'
				]) !!}

			{!! Form::close() !!}

			{{-- profilova fotka --}}

		</div>

	</div>{{-- form na upravu profilu --}}

@endsection

@section('scripts')
	
	<script src=" {{ asset('js/parsley.min.js') }} "></script>

@endsection