{{-- najviac komentovane clanky --}}
<section>
    {{-- row --}}
    <div class="row">
        {{-- nadpis --}}
        <div class="col-lg-12">
            <h3 class="title title-marker">Diskutované články</h3>
        </div>
        {{-- column --}}
        <div class="col-md-12 post-sample-small-list">
            {{-- zoznam clankov --}}
            <ul>
                @forelse($discussedPosts as $post)
                    <li>
                        <article class="post-sample-small clear-content">
                            {{-- foto clanku --}}
                            <div class="post-thumbnail">
                                <a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}"><img src="{{asset('uploads/blog_photos/'. $post->blog_photo)}}"></a>
                            </div>
                            <div class="post-content">
                                {{-- nadpis --}}
                                <h5 class="title">
                                    <a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}">{{ $post->title_teaser }}</a>
                                </h5>
                                {{-- autor + datum --}}
                                <small>
                                    {{-- autor --}}
                                    <span class="glyphicon glyphicon-user"></span>
                                    <a href="{{ url('user', $post->user->id) }}">{{ $post->user->name}}</a><br>
                                    {{-- datum vydania --}}
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
        </div>{{-- column --}}
    </div>{{-- row --}}
</section>