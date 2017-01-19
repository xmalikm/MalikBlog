
 {{-- sidebar -> najcitanejsie blogy za urcite obdobie --}}
<div class="panel panel-info panel-table">

    {{-- nadpis --}}
    <div class="panel-heading panel-table-heading">
        <h3 class="text-center">Najnovšie a najpopulárnejšie</h3>
    </div>

	{{-- telo --}}
    <div class="panel-body">
                            
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#newest">Najnovšie</a></li>
            <li><a data-toggle="tab" href="#mostPopular">Najpopulárnejšie</a></li>
        </ul>

        <div class="tab-content">
            <div id="newest" class="tab-pane fade in active">
                <ol>
                    @foreach($newPopular['newest'] as $post)
                        <li><a href="{{ url('post', $post->id) }}"><span style="color: black; text-decoration: none;">{{ $post->user->name }}:</span> {{ $post->title }}</a> <small>{{ $post->created_at }}</small></li>
                        <hr>
                    @endforeach
                </ol>
            </div>
            <div id="mostPopular" class="tab-pane fade">
                <ol>
                    @foreach($newPopular['mostPopular'] as $post)
                        <li><a href="{{ url('post', $post->id) }}"><span style="color: black; text-decoration: none;">{{ $post->user->name }}:</span> {{ $post->title }}</a> <small>{{ $post->popularity }}</small></li>
                        <hr>
                    @endforeach
                </ol>
            </div>
        </div>

    </div>{{-- panel body --}}

</div>{{-- najcitanejsie blogy --}}