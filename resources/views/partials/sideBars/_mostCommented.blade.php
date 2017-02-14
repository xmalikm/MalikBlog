{{-- komentovane posty --}}
<section>
    {{-- row --}}
    <div class="row">
        {{-- nadpis sekcie --}}
        <div class="col-lg-12">
            <h3 class="title title-marker">Diskutované články</h3>
        </div>
        {{-- zoznam dalsich clankov --}}
            <div class="col-md-12 post-sample-small-list">
                <ul>
                    @foreach($discussedPosts as $post)
                        <li>
                            <article class="post-sample-small clear-content">
                                <div class="post-thumbnail">
                                    <a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}"><img src="{{asset('uploads/blog_photos/'. $post->blog_photo)}}"></a>
                                </div>
                                <div class="post-content">
                                    {{-- nadpis --}}
                                    <h5 class="title"><a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}">{{ $post->title_teaser }}</a></h5>
                                    {{-- autor + datum --}}
                                    <small>
                                        <span class="glyphicon glyphicon-user"></span>
                                        <a href="{{ url('user', $post->user->id) }}">{{ $post->user->name}}</a><br>
                                        <span class="glyphicon glyphicon-time"></span>
                                        <span>{{ $post->created_at }}</span>
                                    </small>
                                </div>
                            </article>
                        </li>
                    @endforeach
                </ul>
            </div>{{-- dalsie clanky --}}
    </div>{{-- row --}}
</section>{{-- nahodne clanky --}}