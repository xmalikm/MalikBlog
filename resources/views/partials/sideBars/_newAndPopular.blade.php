{{-- nove a popularne clanky --}}
<section>
    {{-- row --}}
    <div class="row">
        {{-- column --}}
        <div class="col-md-12">
            {{-- nadpis --}}
            <h3 class="title title-marker">Najnovšie a najpopulárnejšie</h3>
            {{-- taby na prepinanie medzi najnovsimi a najpopularnejsimi clankami --}}
            <ul class="nav nav-tabs">
                {{-- najnovsie clanky --}}
                <li class="active"><a data-toggle="tab" href="#newest">Najnovšie</a></li>
                {{-- najpopularnejsie clanky --}}
                <li><a data-toggle="tab" href="#mostPopular">Najpopulárnejšie</a></li>
            </ul>
            
            {{-- zoznamy najnovsich a najpopularnejsich clankov --}}
            <div class="tab-content">

                {{-- nove clanky --}}
                <div id="newest" class="tab-pane fade in active post-sample-small-list">
                    <ol>
                        @foreach($newest as $post)
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
                                            <span class="glyphicon glyphicon-time" title="Dátum vydania článku"></span>
                                            {{-- pocet zhliadnuti --}}
                                            <small title="Dátum vydania článku">{{ $post->created_at }}</small>
                                        </small>
                                    </div>
                                </article>
                            </li>
                        @endforeach
                    </ol>
                </div>

                {{-- popularne clanky --}}
                <div id="mostPopular" class="tab-pane fade post-sample-small-list">
                    <ol>
                        @foreach($popular as $post)
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
                                            <span class="glyphicon glyphicon-star-empty" title="Popularita článku"></span>
                                            {{-- pocet zhliadnuti --}}
                                            <small title="Popularita článku">{{ $post->unique_views }}</small>
                                        </small>
                                    </div>
                                </article>
                            </li>
                        @endforeach
                    </ol>
                </div>

            </div>
        </div>{{-- column --}}
    </div>{{-- row --}}

</section>{{-- nove a popularne clanky --}}