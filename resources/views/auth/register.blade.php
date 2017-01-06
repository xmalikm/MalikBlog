@extends('contentWithSidebars')

@section('content')
    <h1>Register page</h1>

    {{-- registracny formular --}}
    {!! Form::open([ 'url' => 'register', 'method' => 'post']) !!}

        <div class="row">

            <div class="col-lg-6 col-lg-offset-3">
                

                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        {!! Form::label('name', 'Meno', [
                            'class' => 'control-label'
                        ]) !!}
                        {!! Form::text('name', 'martin', [
                            'class' => 'form-control',
                            'placeholder' => 'name',
                            'autofocus' => true
                        ]) !!}
                        @if ($errors->has('name'))
                            <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    {!! Form::label('email', 'E-mailová adresa', [
                        'class' => 'control-label'
                    ]) !!}
                    {!! Form::email('email', 'xmalikm3@gmail.com', [
                        'placeholder' => 'E-mail',
                        'class' => 'form-control'
                    ]) !!}
                     @if ($errors->has('email'))
                        <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                 <div class="form-group  {{ $errors->has('password') ? 'has-error' : '' }}">
                    {!! Form::label('password', "Heslo", [
                        'class' => 'control-label'
                    ]) !!}
                    {!! Form::password('password', [
                        'class' => 'form-control',
                        'placeholder' => 'heslo'
                    ]) !!}
                    @if ($errors->has('password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group  {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    {!! Form::label('password_confirmation', "Potvrdenie hesla", [
                        'class' => 'control-label'
                    ]) !!}
                    {!! Form::password('password_confirmation', [
                        'class' => 'form-control',
                        'placeholder' => 'potvrdenie hesla'
                    ]) !!}
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                     {!! Form::button('Registrovať sa', [
                    'type' => 'submit',
                    'class' => 'btn btn-lg btn-primary'
                    ]) !!}
                </div>

                <p class="action">
                    or <a href="{{ url('login') }}">Prihlásiť sa</a>
                </p>

            </div>{{-- col --}}

        </div>{{-- row --}}

    {!! Form::close() !!}

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