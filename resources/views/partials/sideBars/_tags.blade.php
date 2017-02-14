{{-- tagy --}}
<section class="posts-tags">
    <div class="row">
        {{-- nadpis sekcie --}}
        <div class="col-lg-12">
            <h3 class="title title-marker">Tagy<img class="sidebar-icon" src="{{asset('images/icons/tags.png')}}"></h3>
        </div>
        {{-- zoznam tagov --}}
        <div class="col-lg-12 tags-list">
            @foreach($tags as $tag)
                <a href="{{ url('tag', $tag->id) }}" class="btn btn-sm btn-default">{{ $tag->name }} <span class="badge num-of-posts">{{ count($tag->posts) }}</span></a>
            @endforeach
        </div>{{-- zoznam tagov --}}
    </div>{{-- row --}}
</section>{{-- tagy --}}{{-- row --}}