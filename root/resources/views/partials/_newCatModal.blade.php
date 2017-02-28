{{-- modal dialog pre vytvorenie novej kategorie --}}

<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">
    	{{-- Modal content --}}
		<div class="modal-content">

			{{-- modal header --}}
	        <div class="modal-header">
    	      	<button type="button" class="close" data-dismiss="modal">&times;</button>
    	      	{{-- nazov modalu --}}
          		<h4 class="modal-title">Nova kategoria</h4>
        	</div>{{-- modal header --}}

			{{-- telo modalu - formular na vytvorenie kategorie --}}
        	<div class="modal-body">
	          	
				{!! Form::open(['url' => url('category'), 'method' => 'post', 'data-parsley-validate' => '']) !!}
		
					{{-- vytvorenie novej kategorie --}}
					<div class="form-group">
						{!! Form::label('text', 'Vytvor novu kategoriu') !!}
						{!! Form::text('name', null, [
							'class' => 'form-control',
							'placeholder' => 'Nova kategoria',
							'autofocus' => true,
							'required' => ''
						]) !!}
						@if(isset($post))
							{!! Form::hidden('post_id', $post->id) !!}
						@endif
						{{-- submit button --}}
						{!! Form::button('Vytvor kategoriu', [
								'type' => 'submit',
								'class' => 'btn btn-primary'
						]) !!}
					</div>{{-- vytvorenie novej kategorie --}}

				{!! Form::close() !!}

        	</div>{{-- telo modalu - formular na vytvorenie kategorie --}}

			{{-- footer modalu - close button --}}
        	<div class="modal-footer">
          		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        	</div>{{-- footer modalu - close button --}}

		</div>{{-- Modal content --}}
    </div>
</div>