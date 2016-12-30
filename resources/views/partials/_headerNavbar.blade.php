{{-- Hlavne menu --}}
<nav class="navbar navbar-inverse">
    
    {{-- pridany margin po stranach --}}
    <div class="container">

        {{-- hlavicka menu pri mobile zobrazeni --}}
        <div class="navbar-header">

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-responsive">

                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>

            </button>

            <a class="navbar-brand navbar-active" href="{{ url('post') }}">Všetky blogy</a>
            

        </div>

    {{-- na mobile skryte v scroll menu --}}
    <div class="collapse navbar-collapse" id="navbar-collapse-responsive">

    <ul class="nav navbar-nav">
        <li ><a href="#">Kategórie</a></li>
        <li ><a href="#">Blogery</a></li>

        {{-- prihlaseny --}}
        @if( Auth::check() )
            <li class="imp"><a href=" {{ url('post/create') }} ">Nový blog</a></li>
        @else
            {{-- neprihlaseny --}}
            <li><a href="#">Chcem písať blog</a></li>
        @endif

    </ul>
   
    {{-- prava strana navbaru --}}
    <ul class="nav navbar-nav navbar-right">

        {{-- Ak je user prihlaseny!!!!!!!!!!!! --}}
        @if( Auth::check() )
            <li class="imp"><a href="#">Moje blogy</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> 
                    <img src=" {{asset('uploads/profile_photos/'.Auth::user()->profile_photo)}}" style="width: 30px; height: 30px; border-radius: 50%; border: 1px solid grey;"> {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-login">

                    <li><a href="{{ url('profile') }}">Ukaz profil</a></li>
                    <li><a href="{{ url('logout') }}" >Odhlásiť sa</a></li>

                </ul>

            </li>
        @else
            {{-- neprihlaseny --}}
            <li class="imp"><a href="{{ url('login') }}">Prihlásiť sa</a></li>
        @endif

      </ul>

    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->

</nav>