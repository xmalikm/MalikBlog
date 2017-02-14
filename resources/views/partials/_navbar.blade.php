{{-- Hlavne navigacne menu --}}
<nav class="navbar navbar-inverse navbar-blog">
    
    <div class="container">

        {{-- hlavicka menu pri 'mobile' zobrazeni --}}
        <div class="navbar-header">
            {{-- button na rozkliknutie menu --}}
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-responsive">

                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>

            </button>
            {{-- link zobrazovany pri 'mobile' zobrazeni --}}
            <a class="navbar-brand navbar-active hidden-lg hidden-md hidden-sm" href="{{ url('/') }}"><img class="navbar-icon" src="{{asset('images/icons/home.png')}}">Home</a>
            

        </div>

        {{-- dalsie linky --}}
        <div class="collapse navbar-collapse" id="navbar-collapse-responsive">
            {{-- linky na pravej strane menu --}}
            <ul class="nav navbar-nav navbar-blog-nav">
                {{-- home --}}
                <li class="hidden-xs">
                    <a class="navbar-brand navbar-active" href="{{ url('/') }}">
                        <img class="navbar-icon" src="{{asset('images/icons/home.png')}}">Home
                    </a>
                </li>
                {{-- zoznam vsetkych blogov --}}
                <li>
                    <a href="{{ url('post') }}">
                        <img class="navbar-icon" src="{{asset('images/icons/posts.png')}}">Všetky blogy
                    </a>
                </li>
                {{-- zoznam vsetkych blogerov --}}
                <li>
                    <a href=" {{ url('blogers') }} ">
                        <img class="navbar-icon" src="{{asset('images/icons/bloggers.png')}}">Blogery
                    </a>
                </li>

                {{-- ak je uzivatel prihlaseny --}}
                @if( Auth::check() )
                    {{-- vytvorenie noveho clanku --}}
                    <li class="imp hidden-sm">
                        <a href=" {{ url('post/create') }} ">
                            <img class="navbar-icon img-round" src="{{asset('images/icons/write.png')}}">Nový blog
                        </a>
                    </li>
                {{-- uzivatel nie je neprihlaseny --}}
                @else
                    {{-- link pre neprihlasenych uzivatelov, ktori chcu pisat clanky --}}
                    <li>
                        <a href="#">
                            <img class="navbar-icon img-round" src="{{asset('images/icons/write.png')}}">Chcem písať blog
                        </a>
                    </li>
                @endif
            </ul>{{-- linky na pravej strane menu --}}
           
            {{-- linky na lavej strane menu --}}
            <ul class="nav navbar-nav navbar-right">
                {{-- ak je uzivatel prihlaseny --}}
                @if( Auth::check() )
                    {{-- drop-down menu --}}
                    <li class="dropdown">
                        {{-- profilova foto prihlaseneho uzivatela - sluzi na rozkliknutie drop-down menu --}}
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> 
                            <img class="navbar-icon img-round" src=" {{asset('uploads/profile_photos/'.Auth::user()->profile_photo)}}"> {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        {{-- obsah drop-down menu --}}
                        <ul class="dropdown-menu dropdown-menu-login">
                            {{-- profil uzivatela --}}
                            <li>
                                <a href="{{ url('profile') }}">
                                    <img class="navbar-icon" src="{{asset('images/icons/user_profile.png')}}">Ukaz profil
                                </a>
                            </li>
                            {{-- zoznam clankov prihlaseneho uzivatela --}}
                            <li>
                                <a href=" {{ url('profile/my-posts') }} ">
                                    <img class="navbar-icon" src="{{asset('images/icons/user_posts1.png')}}">Moje blogy
                                </a>
                            </li>
                            {{-- prisanie noveho clanku --}}
                            <li class="imp hidden-xs hidden-md hidden-lg">
                                <a href=" {{ url('post/create') }} ">
                                    <img class="navbar-icon img-round" src="{{asset('images/icons/write.png')}}">Nový blog
                                </a>
                            </li>
                            {{-- odhlasenie sa --}}
                            <li>
                                <a href="{{ url('logout') }}" >
                                    <img class="navbar-icon" src="{{asset('images/icons/logout.png')}}">Odhlásiť sa
                                </a>
                            </li>
                        </ul>{{-- obsah drop-down menu --}}
                    </li>{{-- drop-down menu --}}
                {{-- uzivatel nie je neprihlaseny --}}
                @else
                {{-- prihlasenie sa --}}
                    <li class="imp">
                        <a href="{{ url('login') }}">
                            <img class="navbar-icon" src="{{asset('images/icons/login.png')}}">Prihlásiť sa
                        </a>
                    </li>
                @endif
            </ul>{{-- linky na lavej strane menu --}}

        </div>{{-- dalsie linky --}}

    </div>{{-- contrainer --}}

</nav>