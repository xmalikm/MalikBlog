@extends('contentWithSidebars')

@section('categories')
	@include('partials/_categories')
@endsection

@section('breadcrumbs')
	{!! Breadcrumbs::render('showPost', $post) !!}
@endsection

{{-- obsah stranky --}}
@section('content')
	
	{{-- blog --}}
   	<div class="row show-post">

   		<div class="col-lg-12 col-md-12">

       		<h3 class="text-left" >Blog <b style="color: red;">{{ $post->user->name }} </b> </h3>
			<h4>{{ $post->category->name }}</h4>
       	</div>

	</div>

	{{-- nadpis treba potom presunut !!!!!!!!!!!!!!!!!!!!!!!--}}
	<div class="row">

		<div class="col-lg-12 col-md-12">

			<h2> {{ $post->title }} </h2>

		</div>

	</div>{{-- nadpis --}}

	{{-- foto k clanku --}}
	<div class="row">

		<div class="col-lg-12 col-md-12">
			<img src=" {{asset('uploads/blog_photos/'. $post->blog_photo)}}" style="width: 80%; height: 300px; border: 1px solid grey;">

		</div>

	</div>{{-- foto k clanku --}}

	<br> {{-- treba nahradit css-kom!!!!!!!!!!!!!!!!!!!!!!!!!!!!! --}}

	{{-- datum autor citanost--}}
	<div class="row">

		<div class="col-lg-12 col-md-12">

			<small> {{ $post->created_at }} | {{ $post->user->name }} | Prečítané: {{ $post->unique_views }}x | Popularita: <span id="post-popularity">{{ $post->popularity }}</span> | Diskusia: <span class="post-comments">{{ count($post->comments) }}</span> komentov </small>

		</div>

	</div>{{-- datum autor --}}

	<br> {{-- treba nahradit css-kom!!!!!!!!!!!!!!!!!!!!!!!!!!!!! --}}

	{{-- zdielanie na soc. sietach --}}
	<div class="row">

		<div class="col-lg-12 col-md-12">
			<span class="btn btn-success tooltip-likes" data-toggle = "tooltip" title="
				@foreach($likes as $like_user)
					{{$like_user->name}}<br>
				@endforeach
			">Komu sa paci tento clanok</span><br><br>
		</div>
		<div class="col-lg-12 col-md-12">
			{{-- ak je user vlastnikom clanku, zobraz edit button --}}
			@can('updatePost', $post)
				<a href="{{ route('post.edit', $post->id) }}" class="btn btn-default">Uprav blog</a>
			@endcan
			<button class="btn btn-primary">Zdielat</button>
			<button class="btn btn-warning">Zdielat</button>

		</div>

	</div>{{-- zdielanie na soc. sietach --}}

	<br>
	<br>

	{{-- clanok --}}
	<div class="row">

		<div class="col-lg-12 col-md-12">

			<p>
				{!! $post->full_text !!}
			</p>

		</div>

	</div>{{-- clanok --}}

	{{-- tagy k clanku --}}
	<div class="row">
		
		<div class="col-lg-12 col-md-12">

			@if(Auth::user())
				@if($post->isLiked)
					{{-- ak uz uzivatel podporil clanok --}}
					<button class="btn btn-info" id="post-liked-btn">Článok sa mi páči</button>
				@else
					{{-- uzivatel este clanok nepodporil --}}
					<div id="like-post">
						<button id="like-post-btn" class="btn btn-info">Podpor článok</button>
						<img id="ajax_loader" src="{{asset('images/loader.gif')}}" style="display: none;">
					</div>
				@endif
				<div id = 'error-post-msg'></div>
			@endif
			@include('partials/_tags')

		</div>

	</div>{{-- tagy k clanku --}}
		
	<hr>

	<div class="row">
		
		<div class="col-md-12" style="border-bottom: 2px solid grey;">
			@if(Session::has('discussionAllowed'))
				<div class="alert alert-success alert-dismissable fade in" id="discussionAllowed">
		    		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    		<strong> {{Session::get('discussionAllowed')}} </strong>
	 			</div>
			@endif
			<h2><b>Diskusia <span class="post-comments">{{ count($comments) }}</span> komentarov</b><img id="ajax_loader2" src="{{asset('images/loader.gif')}}" style="display: none;"></h2>

			{{-- diskusia k clanku - pridavanie komentarov --}}
			{{-- ak je uzivatel prihlaseny, zobrazi sa toggle button, ktory zobrazuje formular na pridanie noveho komentaru --}}
			@if(Auth::check())
				<button type="button" id="commentButton" class="btn btn-warning" data-toggle="collapse" data-target="#commentForm">Pridať komentár</button>
				<br><br>
				<div id="commentForm" class="collapse">
			    	
			    	{{-- formular na pridanie noveho komentaru --}}
					{{ Form::open(['url' => url(''), 'method' => 'post', 'data-parsley-validate' => '', 'id' => 'addCommentForm']) }}
						<span class="comment-error-msg"></span>
						{{-- obsah komentaru --}}
						<div class="form-group">
							{!! Form::textarea('commentBody', 'toto je komentar', [
								'class' => 'form-control',
								'id' => 'body',
								'placeholder' => 'Pridaj komentar',
								'autofocus' => true,
								'rows' => 5,
							]) !!}
						</div>{{-- obsah komentaru --}}
						
						{{-- submit button --}}
		                <div class="form-group">
		                    {!! Form::button('Odoslať', [
		                        'type' => 'submit',
		                        'class' => 'btn btn btn-primary pull-right'
		                    ]) !!}
		                </div>

					{{ Form::close() }}

			 	</div>
			{{-- uzivatel nie je prihlaseny, button zobrazi prihlasovaci formular --}}
			@else
				<button type="button" class="btn btn-warning" data-toggle="collapse" data-target="#commentForm">Pridať komentár</button>
				<br><br>
				<div id="commentForm" class="collapse">
			    	<h3 class="text-center">Prosím prihláste sa</h3>
			    	<small class="text-center" style="display: block;">Na to aby ste mohli pridávať komentáre do diskusie sa musíte najskôr prihlásiť</small>
			    	<br>
			    	{{-- formular na prihlasenie sa --}}
				    {{ Form::open(['url' => url('/login'), 'method' => 'post', 'data-parsley-validate' => '']) }}

				        <div class="row">

				            <div class="col-lg-6 col-lg-offset-3">
				                
				                {{-- error message -> ak su zle zadane prihlasovacie udaje --}}
				                @if ($errors->first('failedLogin'))
				                        <span class="help-block">
				                        <strong>{{ $errors->first('failedLogin') }}</strong>
				                        </span>
				                @endif
				                
				                {{-- prihlasovaci email --}}
				                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				                    {!! Form::label('email', 'E-mailová adresa', [
				                        'class' => 'control-label'
				                    ]) !!}
				                    {!! Form::email('email', old('email'), [
				                        'placeholder' => 'E-mail',
				                        'autofocus' => true,
				                        'class' => 'form-control',
				                        'required' => ''
				                    ]) !!}
				                    {{-- error message -> ak nie je zadany mail --}}
				                    @if ($errors->has('email'))
				                        <span class="help-block">
				                        <strong>{{ $errors->first('email') }}</strong>
				                        </span>
				                    @endif
				                </div>

				                {{-- prihlasovacie heslo --}}
				                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

				                    {!! Form::label('password', 'Heslo', [
				                            'class' => 'control-label'
				                    ]) !!}
				                    
				                    {!! Form::password('password', [
				                            'placeholder' => 'heslo',
				                            'class' => 'form-control',
				                            'required' => ''
				                    ]) !!}
				                    
				                    {{-- error message -> ak nie je zadane heslo --}}
				                    @if ($errors->has('password'))
				                        <span class="help-block">
				                        <strong>{{ $errors->first('password') }}</strong>
				                        </span>
				                    @endif
				                </div>

				                {{-- zapamatat si prihlasenie --}}
				                <div class="form-group">
				                    <div class="checkbox">
				                        <label>
				                            {{ Form::checkbox('remember') }} Zapamätať
				                        </label>
				                    </div>
				                </div>
				                
				                {{-- ak sa prihlasujeme pri pridavani komentaru, formular obsahuje skryty input --}}
				                {{-- sluzi na to aby sme vedeli kde sa mame vratit po prihlaseni --}}
								{{ Form::hidden('fromPost', true) }}

				                {{-- submit button --}}
				                <div class="form-group">
				                    {!! Form::button('Prihlásiť sa', [
				                        'type' => 'submit',
				                        'class' => 'btn btn-lg btn-primary'
				                    ]) !!}
				                    <a class="btn btn-link" href="{{ url('/password/reset') }}">
				                        Zabudol som heslo
				                    </a>
				                </div>
				                
				                {{-- link na registraciu --}}
				                <p class="action">
				                    <a href="{{ url('register') }}">Registrovať sa</a>
				                </p>        

				            </div>

				        </div>

				    {{ Form::close() }}

			 	</div>
			@endif
		<br>
		<br>
			<div id="allComments">

				<div class="comment" id="comment-template" style="display: none;">
						<img style="width: 50px; height: 50px; float: left; margin-right: 18px;">
						<button class="btn btn-info btn-xs show-edit-comment-btn">Upraviť komentár &nbsp</button>

						<span class="comment-likes">+ 0</span>&nbsp<span class="glyphicon glyphicon-thumbs-up like-comment-btn"></span>

						<p class="user-name"><b>Meno: </b> </p>
						<p class="commentBody" style="margin-left: 68px;"><b>Koment: </b> </p>
						
						{{-- formular na pridanie noveho komentaru --}}
						{{ Form::open(['method' => 'post', 'data-parsley-validate' => '', 'class' => 'edit-comment-form']) }}
							<span class="comment-error-msg"></span>
							{{-- obsah komentaru --}}
							<div class="form-group">
								{!! Form::textarea('commentBody', null, [
									'class' => 'form-control',
									'id' => 'body',
									'placeholder' => 'Pridaj komentar',
									'autofocus' => true,
									'rows' => 3,
								]) !!}
							</div>{{-- obsah komentaru --}}
								
							{{-- submit button --}}
						    <div class="form-group">
						        {!! Form::button('Uprav', [
						            'type' => 'submit',
						            'class' => 'btn btn btn-primary pull-right'
						        ]) !!}
						    </div>

						{{ Form::close() }}
						<img class="edit-ajax-loader pull-right" src="{{asset('images/loader.gif')}}" style="display: none; width: 10%; position: relative; top: -20px;">
				</div>

				{{-- cyklus pre vypis vsetkych komentarov --}}
				@foreach($comments as $comment)
					<div class="comment" id="{{ $comment->id }}">
						<img src="{{ asset('uploads/profile_photos/'. $comment->user->profile_photo) }}" style="width: 50px; height: 50px; float: left; margin-right: 18px;">
						@can('updateComment', $comment)
							<button class="btn btn-info btn-xs show-edit-comment-btn">Upraviť komentár &nbsp</button>
						@endcan

						{{-- lajkovanie komentaru --}}
						@if(Auth::user())
							{{-- ak uz uzivatel lajkol tento komentar --}}
							@if($comment->isLiked)
								<span class="comment-likes">{{ '+ '.count($comment->likes) }}</span>&nbsp<span class="glyphicon glyphicon-thumbs-up comment-liked-btn" style="border: 1px solid red;"></span>
							{{-- uzivatel este komentar nelajkoval --}}
							@else
								<span class="comment-likes">{{ '+ '.count($comment->likes) }}</span>&nbsp<span class="glyphicon glyphicon-thumbs-up like-comment-btn"></span>
							@endif
							<span class = 'comment-like-error-msg'></span>
						@endif

						<p><b>Meno: </b> {{$comment->user->name}}</p>
						<p class="commentBody" style="margin-left: 68px;"><b>Koment: </b> {{$comment->body}}</p>
						
						{{-- formular na pridanie noveho komentaru --}}
						{{ Form::open(['method' => 'post', 'data-parsley-validate' => '', 'class' => 'edit-comment-form']) }}
							<span class="comment-error-msg"></span>
							{{-- obsah komentaru --}}
							<div class="form-group">
								{!! Form::textarea('commentBody', null, [
									'class' => 'form-control',
									'id' => 'body',
									'placeholder' => 'Pridaj komentar',
									'autofocus' => true,
									'rows' => 3,
								]) !!}
							</div>{{-- obsah komentaru --}}
								
							{{-- submit button --}}
						    <div class="form-group">
						        {!! Form::button('Uprav', [
						            'type' => 'submit',
						            'class' => 'btn btn btn-primary pull-right'
						        ]) !!}
						    </div>

						{{ Form::close() }}
						<img class="edit-ajax-loader pull-right" src="{{asset('images/loader.gif')}}" style="display: none; width: 10%; position: relative; top: -20px;">
					</div>
					<br>
				@endforeach
			</div>
		</div>

		<div class="col-md-6">
			
			<h3>Ďalšie články autora {{ $user->name }}</h3>
			<ul style="list-style-type: none;">
				@forelse($postsFromAuthor as $authorPost)
					<li >
						<img src="{{ asset('uploads/profile_photos/'. $user->profile_photo) }}" style="width: 50px; height: 50px; float: left; margin-right: 18px;">
						<a href="{{ url('user', $user->id) }}" style="display: block; color: grey;">{{$user->name}}</a>
						<a href="{{ route('post.show', ['id' => $authorPost->id, 'slug' => $authorPost->slug]) }}" style="margin-left: 68px;display: block;">{{$authorPost->title}}</a>
					</li>
					<br>
				@empty
					<h4>Žiadne ďalšie články</h4>
				@endforelse
			</ul>
			
		</div>

		<div class="col-md-6">
			
			<h3>Ďalšie články z kategórie {{ $post->category->name }}</h3>
			<ul style="list-style-type: none;">
				@forelse($postsFromCat as $categoryPost)
					<li >
						<img src="{{ asset('uploads/blog_photos/'. $categoryPost->blog_photo) }}" style="width: 50px; height: 50px; float: left; margin-right: 18px;">
						<a href="{{ url('user', $categoryPost->user->id) }}" style="display: block; color: grey;">{{$categoryPost->user->name}}</a>
						<a href="{{ route('post.show', ['id' => $categoryPost->id, 'slug' => $categoryPost->slug]) }}" style="margin-left: 68px;display: block;">{{$categoryPost->title}}</a>
					</li>
					<br>
				@empty
					<h4>Žiadne ďalšie články</h4>
				@endforelse
			</ul>
			
		</div>

		<div id="recent-posts" class="col-md-12" style="border-top: 2px solid grey;">
			<h3>Mohlo by vás zaujímať</h3>
			@foreach($recentPosts as $recentPost)
				<div class="col-md-3">
					<img src="{{ asset('uploads/blog_photos/'. $recentPost->blog_photo) }}" style="width: 180px; height: 150px; display: block;">
					<a href="{{ url('category', $recentPost->category->id) }}" style="color: grey;">{{$recentPost->category->name}}</a>
					<br>
					<a href="{{ route('post.show', ['id' => $recentPost->id, 'slug' => $recentPost->slug]) }}">{{$recentPost->title}}</a>
				</div>
			@endforeach
		</div>
	</div>

@endsection

@section('sidebars')

	@include('partials/sidebars/_profileInfo')

@endsection

@section('scripts')

	<script>
		// v externom js subore potrebujeme id-cka prihlaseneho uzivatela a zobrazeneho postu
		// tieto premenne treba naplnit v blade subore
		var postId = {{$post->id}},
			userId = {{Auth::id()}};
	</script>
	<script src=" {{ asset('js/blog-js/show-post.js') }} "></script>

@endsection