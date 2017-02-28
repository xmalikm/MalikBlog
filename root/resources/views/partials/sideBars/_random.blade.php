{{-- nahodne clanky --}}
<section>
    {{-- row --}}
    <div class="row">
        {{-- nadpis --}}
        <div class="col-lg-12" >
            <h3 class="title title-marker" >Náhodné články</h3>
        </div>

        {{-- zoznam clankov --}}
        <div class="col-md-12 post-sample-small-list">
            <ul>
                @forelse($randomPosts as $post)
                    <li>
                        <article class="post-sample-small clear-content">
                            {{-- foto clanku --}}
                            <div class="post-thumbnail">
                                <a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}"><img src="{{asset('uploads/blog_photos/'. $post->blog_photo)}}"></a>
                            </div>
                            <div class="post-content">
                                {{-- nadpis clanku --}}
                                <h5 class="title">
                                    <a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}">{{ $post->title_teaser }}</a>
                                </h5>
                                {{-- autor + datum --}}
                                <small>
                                    {{-- autor clanku --}}
                                    <span class="glyphicon glyphicon-user" title="Autor článku"></span>
                                    <a href="{{ url('user', $post->user->id) }}" title="Autor článku">{{ $post->user->name}}</a><br>
                                    {{-- datum vydania clanku --}}
                                    <span class="glyphicon glyphicon-time"></span>
                                    <span>{{ $post->created_at }}</span>
                                </small>
                            </div>
                        </article>
                    </li>

                {{-- ak este neboli pridane ziadne clanky --}}
                @empty
                    <p><strong>Ešte neboli pridané žiadne články</strong></p>

                @endforelse
            </ul>
        </div>{{-- zoznam clankov --}}
    </div>{{-- row --}}

</section>