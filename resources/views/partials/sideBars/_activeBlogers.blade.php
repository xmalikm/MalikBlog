
 {{-- sidebar -> najcitanejsie blogy za urcite obdobie --}}
<div class="panel panel-info panel-table">

    {{-- nadpis --}}
    <div class="panel-heading panel-table-heading">
        <h3 class="text-center">Najaktívnejší autori</h3>
    </div>

	{{-- telo --}}
    <div class="panel-body">
        <ol>
            @foreach($activeBlogers as $activeBloger)
                <li><a href=" {{ url('user', $activeBloger->id) }} "><img src=" {{asset('uploads/profile_photos/'. $activeBloger->profile_photo)}}" style="width: 50px; height: 50px; border: 1px solid grey;"> {{ $activeBloger->name}} </a> <small>- články:{{ $activeBloger->num_of_articles }}</small></li>
                <hr>
            @endforeach
        </ol>

    </div>{{-- panel body --}}

</div>{{-- najcitanejsie blogy --}}