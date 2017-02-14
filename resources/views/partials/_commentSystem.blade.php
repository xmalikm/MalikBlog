<div class="row">
	<div class="col-md-12" style="border-bottom: 2px solid grey;">
		@if(Session::has('discussionAllowed'))
			<div class="alert alert-success alert-dismissable fade in" id="discussionAllowed">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong> {{Session::get('discussionAllowed')}} </strong>
			</div>
		@endif
		@if(Session::has('discussionForbidden'))
			<div class="alert alert-danger alert-dismissable fade in" id="discussionAllowed">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong> {{Session::get('discussionForbidden')}} </strong>
			</div>
		@endif
		<h3>
			<b>Diskusia <span class="post-comments">{{ count($comments) }}</span> komentarov</b>
		</h3>

		{{-- diskusia k clanku - pridavanie komentarov --}}
		{{-- ak je uzivatel prihlaseny, zobrazi sa toggle button, ktory zobrazuje formular na pridanie noveho komentaru --}}
		@if(Auth::check())
			<button type="button" id="commentButton" class="btn btn-warning" data-toggle="collapse" data-target="#commentForm">Pridať komentár</button>
			
			<div id="commentForm" class="collapse">
				
				{{-- formular na pridanie noveho komentaru --}}
				{{ Form::open(['url' => url(''), 'method' => 'post', 'data-parsley-validate' => '', 'id' => 'addCommentForm']) }}
					<span class="alert-danger comment-error-msg"></span>
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
			        <img id="ajax_loader2" class="pull-right" src="{{asset('images/loader.gif')}}">

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
			                <div class="comment-wrapper">
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
			                <div id="comment-login" class="form-group">
			                    {!! Form::button('Prihlásiť sa', [
			                        'type' => 'submit',
			                        'class' => 'btn btn-lg btn-primary',
			                    ]) !!}
			                    <br>
			                    <a class="btn btn-link" href="{{ url('/password/reset') }}">
			                        Zabudol som heslo
			                    </a>
				                {{-- link na registraciu --}}
				                <p class="action">
				                    <a href="{{ url('register') }}">Alebo sa zaregistrujte</a>
				                </p>        
			                </div>
			                
							</div>
			            </div>

			        </div>

			    {{ Form::close() }}

		 	</div>
		@endif
			<br>
			<br>
		<div id="allComments">

			<div class="comment" id="comment-template" style="display: none;">
				<img class="comment-photo">

				<span class="user-name"></span>
				<small class="pull-right comment-date"></small>
				<p class="commentBody"></p>

				<p class="by-comment">
					<a href="#/" class="show-edit-comment-btn">Upraviť komentár &nbsp</a>
					<span class="comment-likes">+ 0</span>&nbsp
					<img src="{{asset('images/icons/thumb_up.png')}}" class="like-comment-btn" title="Daj like komentáru" style="width: 20px; height: 20px; margin-top: -10px;">
				</p>

				
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
				<img class="edit-ajax-loader pull-right" src="{{asset('images/loader.gif')}}">
				<div class="clear-content"></div>
			</div>

			{{-- cyklus pre vypis vsetkych komentarov --}}
			@foreach($comments as $comment)
				<div class="comment" id="{{ $comment->id }}">
					{{-- fotka autora komentaru --}}
					<img class="comment-photo" src="{{ asset('uploads/profile_photos/'. $comment->user->profile_photo) }}">


					<span class="user-name"><b>{{$comment->user->name}}</b></span>
					<small class="pull-right comment-date">{{$comment->created_at}}</small>
					<p class="commentBody"><i>{{$comment->body}}</i></p>

					<p class="by-comment">
						@can('updateComment', $comment)
							<a href="#/" class="show-edit-comment-btn">Upraviť komentár&nbsp</a>
						@endcan

						{{-- lajkovanie komentaru --}}
						@if(Auth::user())
							{{-- ak uz uzivatel lajkol tento komentar --}}
							@if($comment->isLiked)
								<span class="comment-likes">{{ '+ '.count($comment->likes) }}</span>&nbsp
								<img src="{{asset('images/icons/thumb_up_green.png')}}" class="comment-liked-btn"  title="Komentár sa ti páči" style="width: 20px; height: 20px; margin-top: -10px;">
							{{-- uzivatel este komentar nelajkoval --}}
							@else
								<span class="comment-likes">{{ '+ '.count($comment->likes) }}</span>&nbsp
								<img src="{{asset('images/icons/thumb_up.png')}}" class="like-comment-btn"  title="Daj like komentáru" style="width: 20px; height: 20px; margin-top: -10px;">
							@endif
							<span class = 'comment-like-error-msg'></span>
						@endif
					</p>
					
					{{-- formular na pridanie noveho komentaru --}}
					{{ Form::open(['method' => 'post', 'data-parsley-validate' => '', 'class' => 'edit-comment-form']) }}
						<span class="alert-danger comment-error-msg"></span>
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
					    <img class="edit-ajax-loader pull-right" src="{{asset('images/loader.gif')}}">

					{{ Form::close() }}
					<div class="clear-content"></div>
				</div>
				@if(!$loop->last)
					<hr>
				@endif
			@endforeach
		</div>
	</div>
</div>