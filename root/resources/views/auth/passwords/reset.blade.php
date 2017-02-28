@extends('contentSidebar')

@section('content')
    <h1>Reset password</h1>

    {{-- prihlasovaci formular --}}
    {{ Form::open(['url' => url('/password/reset'), 'method' => 'post']) }}

        <div class="row">

            <div class="col-lg-6 col-lg-offset-3">
                
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
                
                {{-- nove heslo --}}
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    {!! Form::label('password', 'Heslo', [
                        'class' => 'control-label'
                    ]) !!}
                    {!! Form::password('password', [
                        'placeholder' => 'heslo',
                        'class' => 'form-control'
                    ]) !!}
                    {{-- error message -> ak nie je zadany mail --}}
                    @if ($errors->has('password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- potvrdenie hesla --}}
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    {!! Form::label('password-confirm', 'Potvrdenie hesla', [
                        'class' => 'control-label'
                    ]) !!}
                    {!! Form::password('password_confirmation', [
                        'placeholder' => 'potvrdenie hesla',
                        'class' => 'form-control'
                    ]) !!}
                    {{-- error message -> ak nie je zadany mail --}}
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- submit button --}}
                <div class="form-group">
                    {!! Form::button('Resetovat heslo', [
                        'type' => 'submit',
                        'class' => 'btn btn-lg btn-primary'
                    ]) !!}
                </div>
                
              
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
