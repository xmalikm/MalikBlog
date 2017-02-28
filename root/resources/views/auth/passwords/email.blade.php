@extends('contentWithoutSidebars')

@section('content')
    <h1>Zmena passwordu</h1>

    {{-- prihlasovaci formular --}}
    {{ Form::open(['url' => url('/password/email'), 'method' => 'post']) }}

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

                {{-- submit button --}}
                <div class="form-group">
                    {!! Form::button('Poslat link', [
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