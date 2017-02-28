{{-- zoznam tagov clankov --}}
<section class="posts-tags">
    {{-- row --}}
    <div class="row">
        {{-- nadpis sekcie --}}
        <div class="col-lg-12">
            <h3 class="title title-marker">
                Tagy<img class="sidebar-icon" src="{{asset('images/icons/tags.png')}}">
            </h3>
        </div>

        {{-- zoznam tagov --}}
        <div class="col-lg-12 tags-list">
            @forelse($tags as $tag)
                {{-- nazov tagu + pocet clankov s tymto tagom --}}
                <a href="{{ url('tag', $tag->id) }}" class="btn btn-sm btn-default">{{ $tag->name }} <span class="badge num-of-posts">{{ count($tag->posts) }}</span></a>

            {{-- ak este neboli vytvorene ziadne tagy --}}
            @empty
                <p><strong>Zatiaľ neboli pridané žiadné tagy.</strong></p>
            @endforelse
        </div>{{-- zoznam tagov --}}
    </div>{{-- row --}}
</section>