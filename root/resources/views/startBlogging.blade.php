{{-- Stranka pre neprihlaseneho uzivatela - ukaze mu ako zacat pisat blog --}}

@extends('contentWithoutSidebars')

{{-- linky na potrebne CSS subory --}}
@section('stylesheets')
    {{-- ikony --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
@endsection

{{-- nadpis stranky --}}
@section('pageTitle')
    <div class="row">
        <div class="col-lg-12 col-md-12 text-center post-title">
            <h1 class="title title-marker">Začnite tvoriť...</h1>
        </div>
    </div>
@endsection

{{-- obsah stranky --}}
@section('content')
    <div class="row">
        {{-- content wrapper --}}
        <div class="col-sm-12 get-blog-wrapper">
            {{-- background image --}}
            <img src="{{ asset('images/blog-background-laptop.jpg') }}" class = "background-image">
            {{-- obsah v image-i --}}
            <div class="get-started-wrapper">
                {{-- nadpis --}}
                <h2 class="title">Vytvorte si vlastný blog</h2>
                {{-- text --}}
                <p>Začnite písať články hneď teraz!
                Podelte sa so svojimi priateľmi o svoje zážitky či myšlienky.
                Je to jednoduché. Stačí sa prihlásiť a môžte písať.</p>
                {{-- link na prihlasenie sa --}}
                <a href="{{ url('login') }}" class="btn btn-default btn-lg moj">Začať písať</a>
            </div>{{-- obsah v image-i --}}
        </div>{{-- content wrapper --}}
    </div>

    {{-- dalsi text --}}
    <div class="row text-center">
        <div class="col-sm-8 register-text">
            <h2>Ak ešte nemáte vytvorený účet, zaregistrujte sa.</h2>
            <p>Zaberie vám to iba pár sekúnd</p>
        </div>
        <div class="col-sm-4 register-button">
            {{-- link sa registraciu --}}
            <a href="{{ url('register') }}" class="btn btn-primary btn-lg">Registrovať sa</a>
        </div>
    </div>{{-- dalsi text --}}

@endsection