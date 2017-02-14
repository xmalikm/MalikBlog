<div class="col-md-6">
	
	<h3 class="title">Ďalšie články autora {{ $user->name }}</h3>
    <div class="post-sample-small-list">
	<ul style="list-style-type: none;">
		@forelse($postsFromAuthor as $authorPost)
			<li>
                            <article class="post-sample-small clear-content">
                                <div class="post-thumbnail">
                                    <a href="{{ route('post.show', ['id' => $authorPost->id, 'slug' => $authorPost->slug]) }}"><img src="{{asset('uploads/blog_photos/'. $authorPost->blog_photo)}}"></a>
                                </div>
                                <div class="post-content">
                                    {{-- nadpis --}}
                                    <h5 class="title"><a href="{{ route('post.show', ['id' => $authorPost->id, 'slug' => $authorPost->slug]) }}">{{ $authorPost->title_teaser }}</a></h5>
                                    {{-- autor + datum --}}
                                    <small>
                                        <span class="glyphicon glyphicon-user"></span>
                                        <a href="{{ url('user', $authorPost->user->id) }}">{{ $authorPost->user->name}}</a><br>
                                        <span class="glyphicon glyphicon-time"></span>
                                        <span>{{ $authorPost->created_at }}</span>
                                    </small>
                                </div>
                            </article>
                        </li>
		@empty
			<h4>Žiadne ďalšie články</h4>
		@endforelse
	</ul>
	</div>
</div>