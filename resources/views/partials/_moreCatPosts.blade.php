<div class="col-md-6">
	
	<h3 class="title">Ďalšie články z kategórie {{ $post->category->name }}</h3>
	<ul style="list-style-type: none;">
		@forelse($postsFromCat as $categoryPost)
			<li>
                <article class="post-sample-small clear-content">
                    <div class="post-thumbnail">
                        <a href="{{ route('post.show', ['id' => $categoryPost->id, 'slug' => $categoryPost->slug]) }}"><img src="{{asset('uploads/blog_photos/'. $categoryPost->blog_photo)}}"></a>
                    </div>
                    <div class="post-content">
                        {{-- nadpis --}}
                        <h5 class="title"><a href="{{ route('post.show', ['id' => $categoryPost->id, 'slug' => $categoryPost->slug]) }}">{{ $categoryPost->title_teaser }}</a></h5>
                        {{-- autor + datum --}}
                        <small>
                            <span class="glyphicon glyphicon-user"></span>
                            <a href="{{ url('user', $categoryPost->user->id) }}">{{ $categoryPost->user->name}}</a><br>
                            <span class="glyphicon glyphicon-time"></span>
                            <span>{{ $categoryPost->created_at }}</span>
                        </small>
                    </div>
                </article>
            </li>
			<br>
		@empty
			<h4>Žiadne ďalšie články</h4>
		@endforelse
	</ul>
	
</div>