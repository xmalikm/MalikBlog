{{-- clanky z roznych kategorii, ktore by mohli uzivatela zaujimat --}}
{{-- row --}}
<div class="row">
	<section class="post-sample-list">
		{{-- column --}}
		<div id="recent-posts" class="col-md-12" style="border-top: 2px solid grey;">
			{{-- nadpis sekcie --}}
			<h3 class="title title-marker">Mohlo by vás zaujímať</h3>
			{{-- zoznam clankov --}}
			<ul>
				@foreach($recentPosts as $recentPost)
					<li>
						{{-- wrapper --}}
						<div class="col-md-3 col-sm-6 post-sample-wrapper-row">
							<article class=" clear-content">
									{{-- foto clanku --}}
		                            <div class="post-thumbnail" style="float: none;">
		                                <a href="{{ route('post.show', ['id' => $recentPost->id, 'slug' => $recentPost->slug]) }}">
											<img class="img-responsive" src="{{ asset('uploads/blog_photos/'. $recentPost->blog_photo) }}" >
		                                </a>
		                            </div>
		                            <div class="post-content">
		                            	<div class="post-sample-info">
		                            		{{-- kategoria clanku --}}
			                            	<a class="btn btn-xs btn-warning post-category" href="{{ url('category', $recentPost->category->id) }}">{{$recentPost->category->name}}</a>
			                            	<br>
			                            	{{-- autor + datum vydania --}}
			                            	<small>
			                            		{{-- autor clanku --}}
												<span class="glyphicon glyphicon-user"></span>
												<a href="{{ url('user', $recentPost->user->id) }}">{{ $recentPost->user->name}}</a><br>
												{{-- datum vydania clanku --}}
												<span class="glyphicon glyphicon-time post-"></span> <span>{{ $recentPost->created_at }}</span>
											</small>
			                                {{-- nadpis clanku --}}
			                                <h5 class="post-title">
			                                	<a href="{{ route('post.show', ['id' => $recentPost->id, 'slug' => $recentPost->slug]) }}">{{$recentPost->title_teaser}}</a>
			                                </h5>
			                            </div>
		                            </div>
		                        </article>
							<br>
						</div>{{-- wrapper --}}
					</li>
				@endforeach
			</ul>{{-- zoznam clankov --}}
		</div>{{-- column --}}
	</section>
</div>{{-- row --}}