{{-- zoznam najaktivnejsich autorov --}}
<section class="active-bloggers">
    {{-- row --}}
    <div class="row">
        {{-- column --}}
        <div class="col-lg-12">
            {{-- napdis --}}
            <h3 class="title title-marker">Najaktívnejší autori</h3>
            {{-- zoznam autorov --}}
            <ul>
                @forelse($activeBlogers as $user)

                    <li>
                        {{-- odrazka v zozname --}}
                        <span class="glyphicon glyphicon glyphicon-chevron-right"></span>&nbsp
                        {{-- profilova foto uzivatela --}}
                        <a href=" {{ url('user', $user->id) }} ">
                            <img src="{{asset('uploads/profile_photos/'. $user->profile_photo)}}" class="img-circle author-avatar">
                        </a>
                        {{-- meno uzivatela --}}
                        <h5 class="title" style="display: inline-block;">
                            <a  href=" {{ url('user', $user->id) }} "> {{ $user->name }}</a>
                        </h5>
                        {{-- pocet clankov uzivatela --}}
                        <span class="badge num-of-articles" title="Počet článkov kategórie">
                           {{ $user->numOfArticles }}
                        </span>
                    </li>
                    
                @endforeach
            </ul>
        </div>{{-- column --}}
    </div>{{-- row --}}
</section>