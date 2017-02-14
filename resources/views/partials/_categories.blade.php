<div class="row">
	<div class="col-lg-9 categories">
		<div class="btn-group">
			@foreach($categories as $category)
				<a href = " {{ url('category', $category->id) }} " class="btn btn-primary btn-md">{{ $category->name }}</a>
			@endforeach

			{{-- <div class="btn-group">
				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
			   		Ďalšie <span class="caret"></span>
			   	</button>
			    <ul class="dropdown-menu" role="menu">
			    	@foreach($categories as $category)
						<li><a href=" {{ url('category', $category->id) }} ">{{ $category->name }}</a></li>
					@endforeach
				</ul>
		  </div> --}}
		</div>
	</div>

	<div class="btn-group btn-group-justified categories-mobile">
		<button type="button" style="width: 100%;" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
	   		Ďalšie <span class="caret"></span>
	   	</button>
	    <ul class="dropdown-menu" role="menu">
	    	@foreach($categories as $category)
				<li class="btn-group-justified text-center"><a href=" {{ url('category', $category->id) }} ">{{ $category->name }}</a></li>
			@endforeach
		</ul>
	</div>
</div>