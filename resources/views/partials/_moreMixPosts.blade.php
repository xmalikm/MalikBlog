<div class="row">
	<section class="post-sample-list">
		<div id="recent-posts" class="col-md-12" style="border-top: 2px solid grey;">
			<h3 class="title">Mohlo by vás zaujímať</h3>
			<ul>
				@foreach($recentPosts as $recentPost)
					<li>
						<div class="col-md-3 col-sm-6 post-sample-wrapper-row">
							<article class=" clear-content">
		                            <div class="post-thumbnail" style="float: none;">
		                                <a href="{{ route('post.show', ['id' => $recentPost->id, 'slug' => $recentPost->slug]) }}">
											<img class="img-responsive" src="{{ asset('uploads/blog_photos/'. $recentPost->blog_photo) }}" >
		                                </a>
		                            </div>
		                            <div class="post-content">
		                            	<div class="post-sample-info">
			                            	<a class="btn btn-xs btn-warning post-category" href="{{ url('category', $recentPost->category->id) }}">{{$recentPost->category->name}}</a>
			                            	<br>
			                            	<small>
												<span class="glyphicon glyphicon-user"></span>
												<a href="{{ url('user', $recentPost->user->id) }}">{{ $recentPost->user->name}}</a><br>
												<span class="glyphicon glyphicon-time"></span><span>{{ $recentPost->created_at }}</span>
											</small>
			                                {{-- nadpis --}}
			                                <h5 class="post-title">
			                                	<a href="{{ route('post.show', ['id' => $recentPost->id, 'slug' => $recentPost->slug]) }}">{{$recentPost->title_teaser}}</a>
			                                </h5>
			                            </div>
		                            </div>
		                        </article>
							<br>
						</div>
					</li>
				@endforeach
			</ul>
		</div>
	</section>
</div>