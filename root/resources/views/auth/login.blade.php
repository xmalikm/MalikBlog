{{-- Login stranka aplikacie --}}

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
            <h1 class="title title-marker">Prihlásiť sa</h1>
        </div>
    </div>

@endsection

{{-- content stranky --}}
@section('content')
    {{-- ak bol vymazany ucet uzivatela, vypisesa sa sprava --}}
    @if(Session::has('userDeleted'))
        <h2 class="text-danger text-center"><b> {{ Session::get('userDeleted') }} </b></h2>
    @endif
    
    {{-- prihlasovaci formular --}}
    <div class="row form">
        {{-- vycentrovanie formularu --}}
        <div class=" form-center">

            {{-- hlavicka formularu --}}
            <div class="form-header"></div>
            {{-- samotny formular --}}
            {{ Form::open(['url' => url('/login'), 'method' => 'post', 'data-parsley-validate' => '']) }}

                {{-- error message -> ak su zle zadane prihlasovacie udaje --}}
                @if ($errors->first('failedLogin'))
                    <span class="help-block">
                    <strong>{{ $errors->first('failedLogin') }}</strong>
                    </span>
                @endif
                
                {{-- prihlasovaci email --}}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    {!! Form::label('email', 'E-mailová adresa', [
                        'class' => 'control-label'
                    ]) !!}
                    <div class="cols-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-envelope fa" aria-hidden="true"></i>
                            </span>
                            {!! Form::email('email', old('email'), [
                                'placeholder' => 'E-mail',
                                'autofocus' => true,
                                'class' => 'form-control',
                                'required' => '',
                                'id' => 'email',
                            ]) !!}

                        </div>
                        {{-- error message -> ak nie je zadany mail --}}
                        @if ($errors->has('email'))
                            <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{-- prihlasovacie heslo --}}
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    {!! Form::label('password', 'Heslo', [
                            'class' => 'control-label'
                    ]) !!}
                    <div class="cols-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-lock fa" aria-hidden="true"></i>
                            </span>
                            {!! Form::password('password', [
                                    'placeholder' => 'Heslo',
                                    'class' => 'form-control',
                                    'required' => ''
                            ]) !!}
                        </div>
                        {{-- error message -> ak nie je zadane heslo --}}
                        @if ($errors->has('password'))
                            <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{-- zapamatat si prihlasenie --}}
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            {{ Form::checkbox('remember') }} Zapamätať
                        </label>
                    </div>
                </div>
                
                {{-- submit button --}}
                <div class="form-group">
                    {!! Form::button('Prihlásiť sa', [
                        'type' => 'submit',
                        'class' => 'btn btn-default moj',
                    ]) !!}
                    
                </div>
                {{-- link na registraciu + zabudnute heslo --}}
                <p class="action">
                    <a href="{{ url('register') }}">Registrovať sa</a> | <a  href="{{ url('/password/reset') }}">
                        Zabudol som heslo
                    </a>
                </p>

            {{ Form::close() }}
        </div>{{-- vycentrovanie formularu --}}
    </div>{{-- prihlasovaci formular --}}

@endsection

{{-- potrebne js subory --}}
@section('scripts')
    
    {{-- javascript validacia formularov --}}
    <link rel="stylesheet" type="text/css" href="js/parsley.min.js">

@endsection