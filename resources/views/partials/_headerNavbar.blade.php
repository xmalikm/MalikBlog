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

            <a class="navbar-brand navbar-active" href="#">Všetky blogy</a>
            

        </div>

    {{-- na mobile skryte v scroll menu --}}
    <div class="collapse navbar-collapse" id="navbar-collapse-responsive">

    <ul class="nav navbar-nav">
        <li ><a href="#">Kategórie</a></li>
        <li ><a href="#">Blogery</a></li>

        {{-- neprihlaseny --}}
        <li><a href="#">Chcem písať blog</a></li>

        {{-- prihlaseny --}}
        {{-- <li class="imp"><a href="#">Nový blog</a></li> --}}

    </ul>
   
    {{-- prava strana navbaru --}}
    <ul class="nav navbar-nav navbar-right">
        
        {{-- prihlaseny --}}
        {{-- <li class="imp"><a href="#">Moje blogy</a></li> --}}

        {{-- neprihlaseny --}}
        <li class="imp"><a href="#">Prihlásiť sa</a></li>

        {{-- Ak je user prihlaseny!!!!!!!!!!!! --}}
     {{--   <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Martin Malik<span class="caret"></span></a>

            <ul class="dropdown-menu">

                <li><a href="#">Odhlásiť sa</a></li>
                <li><a href="#">Este nieco ine</a></li>

            </ul>

        </li> --}}

      </ul>

    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->

</nav>