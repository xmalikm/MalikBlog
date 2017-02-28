{{-- dalsie clanky od autora daneho clanku --}}
<div class="col-md-6">
	{{-- nadpis sekcie --}}
	<h3 class="title title-marker">
        Ďalšie články autora {{ $user->name }}
    </h3>

    {{-- zoznam clankov --}}
    <div class="post-sample-small-list">
    	<ul style="list-style-type: none;">
    		@forelse($postsFromAuthor as $authorPost)
    			<li>
                    <article class="post-sample-small clear-content">
                        {{-- foto clanku --}}
                        <div class="post-thumbnail">
                            <a href="{{ route('post.show', ['id' => $authorPost->id, 'slug' => $authorPost->slug]) }}">
                                <img src="{{asset('uploads/blog_photos/'. $authorPost->blog_photo)}}">
                            </a>
                        </div>
                        <div class="post-content">
                            {{-- nadpis --}}
                            <h5 class="title">
                                <a href="{{ route('post.show', ['id' => $authorPost->id, 'slug' => $authorPost->slug]) }}">{{ $authorPost->title_teaser }}</a>
                            </h5>
                            {{-- autor + datum --}}
                            <small>
                                {{-- autor clanku --}}
                                <span class="glyphicon glyphicon-user"></span>
                                <a href="{{ url('user', $authorPost->user->id) }}">{{ $authorPost->user->name}}</a><br>
                                {{-- datum vydania clanku --}}
                                <span class="glyphicon glyphicon-time"></span>
                                <span>{{ $authorPost->created_at }}</span>
                            </small>
                        </div>
                    </article>
                </li>
            {{-- ak nie su dalsie clanky od autora --}}
    		@empty
    			<h4>Žiadne ďalšie články</h4>
    		@endforelse
    	</ul>
	</div>{{-- zoznam clankov --}}
</div>