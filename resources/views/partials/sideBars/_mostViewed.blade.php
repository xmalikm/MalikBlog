{{-- najcitanejsie posty --}}
<section>
    {{-- row --}}
    <div class="row">
        {{-- column --}}
        <div class="col-md-12">
            {{-- nadpis sekcie --}}
            <h3 class="title title-marker" >Najčítanejšie články</h3>
            {{-- taby na prepinanie casoveho rozmedzia vydania clankov --}}
             <ul class="nav nav-tabs">
                {{-- clanky za dnes --}}
                <li class="active"><a data-toggle="tab" href="#today">Dnes</a></li>
                {{-- clanky za posledne 3 dni --}}
                <li><a data-toggle="tab" href="#3days">3 dni</a></li>
                {{-- clanky za poslednych 7 dni--}}
                <li><a data-toggle="tab" href="#7days">7 dní</a></li>
            </ul>

            {{-- zoznamy najcitanejsich clankov za rozne casove obdobia --}}
            <div class="tab-content">

                {{-- dnesne najcitanejsie clanky --}}
                <div id="today" class="tab-pane fade in active post-sample-small-list">
                    <ol>
                        @forelse($mostViewed['today'] as $post)
                            <li>
                                <article class="post-sample-small clear-content">
                                    {{-- foto clanku --}}
                                    <div class="post-thumbnail">
                                        <a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}"><img src="{{asset('uploads/blog_photos/'. $post->blog_photo)}}"></a>
                                    </div>
                                    {{-- info k clanku --}}
                                    <div class="post-content">
                                        {{-- nadpis --}}
                                        <h5 class="title"><a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}">{{ $post->title_teaser }}</a></h5>
                                        {{-- autor + pocet zhliadnuti --}}
                                        <small>
                                            <span class="glyphicon glyphicon-user" title="Autor článku"></span>
                                            {{-- meno autora --}}
                                            <a href="{{ url('user', $post->user->id) }}" title="Autor článku">{{ $post->user->name}}</a><br>
                                            <span class="glyphicon glyphicon-eye-open" title="Počet videní"></span>
                                            {{-- pocet zhliadnuti --}}
                                            <small title="Počet videní">{{ $post->unique_views }}</small>
                                        </small>
                                    </div>
                                </article>
                            </li>
                            {{-- ak este neboli pridane ziadne clanky --}}
                        @empty
                            <p><strong>Dnes ešte neboli pridané žiadne články</strong></p>
                        @endforelse
                    </ol>
                </div>

                {{-- najcitanejsie clanky za posledne 3 dni --}}
                <div id="3days" class="tab-pane fade post-sample-small-list">
                    <ol>
                        @forelse($mostViewed['3days'] as $post)
                            <li>
                                <article class="post-sample-small clear-content">
                                    {{-- foto clanku --}}
                                    <div class="post-thumbnail">
                                        <a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}"><img src="{{asset('uploads/blog_photos/'. $post->blog_photo)}}"></a>
                                    </div>
                                    {{-- info k clanku --}}
                                    <div class="post-content">
                                        {{-- nadpis --}}
                                        <h5 class="title"><a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}">{{ $post->title_teaser }}</a></h5>
                                        {{-- autor + pocet zhliadnuti --}}
                                        <small>
                                            <span class="glyphicon glyphicon-user" title="Autor článku"></span>
                                            {{-- meno autora --}}
                                            <a href="{{ url('user', $post->user->id) }}" title="Autor článku">{{ $post->user->name}}</a><br>
                                            <span class="glyphicon glyphicon-eye-open" title="Počet videní"></span>
                                            {{-- pocet zhliadnuti --}}
                                            <small title="Počet videní">{{ $post->unique_views }}</small>
                                        </small>
                                    </div>
                                </article>
                            </li>
                            {{-- ak este neboli pridane ziadne clanky --}}
                        @empty
                            <p><strong>Za posledné 3 dni ešte neboli pridané žiadne články</strong></p>
                        @endforelse
                    </ol>
                </div>

                {{-- najcitanejsie clanky za poslednych 7 dni --}}
                <div id="7days" class="tab-pane fade post-sample-small-list">
                    <ol>
                        @forelse($mostViewed['7days'] as $post)
                            <li>
                                <article class="post-sample-small clear-content">
                                    {{-- foto clanku --}}
                                    <div class="post-thumbnail">
                                        <a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}"><img src="{{asset('uploads/blog_photos/'. $post->blog_photo)}}"></a>
                                    </div>
                                    {{-- info k clanku --}}
                                    <div class="post-content">
                                        {{-- nadpis --}}
                                        <h5 class="title"><a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}">{{ $post->title_teaser }}</a></h5>
                                        {{-- autor + pocet zhliadnuti --}}
                                        <small>
                                            <span class="glyphicon glyphicon-user" title="Autor článku"></span>
                                            {{-- meno autora --}}
                                            <a href="{{ url('user', $post->user->id) }}" title="Autor článku">{{ $post->user->name}}</a><br>
                                            <span class="glyphicon glyphicon-eye-open" title="Počet videní"></span>
                                            {{-- pocet zhliadnuti --}}
                                            <small title="Počet videní">{{ $post->unique_views }}</small>
                                        </small>
                                    </div>
                                </article>
                            </li>
                            {{-- ak este neboli pridane ziadne clanky --}}
                                @empty
                                    <p><strong>Za posledných 7 dni ešte neboli pridané žiadne články</strong></p>
                                @endforelse
                    </ol>
                </div>

            </div>{{-- zoznamy najcitanejsich clankov za rozne casove obdobia --}}

        </div>{{-- column --}}
    </div>{{-- row --}}
</section>{{-- najcitanejsie posty --}}