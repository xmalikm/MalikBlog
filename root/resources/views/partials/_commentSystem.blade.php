{{-- Comment system clankov --}}

{{-- row --}}
<div class="row">
	{{-- wrapper pre comment system --}}
	<div class="col-md-12 comments-wrapper">
		{{-- ak sa uzivatel uspesne prihlasi, vypise sa success message a moze komentovat clanok --}}
		@if(Session::has('discussionAllowed'))
			<div class="alert alert-success alert-dismissable fade in" id="discussionAllowed">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				{{-- samotna message --}}
				<strong> {{Session::get('discussionAllowed')}} </strong>
			</div>
		@endif
		{{-- ak zlyha prihlasenie uzivatela, vypise sa error message --}}
		@if(Session::has('discussionForbidden'))
			<div class="alert alert-danger alert-dismissable fade in" id="discussionAllowed">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				{{-- samotna message --}}
				<strong> {{Session::get('discussionForbidden')}} </strong>
			</div>
		@endif

		{{-- nadpis sekcie --}}
		<h3 class="title">
			<p class="post-comments">
				Diskusia <span>{{ count($comments) }}</span> komentarov
			</p>
		</h3>

		{{-- diskusia k clanku - pridavanie komentarov --}}
		{{-- ak je uzivatel prihlaseny, zobrazi sa toggle button, ktory zobrazuje formular na pridanie noveho komentaru --}}
		@if(Auth::check())
			{{-- toggle button na pridanie komentara --}}
			<button type="button" id="commentButton" class="btn btn-warning" data-toggle="collapse" data-target="#comment-form">Pridať komentár</button>
			
			{{-- formular na pridanie noveho komentaru --}}
			<div id="comment-form" class="collapse">

				{{ Form::open(['url' => url(''), 'method' => 'post', 'data-parsley-validate' => '', 'id' => 'addCommentForm']) }}

					{{-- error messages --}}
					<span class="alert-danger comment-error-msg"></span>
					{{-- obsah komentaru --}}
					<div class="form-group">
						{!! Form::textarea('commentBody', 'toto je komentar', [
							'class' => 'form-control',
							'id' => 'body',
							'placeholder' => 'Vyjadri svoj názor k článku a pridaj komentár',
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
			        {{-- animacia nacitavania --}}
			        <img id="ajax_loader2" class="pull-right" src="{{asset('images/loader.gif')}}" alt="loading animation">

				{{ Form::close() }}

			</div>{{-- formular na pridanie noveho komentaru --}}

		{{-- uzivatel nie je prihlaseny, button zobrazi prihlasovaci formular --}}
		@else
			{{-- toggle button na pridanie komentara --}}
			<button type="button" class="btn btn-warning" data-toggle="collapse" data-target="#comment-form">Pridať komentár</button>
			{{-- obsah toggle buttona --}}
			<div id="comment-form" class="collapse">

				{{-- heading text --}}
		    	<h3 class="text-center">Prosím prihláste sa</h3>
		    	<small class="text-center" style="display: block;">
		    		Na to aby ste mohli pridávať komentáre do diskusie sa musíte najskôr prihlásiť
		    	</small>

		    	{{-- formular na prihlasenie sa --}}
			    <div class="row form">
			        {{-- vycentrovanie formularu --}}
			        <div class=" form-center">

						{{-- header formularu --}}
						<div class="form-header"></div>
					    {{-- prihlasovaci formular --}}
					    {{ Form::open(['url' => url('/login'), 'method' => 'post', 'data-parsley-validate' => '']) }}

					        {{-- error message -> ak su zle zadane prihlasovacie udaje --}}
					        @if ($errors->first('failedLogin'))
					            <span class="help-block">
					            <strong>{{ $errors->first('failedLogin') }}</strong>
					            </span>
					        @endif
					        {{-- prihlasovaci email --}}
					        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					        	{{-- label --}}
					            {!! Form::label('email', 'E-mailová adresa', [
					                'class' => 'control-label col-sm-12'
					            ]) !!}
					            {{-- form input --}}
					            <div class="cols-sm-12">
					                <div class="input-group">
					                    <span class="input-group-addon">
					                        <i class="fa fa-envelope fa" aria-hidden="true"></i>
					                    </span>
					                    {!! Form::email('email', old('email'), [
					                        'placeholder' => 'E-mail',
					                        'autofocus' => true,
					                        'class' => 'form-control',
					                        'required' => '',
					                        'id' => 'email',
					                    ]) !!}
					                </div>
					                {{-- error message -> ak nie je zadany mail --}}
					                @if ($errors->has('email'))
					                    <span class="help-block">
					                    <strong>{{ $errors->first('email') }}</strong>
					                    </span>
					                @endif
					            </div>
					        </div>

					        {{-- prihlasovacie heslo --}}
					        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
								{{-- label --}}
					            {!! Form::label('password', 'Heslo', [
					                    'class' => 'control-label col-sm-12'
					            ]) !!}
					            {{-- form input --}}
					            <div class="cols-sm-12">
					                <div class="input-group">
					                    <span class="input-group-addon">
					                        <i class="fa fa-lock fa" aria-hidden="true"></i>
					                    </span>
					                    {!! Form::password('password', [
					                            'placeholder' => 'Heslo',
					                            'class' => 'form-control',
					                            'required' => ''
					                    ]) !!}
					                </div>
					                {{-- error message -> ak nie je zadane heslo --}}
					                @if ($errors->has('password'))
					                    <span class="help-block">
					                    <strong>{{ $errors->first('password') }}</strong>
					                    </span>
					                @endif
					            </div>
					        </div>

					        {{-- ak sa prihlasujeme pri pridavani komentaru, formular obsahuje skryty input --}}
					        {{-- sluzi na to aby sme vedeli kde sa mame vratit po prihlaseni --}}
					        {{ Form::hidden('fromPost', true) }}

					        {{-- zapamatat si prihlasenie --}}
					        <div class="form-group">
					            <div class="checkbox">
					                <label>
					                    {{ Form::checkbox('remember') }} Zapamätať
					                </label>
					            </div>
					        </div>
					        
					        {{-- submit button --}}
					        <div class="form-group">
					            {!! Form::button('Prihlásiť sa', [
					                'type' => 'submit',
					                'class' => 'btn btn-warning',
					            ]) !!}
					        </div>

					        {{-- link na registraciu + zabudnute heslo --}}
					        <p class="action">
					            <a href="{{ url('register') }}">Registrovať sa</a> | <a  href="{{ url('/password/reset') }}">
					                Zabudol som heslo
					            </a>
					        </p>        

						{{ Form::close() }}

        			</div>{{-- vycentrovanie formularu --}}
    			</div>{{-- formular na prihlasenie sa --}}

		 	</div>{{-- obsah toggle buttona --}}
		@endif
		<br><br>
		{{-- vsetky komentare k clanku --}}
		<div id="allComments">

			{{-- sablona na vytvorenie noveho komentaru cez ajax --}}
			{{-- aby sme pomocou js nemuseli vytvarat cely komentar rucne, vytvorime
				 si sablonu komentaru -> prazdny komentar, ktory budeme klonovat --}}
			<div class="comment" id="comment-template" style="display: none;">
				{{-- foto uzivatela --}}
				<img class="comment-photo" alt="foto autora">
				{{-- meno uzivatela --}}
				<span class="user-name"></span>
				{{-- datum vytvorenia komentaru --}}
				<small class="pull-right comment-date"></small>
				{{-- telo komentaru --}}
				<p class="commentBody"></p>
				{{-- dalsie veci, ktore sa v komente nachadzaju: moznost editacie komentu,
					 pocet lajkov komentu --}}
				<p class="pull-right by-comment">
					{{-- uprava komentu --}}
					<a href="#/" class="show-edit-comment-btn">Upraviť komentár &nbsp</a>
					{{-- pocet lajkov komentu --}}
					<span class="comment-likes">+ 0</span>&nbsp
					<img src="{{asset('images/icons/thumb_up.png')}}" class="like-comment-btn" title="Daj like komentáru" alt="like button">
				</p>
				
				{{-- editacia novo pridaneho komentaru --}}
				{{ Form::open(['method' => 'post', 'data-parsley-validate' => '', 'class' => 'edit-comment-form']) }}

					{{-- ak vznikne nejaky error --}}
					<span class="comment-error-msg"></span>
					{{-- obsah komentaru --}}
					<div class="form-group">
						{!! Form::textarea('commentBody', null, [
							'class' => 'form-control',
							'id' => 'body',
							'placeholder' => 'Edituj komentár',
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

				{{ Form::close() }}{{-- editacia novo pridaneho komentaru --}}

				{{-- animacia nacitavania pri editacii noveho komentu --}}
				<img class="edit-ajax-loader pull-right" src="{{asset('images/loader.gif')}}" alt="loading animation">
				{{-- vyclearovanie obsahu --}}
				<div class="clear-content"></div>
				<hr>
			</div>

			{{-- cyklus pre vypis vsetkych komentarov --}}
			@foreach($comments as $comment)
				<div class="comment" id="{{ $comment->id }}">

					{{-- fotka autora komentaru --}}
					<a href="{{ url('user', $comment->user->id) }}">
						<img class="comment-photo" src="{{ asset('uploads/profile_photos/'. $comment->user->profile_photo) }}" alt="foto autora">
					</a>
					{{-- meno autora --}}
					<a href="{{ url('user', $comment->user->id) }}"><span class="user-name"><b>{{$comment->user->name}}</b></span></a>
					{{-- datum vytvorenia komentu --}}
					<small class="pull-right comment-date">{{$comment->created_at}}</small>
					{{-- telo komentu --}}
					<p class="commentBody"><i>{{$comment->body}}</i></p>
					{{-- dalsie veci, ktore sa v komente nachadzaju: moznost editacie komentu,
					 pocet lajkov komentu --}}
					<p class="pull-right by-comment">
						{{-- ak je uzivatel autorom komentu, moze ho upravit --}}
						@can('updateComment', $comment)
							<a href="#/" class="show-edit-comment-btn">Upraviť komentár&nbsp</a>
						@endcan
						{{-- lajkovanie komentaru --}}
						@if(Auth::user())
							{{-- ak uz uzivatel lajkol tento komentar --}}
							@if($comment->isLiked)
								<span class="comment-likes">{{ '+ '.count($comment->likes) }}</span>&nbsp
								<img src="{{asset('images/icons/thumb_up_green.png')}}" class="comment-liked-btn"  title="Komentár sa ti páči" alt="like button">
							{{-- uzivatel este komentar nelajkoval --}}
							@else
								<span class="comment-likes">{{ '+ '.count($comment->likes) }}</span>&nbsp
								<img src="{{asset('images/icons/thumb_up.png')}}" class="like-comment-btn"  title="Daj like komentáru" alt="like button">
							@endif
							{{-- ak vznikol nejaky error --}}
							<span class = 'comment-like-error-msg'></span>
						@endif
					</p>
					
					{{-- editacia komentaru --}}
					{{ Form::open(['method' => 'post', 'data-parsley-validate' => '', 'class' => 'edit-comment-form']) }}
						<span class="alert-danger comment-error-msg"></span>
						{{-- obsah komentaru --}}
						<div class="form-group">
							{!! Form::textarea('commentBody', null, [
								'class' => 'form-control',
								'id' => 'body',
								'placeholder' => 'Edituj komentar',
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
					    {{-- animacia nacitavania --}}
					    <img class="edit-ajax-loader pull-right" src="{{asset('images/loader.gif')}}" alt="loading animation">

					{{ Form::close() }}{{-- editacia komentaru --}}

					{{-- vyclearovanie dalsieho obsahu --}}
					<div class="clear-content"></div>
				</div>
				{{-- bottom border pre kazdy koment okrem posledneho --}}
				@if(!$loop->last)
					<hr>
				@endif
			@endforeach
		</div>{{-- vsetky komentare k clanku --}}
	</div>{{-- wrapper pre comment system --}}
</div>{{-- row --}}