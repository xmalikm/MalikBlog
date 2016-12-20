@extends('contentSidebar')

@section('content')
    <h1>Login page</h1>

    {{-- prihlasovaci formular --}}
    {{ Form::open(['url' => url('/login'), 'method' => 'post']) }}

        <div class="row">

            <div class="col-lg-6 col-lg-offset-3">
                
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
                    {!! Form::email('email', old('email'), [
                        'placeholder' => 'E-mail',
                        'autofocus' => true,
                        'class' => 'form-control'
                    ]) !!}
                    {{-- error message -> ak nie je zadany mail --}}
                    @if ($errors->has('email'))
                        <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- prihlasovacie heslo --}}
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                    {!! Form::label('password', 'Heslo', [
                            'class' => 'control-label'
                    ]) !!}
                    
                    {!! Form::password('password', [
                            'placeholder' => 'heslo',
                            'class' => 'form-control'
                    ]) !!}
                    
                    {{-- error message -> ak nie je zadane heslo --}}
                    @if ($errors->has('password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
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
                        'class' => 'btn btn-lg btn-primary'
                    ]) !!}
                    <a class="btn btn-link" href="{{ url('/password/reset') }}">
                        Zabudol som heslo
                    </a>
                </div>
                
                {{-- link na registraciu --}}
                <p class="action">
                    <a href="{{ url('register') }}">Registrovať sa</a>
                </p>        

            </div>

        </div>

    {{ Form::close() }}

@endsection

@section('sidebars')

    {{-- najcitanejsie blogy --}}
    <div class="panel panel-info panel-table">

        <div class="panel-heading panel-table-heading">

            Autor clanku

        </div>

        <div class="panel-body">
                            
            Info o autorovi

        </div>{{-- panel body --}}

    </div>{{-- najcitanejsie blogy --}}

@endsection