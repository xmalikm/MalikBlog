{{-- Register stranka aplikacie --}}
@extends('contentWithoutSidebars')

{{-- potrebne CSS subory --}}
@section('stylesheets')
    {{-- js validacia formularov --}}
    <link rel="stylesheet" type="text/css" href="css/parsley.css">
    {{-- css pre login/registracny formular --}}
    <link rel="stylesheet" type="text/css" href="css/login-style.css">
    {{-- ikony --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

@endsection

{{-- nadpis stranky --}}
@section('pageTitle')

    <div class="row">
        <div class="col-lg-12 col-md-12 text-center post-title">
            <h1 class="title title-marker">Registrovať sa</h1>
        </div>
    </div>

@endsection

{{-- content stranky --}}
@section('content')
    
    {{-- prihlasovaci formular --}}
    <div class="row form">
        {{-- vycentrovanie formularu --}}
        <div class="form-center">

            {{-- hlavicka formularu --}}
            <div class="form-header"></div>
            {{-- samotny formular --}}
            {!! Form::open([ 'url' => 'register', 'method' => 'post']) !!}

                {{-- meno uzivatela --}}
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    {!! Form::label('name', 'Meno', [
                        'class' => 'control-label'
                    ]) !!}
                     <div class="cols-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-user fa" aria-hidden="true"></i>
                            </span>
                            {!! Form::text('name', 'martin', [
                                'class' => 'form-control col-sm-12',
                                'placeholder' => 'name',
                                'autofocus' => true
                            ]) !!}
                            {{-- error message -> ak nie je zadane meno --}}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                
                {{-- email uzivatela --}}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    {!! Form::label('email', 'E-mailová adresa', [
                        'class' => 'control-label'
                    ]) !!}
                    <div class="cols-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-envelope fa" aria-hidden="true"></i>
                            </span>
                            {!! Form::email('email', 'xmalikm3@gmail.com', [
                                'placeholder' => 'E-mail',
                                'class' => 'form-control col-sm-12'
                            ]) !!}
                        </div>
                    </div>
                    {{-- error message -> ak nie je zadany email --}}
                    @if ($errors->has('email'))
                        <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- password uzivatela --}}
                <div class="form-group  {{ $errors->has('password') ? 'has-error' : '' }}">
                    {!! Form::label('password', "Heslo", [
                        'class' => 'control-label'
                    ]) !!}
                    <div class="cols-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-lock fa" aria-hidden="true"></i>
                            </span>
                            {!! Form::password('password', [
                                'class' => 'form-control col-sm-12',
                                'placeholder' => 'heslo'
                            ]) !!}
                            
                        </div>
                    </div>
                    {{-- error message -> ak nie je zadany password --}}
                    @if ($errors->has('password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- cofirm password --}}
                <div class="form-group  {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    {!! Form::label('password_confirmation', "Potvrdenie hesla", [
                        'class' => 'control-label'
                    ]) !!}
                    <div class="cols-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-lock fa" aria-hidden="true"></i>
                            </span>
                            {!! Form::password('password_confirmation', [
                                'class' => 'form-control col-sm-12',
                                'placeholder' => 'potvrdenie hesla'
                            ]) !!}
                            {{-- error message -> ak nie je zadany confirm password --}}
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- submit button --}}
                <div class="form-group">
                     {!! Form::button('Registrovať sa', [
                    'type' => 'submit',
                    'class' => 'btn btn-warning'
                    ]) !!}
                </div>

                {{-- link na prihlasenie sa --}}
                <p class="action">
                    or <a href="{{ url('login') }}">Prihlásiť sa</a>
                </p>

            {!! Form::close() !!}
        </div>{{-- vycentrovanie formularu --}}
    </div>{{-- prihlasovaci formular --}}

@endsection