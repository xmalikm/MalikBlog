{{-- Hlavne menu --}}
<nav class="navbar navbar-default">
    
    {{-- pridany margin po stranach --}}
    <div class="container">

        {{-- hlavicka menu pri mobile zobrazeni --}}
        <div class="navbar-header">

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-responsive">

                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>

            </button>

            <a class="navbar-brand navbar-active" href="#">Najnovšie</a>
            <a class="navbar-brand" href="#">Najčítajenšie</a>

        </div>

    {{-- na mobile skryte v scroll menu --}}
    <div class="collapse navbar-collapse" id="navbar-collapse-responsive">

    <ul class="nav navbar-nav">

        <li ><a href="#">Najviac komentované</a></li>
        <li><a href="#">Blogery</a></li>

    </ul>
   
    <ul class="nav navbar-nav navbar-right">

        <li class="imp"><a href="#">Chcem písať blog</a></li>
        <li class="dropdown">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Prihlásiť sa<span class="caret"></span></a>

            <ul class="dropdown-menu">

                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>

            </ul>

        </li>

      </ul>

    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->

</nav>