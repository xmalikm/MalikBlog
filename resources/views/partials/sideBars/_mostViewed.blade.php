
 {{-- sidebar -> najcitanejsie blogy za urcite obdobie --}}
<div class="panel panel-info panel-table">

    {{-- nadpis --}}
    <div class="panel-heading panel-table-heading">
        <h3 class="text-center">Najčítanejšie články</h3>
    </div>

	{{-- telo --}}
    <div class="panel-body">
                            
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#today">Dnes</a></li>
            <li><a data-toggle="tab" href="#3days">3 dni</a></li>
            <li><a data-toggle="tab" href="#7days">7 dní</a></li>
        </ul>

        <div class="tab-content">
            <div id="today" class="tab-pane fade in active">
                <ol>
                    @foreach($mostViewed['today'] as $post)
                        <li><a href="{{ url('post', $post->id) }}"><span style="color: black; text-decoration: none;">{{ $post->user->name }}:</span> {{ $post->title }}</a> <small>{{ $post->unique_views }}</small></li>
                        <hr>
                    @endforeach
                </ol>
            </div>
            <div id="3days" class="tab-pane fade">
                <ol>
                    @foreach($mostViewed['3days'] as $post)
                        <li><a href="{{ url('post', $post->id) }}"><span style="color: black; text-decoration: none;">{{ $post->user->name }}:</span> {{ $post->title }}</a> <small>{{ $post->unique_views }}</small></li>
                        <hr>
                    @endforeach
                </ol>
            </div>
            <div id="7days" class="tab-pane fade">
                <ol>
                    @foreach($mostViewed['7days'] as $post)
                        <li><a href="{{ url('post', $post->id) }}"><span style="color: black; text-decoration: none;">{{ $post->user->name }}:</span> {{ $post->title }}</a> <small>{{ $post->unique_views }}</small></li>
                        <hr>
                    @endforeach
                </ol>
            </div>
        </div>

    </div>{{-- panel body --}}

</div>{{-- najcitanejsie blogy --}}