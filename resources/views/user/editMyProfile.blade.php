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
					<div class="col-lg-6 file-input-wrapper">
						{!! Form::label('text', 'Profilová foto', ['class' => 'photo-label']) !!}
							{{-- aktualny obrazok clanku --}}
							<img class="img-responsive photo" src=" {{asset('uploads/profile_photos/'. $user->profile_photo)}}">
						{{ Form::file('profile_photo') }}
					</div>{{-- profilova foto --}}
				</div>

				{{-- clearnutie za obrazkom --}}
				<div class="clear-content"></div>

				<div class="form-group">
					{!! Form::button('Uprav profil', [
						'type' => 'submit',
						'class' => 'btn btn-primary'
					]) !!}
				</div>

			{!! Form::close() !!}

			{{-- profilova fotka --}}

		</div>

	</div>{{-- form na upravu profilu --}}

@endsection

@section('scripts')
	
	<script src=" {{ asset('js/parsley.min.js') }} "></script>

@endsection